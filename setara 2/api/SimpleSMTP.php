<?php

class SimpleSMTP {
    private $host;
    private $port;
    private $user;
    private $pass;
    private $debug = false;
    private $conn;

    public function __construct($config) {
        $this->host = $config['smtp_host'];
        $this->port = $config['smtp_port'];
        $this->user = $config['smtp_user'];
        $this->pass = $config['smtp_pass'];
    }

    public function send($to, $subject, $body, $fromEmail, $fromName) {
        try {
            // Connect to server
            $socket_context = stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
            $this->conn = stream_socket_client("tcp://{$this->host}:{$this->port}", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $socket_context);

            if (!$this->conn) {
                throw new Exception("Could not connect to SMTP host: $errstr");
            }
            $this->readResponse();

            // HELO/EHLO
            $this->sendCommand("EHLO " . gethostname());

            // STARTTLS
            if ($this->port == 587) {
                $this->sendCommand("STARTTLS");
                stream_socket_enable_crypto($this->conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
                $this->sendCommand("EHLO " . gethostname());
            }

            // AUTH LOGIN
            $this->sendCommand("AUTH LOGIN");
            $this->sendCommand(base64_encode($this->user));
            $this->sendCommand(base64_encode($this->pass));

            // MAIL FROM
            $this->sendCommand("MAIL FROM: <{$this->user}>");

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
            
            $this->sendData($headers . "\r\n" . $body . "\r\n.");

            // QUIT
            $this->sendCommand("QUIT");
            
            fclose($this->conn);
            return true;

        } catch (Exception $e) {
            error_log("SMTP Error: " . $e->getMessage());
            return false;
        }
    }

    private function sendCommand($cmd) {
        fwrite($this->conn, $cmd . "\r\n");
        $this->readResponse();
    }

    private function sendData($data) {
        fwrite($this->conn, $data . "\r\n");
        $this->readResponse();
    }

    private function readResponse() {
        $str = "";
        while ($str = fgets($this->conn, 515)) {
            if ($this->debug) echo $str;
            if (substr($str, 3, 1) == " ") { break; }
        }
        return $str;
    }
}

// Helper function to be called easily
function send_email_smtp($to, $subject, $message) {
    if (file_exists(__DIR__ . '/smtp_config.php')) {
        $config = include(__DIR__ . '/smtp_config.php');
    } else {
        return false;
    }

    $smtp = new SimpleSMTP($config);
    return $smtp->send($to, $subject, $message, $config['from_email'], $config['from_name']);
}
?>
