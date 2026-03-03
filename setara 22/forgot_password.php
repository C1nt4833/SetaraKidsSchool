<?php
// Halaman Lupa Password
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Lupa Password - Setara Kids</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4">
          <h3 class="mb-3">Lupa Password</h3>
          <p class="text-muted">Masukkan username atau email Anda. Jika akun ditemukan, kami akan mengirimkan email berisi tautan untuk mereset password.</p>

          <div id="alert" class="alert d-none alert-dismissible fade show" role="alert">
            <span id="alert-message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

          <form id="forgot-form">
            <div class="mb-3">
              <label for="identifier" class="form-label">Username atau Email</label>
              <input id="identifier" name="identifier" type="text" class="form-control" placeholder="Masukkan username atau email" required>
            </div>
            <button class="btn btn-primary" type="submit">Kirim Tautan Reset</button>
            <a href="login.html" class="btn btn-link">Kembali ke Masuk</a>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
document.getElementById('forgot-form').addEventListener('submit', async function(e){
  e.preventDefault();
  const idInput = document.getElementById('identifier');
  const id = idInput ? idInput.value.trim() : '';
  const alertEl = document.getElementById('alert');
  const btn = document.querySelector('#forgot-form button[type="submit"]');
  
  // Reset alert
  if (alertEl) {
    alertEl.classList.add('d-none');
    const alertMessage = document.getElementById('alert-message');
    if (alertMessage) {
      alertMessage.textContent = '';
    }
  }
  
  // Validasi input
  if (!id || id.length === 0) {
    if (alertEl) {
      alertEl.className = 'alert alert-warning alert-dismissible fade show';
      const alertMessage = document.getElementById('alert-message');
      if (alertMessage) {
        alertMessage.textContent = 'Harap isi username atau email.';
      } else {
        alertEl.textContent = 'Harap isi username atau email.';
      }
      alertEl.classList.remove('d-none');
    } else {
      alert('Harap isi username atau email.');
    }
    return;
  }

  btn.disabled = true;
  const prevText = btn.textContent;
  btn.textContent = 'Mengirim...';

  try {
    // Tambahkan timeout 45 detik untuk memberi waktu SMTP (backend timeout 60 detik)
    const controller = new AbortController();
    const timeoutId = setTimeout(() => controller.abort(), 45000);
    
    const res = await fetch('api/forgot_password.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ identifier: id }),
      signal: controller.signal
    });
    
    clearTimeout(timeoutId);

    let data = null;
    const text = await res.text();
    try { 
      data = JSON.parse(text); 
    } catch (parseErr) { 
      console.error('Failed to parse JSON:', text);
      // Jika bukan JSON, tampilkan error
      if (alertEl) {
        alertEl.className = 'alert alert-danger';
        alertEl.textContent = 'Terjadi kesalahan pada server. Silakan coba lagi.';
        alertEl.classList.remove('d-none');
      }
      return;
    }

    // Tentukan pesan untuk ditampilkan di alert di atas form
    let alertClass = '';
    let message = '';

    if (res.ok && data && data.success) {
      // Berhasil kirim email
      alertClass = 'alert alert-success';
      message = data.message || 'Email reset password telah dikirim. Periksa inbox atau folder spam Anda.';
      
      // Clear form setelah sukses
      if (idInput) {
        idInput.value = '';
      }
    } else {
      // Gagal - bisa karena user tidak terdaftar, SMTP error, dll
      alertClass = 'alert alert-danger';
      if (data && data.message) {
        message = data.message;
      } else {
        message = 'Terjadi kesalahan. Silakan coba lagi nanti.';
      }
      console.error('Forgot API error:', res.status, text);
    }

    // Tampilkan pesan di alert di atas form
    if (alertEl) {
      alertEl.className = alertClass + ' alert-dismissible fade show';
      const alertMessage = document.getElementById('alert-message');
      if (alertMessage) {
        alertMessage.textContent = message;
      } else {
        alertEl.textContent = message;
      }
      alertEl.classList.remove('d-none');
      
      // Scroll ke atas untuk melihat alert
      alertEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      
      // Auto-hide alert sukses setelah 10 detik
      if (res.ok && data && data.success) {
        setTimeout(() => {
          if (alertEl && typeof bootstrap !== 'undefined' && bootstrap.Alert) {
            const bsAlert = new bootstrap.Alert(alertEl);
            bsAlert.close();
          } else if (alertEl) {
            alertEl.classList.add('d-none');
          }
        }, 10000);
      }
    } else {
      // Fallback jika alert tidak ditemukan
      alert(message);
    }

  } catch (err) {
    console.error('Network/JS error', err);
    // Tampilkan error di alert di atas form
    let errorMsg = 'Kesalahan koneksi. ';
    if (err.name === 'AbortError') {
      errorMsg += 'Request timeout. Server terlalu lama merespons. Silakan coba lagi.';
    } else {
      errorMsg += 'Periksa sambungan internet atau coba lagi nanti.';
    }
    
    if (alertEl) {
      alertEl.className = 'alert alert-danger alert-dismissible fade show';
      const alertMessage = document.getElementById('alert-message');
      if (alertMessage) {
        alertMessage.textContent = errorMsg;
      } else {
        alertEl.textContent = errorMsg;
      }
      alertEl.classList.remove('d-none');
      alertEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
      alert(errorMsg);
    }
  } finally {
    if (btn) {
      btn.disabled = false;
      btn.textContent = prevText;
    }
  }
});
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Pastikan Bootstrap sudah dimuat sebelum menggunakan fitur alert dismiss
document.addEventListener('DOMContentLoaded', function() {
  // Inisialisasi alert dismiss jika diperlukan
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(function(alert) {
    alert.addEventListener('closed.bs.alert', function() {
      this.classList.add('d-none');
    });
  });
});
</script>
</body>
</html>