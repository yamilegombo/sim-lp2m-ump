<?php
declare(strict_types=1);
require_once __DIR__ . '/config/auth.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
$old_email = $_SESSION['old_email'] ?? '';
unset($_SESSION['old_email']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - SI Hibah LP2M UM Papua</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="login-page">
  <div class="login-shell">
    <section class="login-brand">
      <img src="assets/img/.jpg" class="login-logo" alt="Logo LP2M">
      <h1>LP2M</h1>
      <div class="university">UNIVERSITAS MUHAMMADIYAH PAPUA</div>

      <div class="system-title">
        Sistem Informasi Pengelolaan<br>
        Hibah Penelitian dan Pengabdian
      </div>

      <div class="description">
        Sistem ini digunakan untuk mengelola proses pengajuan,
        penilaian, monitoring dan pelaporan hibah penelitian
        dan pengabdian.
      </div>

      <div class="login-illustration" aria-hidden="true">
        <div class="monitor"></div>
        <div class="phone"></div>
      </div>
    </section>

    <section class="login-form-side">
      <div class="login-card">
        <h2>Login ke Sistem</h2>
        <div class="subtitle">Masukkan email dan password Anda</div>

        <?php if ($error): ?>
          <div class="alert alert-danger py-2 small"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST" autocomplete="on">
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">

          <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= htmlspecialchars($old_email) ?>"
                   placeholder="Masukkan email" autocomplete="username" required autofocus>
          </div>

          <div class="mb-2">
            <label class="form-label" for="password">Password</label>
            <div class="password-wrap">
              <input type="password" class="form-control" id="password" name="password"
                     placeholder="Masukkan password" autocomplete="current-password" required>
              <button type="button" class="password-toggle" id="togglePassword" aria-label="Tampilkan password">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <div class="login-options">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
              <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <a href="#" onclick="alert('Fitur lupa password dapat ditambahkan menggunakan email/OTP.')">Lupa Password?</a>
          </div>

          <button class="login-btn" type="submit">Login</button>
        </form>

        <div class="login-footer">
          Belum punya akun?
          <a href="#" onclick="alert('Silakan hubungi Admin LP2M untuk pembuatan akun.')">Hubungi Admin LP2M</a>
        </div>

        <div class="demo-box">
          <strong>Akun demo:</strong><br>
          Admin: admin@lp2m.umpapua.ac.id / admin123<br>
          Dosen: dosen@umpapua.ac.id / dosen123<br>
          Reviewer: reviewer@umpapua.ac.id / reviewer123
        </div>
      </div>
    </section>
  </div>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
  const input = document.getElementById('password');
  const icon = this.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.className = 'bi bi-eye-slash';
  } else {
    input.type = 'password';
    icon.className = 'bi bi-eye';
  }
});
</script>
</body>
</html>
