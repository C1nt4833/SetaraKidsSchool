<?php

class SimpleSMTP {
    private $host;
    private $port;
    private $user;
    private $pass;
    private $debug = false;
    private $conn;

    // for debug collection
    private $logs = [];
    private $lastError = null;

    public function __construct($config) {
        $this->host = $config['smtp_host'];
        $this->port = $config['smtp_port'];
        $this->user = $config['smtp_user']; 
        $this->pass = $config['smtp_pass']; 
    }

    public function send($to, $subject, $body, $fromEmail, $fromName) {
        try {
            // Connect to server
            // Untuk port 465 (SSL), gunakan SSL dari awal
            // Untuk port 587 (TLS), gunakan STARTTLS setelah koneksi
            $socket_context = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                    'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT
                ]
            ]);
            
            $protocol = ($this->port == 465) ? 'ssl' : 'tcp';
            $connectTimeout = 15; // timeout 15 detik untuk koneksi
            $this->conn = @stream_socket_client("{$protocol}://{$this->host}:{$this->port}", $errno, $errstr, $connectTimeout, STREAM_CLIENT_CONNECT, $socket_context);

            if (!$this->conn) {
                $this->lastError = "Could not connect to SMTP host: $errstr (Error: $errno). Pastikan server SMTP dapat diakses.";
                throw new Exception($this->lastError);
            }
            
            // Set timeout untuk semua operasi socket
            stream_set_timeout($this->conn, 15);
            
            // Untuk port 465, SSL sudah aktif dari awal, langsung baca response
            // Untuk port 587, baca response kemudian aktifkan STARTTLS
            $this->readResponse();

            // HELO/EHLO
            $this->sendCommand("EHLO " . ($_SERVER['SERVER_NAME'] ?? gethostname()));

            // STARTTLS hanya untuk port 587 (TLS)
            if ($this->port == 587) {
                $this->sendCommand("STARTTLS");
                $crypto = stream_socket_enable_crypto($this->conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
                if (!$crypto) {
                    throw new Exception("Failed to enable TLS encryption");
                }
                $this->sendCommand("EHLO " . ($_SERVER['SERVER_NAME'] ?? gethostname()));
            }

            // AUTH LOGIN
            $this->sendCommand("AUTH LOGIN");
            $this->sendCommand(base64_encode($this->user));
            $response = $this->readResponse();
            // Periksa apakah server meminta password
            $code = substr($response, 0, 3);
            if ($code && ($code[0] == '4' || $code[0] == '5')) {
                throw new Exception("SMTP Authentication failed at username step: " . trim($response));
            }
            $this->sendCommand(base64_encode($this->pass));
            $authResponse = $this->readResponse();
            $authCode = substr($authResponse, 0, 3);
            if ($authCode && ($authCode[0] == '4' || $authCode[0] == '5')) {
                throw new Exception("SMTP Authentication failed: " . trim($authResponse));
            }

            // MAIL FROM - gunakan fromEmail yang diberikan, fallback ke smtp_user
            $mailFrom = !empty($fromEmail) ? $fromEmail : $this->user;
            $this->sendCommand("MAIL FROM: <{$mailFrom}>");

            // RCPT TO
            $this->sendCommand("RCPT TO: <$to>");

            // DATA
            $this->sendCommand("DATA");

            // Headers & Body
            $headers  = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "From: $fromName <$fromEmail>\r\n";
            $headers .= "To: $to\r\n";
            $headers .= "Subject: $subject\r\n";
            $headers .= "Date: " . date('r') . "\r\n";
            $headers .= "Message-ID: <" . uniqid() . "@" . $this->getHostName() . ">\r\n";
            $headers .= "X-Mailer: SimpleSMTP/1.0\r\n";
            
            $this->sendData($headers . "\r\n" . $body . "\r\n.");

            // QUIT - jangan tunggu response, langsung tutup untuk response cepat
            try {
                // Kirim QUIT command tapi jangan tunggu response terlalu lama
                $this->logs[] = 'C: QUIT';
                @fwrite($this->conn, "QUIT\r\n");
                // Baca response dengan timeout pendek
                stream_set_timeout($this->conn, 2); // timeout 2 detik untuk QUIT
                @fgets($this->conn, 515); // Baca response jika ada
            } catch (Exception $e) {
                // Ignore QUIT errors, kita tetap tutup koneksi
                error_log("SMTP QUIT warning: " . $e->getMessage());
            }
            
            // Tutup koneksi dengan benar dan cepat
            if (is_resource($this->conn)) {
                @fclose($this->conn);
                $this->conn = null;
            }
            
            return true;

        } catch (Exception $e) {
            $this->lastError = $e->getMessage();
            error_log("SMTP Error: " . $this->lastError);
            
            // Pastikan koneksi ditutup meskipun ada error
            if (is_resource($this->conn)) {
                @fclose($this->conn);
                $this->conn = null;
            }
            
            return false;
        }
    }

    public function getDebugLog() {
        return $this->logs;
    }

    public function getLastError() {
        return $this->lastError;
    }

    private function sendCommand($cmd) {
        $this->logs[] = 'C: ' . $cmd;
        
        // Pastikan koneksi masih aktif
        if (!is_resource($this->conn) || feof($this->conn)) {
            throw new Exception("SMTP connection lost");
        }
        
        $written = @fwrite($this->conn, $cmd . "\r\n");
        if ($written === false) {
            $meta = stream_get_meta_data($this->conn);
            if ($meta['timed_out']) {
                throw new Exception("SMTP write timeout");
            }
            throw new Exception("Failed to send SMTP command");
        }
        
        $response = $this->readResponse();
        
        // Simple error checking: if response starts with 4 or 5
        $code = substr($response, 0, 3);
        if ($code && ($code[0] == '4' || $code[0] == '5')) {
            $this->lastError = "SMTP Error [$code]: " . trim($response);
            throw new Exception($this->lastError);
        }
    }

    private function sendData($data) {
        $this->logs[] = 'C-DATA: ' . substr($data, 0, 500);
        
        // Pastikan koneksi masih aktif
        if (!is_resource($this->conn) || feof($this->conn)) {
            throw new Exception("SMTP connection lost");
        }
        
        $written = @fwrite($this->conn, $data . "\r\n");
        if ($written === false) {
            $meta = stream_get_meta_data($this->conn);
            if ($meta['timed_out']) {
                throw new Exception("SMTP write timeout");
            }
            throw new Exception("Failed to send SMTP data");
        }
        
        $this->readResponse();
    }

    private function readResponse() {
        $str = "";
        $timeout = 10; // timeout 10 detik untuk membaca response
        $startTime = time();
        
        // Set socket timeout
        stream_set_timeout($this->conn, $timeout);
        
        while (true) {
            // Cek timeout
            if (time() - $startTime > $timeout) {
                throw new Exception("SMTP read timeout after {$timeout} seconds");
            }
            
            $line = fgets($this->conn, 515);
            if ($line === false) {
                // Cek apakah timeout atau error
                $meta = stream_get_meta_data($this->conn);
                if ($meta['timed_out']) {
                    throw new Exception("SMTP read timeout");
                }
                throw new Exception("SMTP connection closed unexpectedly");
            }
            
            $str .= $line;
            $this->logs[] = 'S: ' . trim($line);
            if ($this->debug) error_log('SMTP RECV: ' . trim($line));
            
            // Jika baris terakhir (karakter ke-4 adalah spasi), break
            if (strlen($line) > 3 && substr($line, 3, 1) == " ") {
                break;
            }
        }
        
        return $str;
    }

    // Aktifkan debug agar log SMTP ditulis ke error_log
    public function setDebug($on = true) {
        $this->debug = (bool) $on;
    }

    private function getHostName() {
        return $_SERVER['SERVER_NAME'] ?? 'localhost';
    }
}

// Helper function to be called easily
// If smtp_config.php has ['smtp_debug' => true] then SSH/SMTP debug will be logged to error_log
function send_email_smtp($to, $subject, $message) {
    if (file_exists(__DIR__ . '/smtp_config.php')) {
        $config = include(__DIR__ . '/smtp_config.php');
    } else {
        return false;
    }

    $smtp = new SimpleSMTP($config);
    if (!empty($config['smtp_debug'])) {
        $smtp->setDebug(true);
    }

    $ok = $smtp->send($to, $subject, $message, $config['from_email'], $config['from_name']);
    $logs = $smtp->getDebugLog();
    $err = $smtp->getLastError();

    return ['success' => (bool)$ok, 'logs' => $logs, 'error' => $err];
}
?>
