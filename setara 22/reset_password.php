<?php
$token = $_GET['token'] ?? '';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Reset Password - Setara Kids</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4">
          <h3 class="mb-3">Reset Password</h3>
          <div id="alert" class="alert d-none" role="alert"></div>

          <form id="reset-form">
            <input type="hidden" id="token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="mb-3">
              <label for="password" class="form-label">Password Baru</label>
              <input id="password" type="password" class="form-control" placeholder="Password minimal 6 karakter">
            </div>
            <div class="mb-3">
              <label for="password2" class="form-label">Ulangi Password</label>
              <input id="password2" type="password" class="form-control" placeholder="Ulangi password">
            </div>

            <button class="btn btn-primary" type="submit">Simpan Password</button>
            <a href="login.html" class="btn btn-link">Kembali ke Masuk</a>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
document.getElementById('reset-form').addEventListener('submit', async function(e){
  e.preventDefault();
  const token = document.getElementById('token').value;
  const p1 = document.getElementById('password').value;
  const p2 = document.getElementById('password2').value;
  const alertEl = document.getElementById('alert');
  alertEl.classList.add('d-none');

  if (!token) { alertEl.className = 'alert alert-danger'; alertEl.textContent = 'Token tidak ditemukan.'; alertEl.classList.remove('d-none'); return; }
  if (p1.length < 6) { alertEl.className = 'alert alert-warning'; alertEl.textContent = 'Password minimal 6 karakter.'; alertEl.classList.remove('d-none'); return; }
  if (p1 !== p2) { alertEl.className = 'alert alert-warning'; alertEl.textContent = 'Password tidak cocok.'; alertEl.classList.remove('d-none'); return; }

  try {
    const res = await fetch('api/reset_password.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ token, password: p1 })
    });
    const data = await res.json();
    if (res.ok && data.success) {
      alertEl.className = 'alert alert-success';
      alertEl.textContent = data.message || 'Password berhasil diubah. Silakan login.';
    } else {
      alertEl.className = 'alert alert-danger';
      alertEl.textContent = data.message || 'Terjadi kesalahan.';
    }
  } catch (err) {
    alertEl.className = 'alert alert-danger';
    alertEl.textContent = 'Kesalahan koneksi.';
  }
});
</script>
</body>
</html>