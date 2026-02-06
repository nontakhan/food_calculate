<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="ระบบคำนวณวัตถุดิบอาหาร - โรงพยาบาลเทพา">
  <title>เข้าสู่ระบบ - ระบบคำนวณวัตถุดิบอาหาร</title>
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  
  <!-- Google Font: Kanit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body {
      font-family: 'Kanit', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #1e3a5f 0%, #0d2137 50%, #1a1a2e 100%);
      position: relative;
      overflow: hidden;
    }
    
    .bg-animation {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      overflow: hidden;
      z-index: 0;
    }
    
    .bg-animation::before {
      content: '';
      position: absolute;
      top: -50%; left: -50%;
      width: 200%; height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.03) 1px, transparent 1px);
      background-size: 50px 50px;
      animation: bgMove 20s linear infinite;
    }
    
    @keyframes bgMove {
      0% { transform: translate(0, 0); }
      100% { transform: translate(50px, 50px); }
    }
    
    .floating-shapes { position: absolute; width: 100%; height: 100%; overflow: hidden; }
    
    .shape {
      position: absolute;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 50%;
      animation: float 15s infinite;
    }
    
    .shape:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-delay: 0s; }
    .shape:nth-child(2) { width: 120px; height: 120px; top: 70%; left: 80%; animation-delay: 2s; }
    .shape:nth-child(3) { width: 60px; height: 60px; top: 40%; left: 70%; animation-delay: 4s; }
    .shape:nth-child(4) { width: 100px; height: 100px; top: 80%; left: 20%; animation-delay: 6s; }
    
    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.5; }
      50% { transform: translateY(-30px) rotate(180deg); opacity: 0.8; }
    }
    
    .login-container {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 440px;
      padding: 20px;
    }
    
    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
      overflow: hidden;
    }
    
    .login-header {
      background: linear-gradient(135deg, #1e3a5f 0%, #0d2137 100%);
      padding: 40px 30px;
      text-align: center;
      position: relative;
    }
    
    .login-header::after {
      content: '';
      position: absolute;
      bottom: -20px; left: 50%;
      transform: translateX(-50%);
      border-left: 25px solid transparent;
      border-right: 25px solid transparent;
      border-top: 20px solid #0d2137;
    }
    
    .logo-wrapper {
      width: 90px; height: 90px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 50%;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 3px solid rgba(255, 255, 255, 0.3);
    }
    
    .logo-wrapper img { width: 60px; height: 60px; object-fit: contain; }
    .logo-wrapper i { font-size: 40px; color: #fff; }
    
    .login-header h1 { color: #fff; font-size: 1.5rem; font-weight: 600; margin-bottom: 8px; }
    .login-header p { color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin: 0; }
    
    .login-body { padding: 50px 35px 35px; }
    
    .form-floating { margin-bottom: 20px; }
    
    .form-floating .form-control {
      height: 58px;
      border-radius: 12px;
      border: 2px solid #e9ecef;
      padding-left: 50px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    
    .form-floating .form-control:focus {
      border-color: #1e3a5f;
      box-shadow: 0 0 0 4px rgba(30, 58, 95, 0.1);
    }
    
    .form-floating label { padding-left: 50px; color: #6c757d; }
    
    .form-floating .input-icon {
      position: absolute;
      left: 18px; top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
      font-size: 1.1rem;
      z-index: 5;
      transition: color 0.3s ease;
    }
    
    .form-floating:focus-within .input-icon { color: #1e3a5f; }
    
    .password-toggle {
      position: absolute;
      right: 18px; top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #6c757d;
      cursor: pointer;
      z-index: 5;
    }
    
    .password-toggle:hover { color: #1e3a5f; }
    
    .btn-login {
      width: 100%;
      height: 54px;
      background: linear-gradient(135deg, #1e3a5f 0%, #0d2137 100%);
      border: none;
      border-radius: 12px;
      color: #fff;
      font-size: 1.1rem;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(30, 58, 95, 0.4);
      color: #fff;
    }
    
    .login-footer {
      text-align: center;
      padding: 25px 35px 30px;
      background: #f8f9fa;
      border-top: 1px solid #e9ecef;
    }
    
    .login-footer p { color: #6c757d; font-size: 0.85rem; margin: 0; }
    
    @media (max-width: 480px) {
      .login-container { padding: 15px; }
      .login-header { padding: 30px 20px; }
      .login-body { padding: 40px 25px 25px; }
      .login-footer { padding: 20px 25px; }
      .logo-wrapper { width: 70px; height: 70px; }
      .logo-wrapper i { font-size: 32px; }
      .login-header h1 { font-size: 1.25rem; }
    }
    
    .spinner {
      display: none;
      width: 20px; height: 20px;
      border: 2px solid transparent;
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin-right: 10px;
    }
    
    @keyframes spin { to { transform: rotate(360deg); } }
    .btn-login.loading .spinner { display: inline-block; }
  </style>
</head>
<body>
  <div class="bg-animation">
    <div class="floating-shapes">
      <div class="shape"></div>
      <div class="shape"></div>
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
  </div>
  
  <div class="login-container animate__animated animate__fadeIn">
    <div class="login-card">
      <div class="login-header">
        <div class="logo-wrapper">
          <img src="images/logo.png" alt="Logo" onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\'fas fa-utensils\'></i>';">
        </div>
        <h1>ระบบคำนวณวัตถุดิบอาหาร</h1>
        <p>โรงพยาบาลเทพา</p>
      </div>
      
      <div class="login-body">
        <form id="loginForm" method="post" action="check_login.php">
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
          
          <div class="form-floating position-relative">
            <i class="fas fa-user input-icon"></i>
            <input type="text" class="form-control" id="username1" name="username1" placeholder="ชื่อผู้ใช้" required autocomplete="username">
            <label for="username1">ชื่อผู้ใช้</label>
          </div>
          
          <div class="form-floating position-relative">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" class="form-control" id="password1" name="password1" placeholder="รหัสผ่าน" required autocomplete="current-password">
            <label for="password1">รหัสผ่าน</label>
            <button type="button" class="password-toggle" onclick="togglePassword()">
              <i class="fas fa-eye" id="toggleIcon"></i>
            </button>
          </div>
          
          <button type="submit" class="btn btn-login" id="btnLogin">
            <span class="spinner"></span>
            <span class="btn-text"><i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ</span>
          </button>
        </form>
      </div>
      
      <div class="login-footer">
        <p>&copy; <?= date('Y'); ?> โรงพยาบาลเทพา. สงวนลิขสิทธิ์.</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script>
    function togglePassword() {
      const p = document.getElementById('password1');
      const i = document.getElementById('toggleIcon');
      if (p.type === 'password') {
        p.type = 'text';
        i.classList.remove('fa-eye');
        i.classList.add('fa-eye-slash');
      } else {
        p.type = 'password';
        i.classList.remove('fa-eye-slash');
        i.classList.add('fa-eye');
      }
    }
    
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      const btn = document.getElementById('btnLogin');
      const u = document.getElementById('username1').value.trim();
      const p = document.getElementById('password1').value.trim();
      if (!u || !p) {
        e.preventDefault();
        Swal.fire({ icon: 'warning', title: 'กรุณากรอกข้อมูล', text: 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน', confirmButtonColor: '#1e3a5f' });
        return;
      }
      btn.classList.add('loading');
      btn.disabled = true;
    });
    
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('error') === 'invalid') {
      Swal.fire({ icon: 'error', title: 'เข้าสู่ระบบไม่สำเร็จ', text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง', confirmButtonColor: '#1e3a5f' });
    }
  </script>
</body>
</html>
