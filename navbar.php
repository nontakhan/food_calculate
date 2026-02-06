<nav class="main-header">
  <button class="sidebar-toggle" type="button" id="sidebarToggle">
    <i class="fas fa-bars"></i>
  </button>
  
  <nav aria-label="breadcrumb" class="d-none d-sm-block">
    <ol class="breadcrumb mb-0 bg-transparent p-0" style="font-size: 0.85rem;">
      <li class="breadcrumb-item"><a href="calculate.php" class="text-decoration-none"><i class="fas fa-home"></i></a></li>
      <li class="breadcrumb-item active">ระบบคำนวณวัตถุดิบอาหาร</li>
    </ol>
  </nav>
  
  <div class="ms-auto">
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
        <span class="d-none d-md-inline me-2"><?= htmlspecialchars($_SESSION['ses_username'] ?? 'ผู้ใช้งาน'); ?></span>
        <i class="fas fa-user-circle fa-lg"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow-sm">
        <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ</a></li>
      </ul>
    </div>
  </div>
</nav>
