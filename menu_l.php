<aside class="main-sidebar">
  <a href="calculate.php" class="brand-link">
    <img src="images/logo.png" alt="Logo" onerror="this.src='https://via.placeholder.com/40'">
    <span class="brand-text">ระบบคำนวณวัตถุดิบ</span>
  </a>
  
  <div class="sidebar">
    <ul class="nav-sidebar">
      <li class="nav-header">Dashboard</li>
      <li class="nav-item">
        <a href="calculate.php" class="nav-link <?= ($menu ?? '') == 'calculate' ? 'active' : '' ?>">
          <i class="fas fa-calculator"></i>
          <p>คำนวณวัตถุดิบอาหาร</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="history.php" class="nav-link <?= ($menu ?? '') == 'history' ? 'active' : '' ?>">
          <i class="fas fa-history"></i>
          <p>ประวัติการคำนวณ</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="report.php" class="nav-link <?= ($menu ?? '') == 'report' ? 'active' : '' ?>">
          <i class="fas fa-file-alt"></i>
          <p>พิมพ์สรุปรายการ</p>
        </a>
      </li>

      <li class="nav-header">จัดการข้อมูล</li>
      <li class="nav-item">
        <a href="menu.php" class="nav-link <?= ($menu ?? '') == 'menu' ? 'active' : '' ?>">
          <i class="fas fa-utensils"></i>
          <p>เมนูอาหาร</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="staple.php" class="nav-link <?= ($menu ?? '') == 'staple' ? 'active' : '' ?>">
          <i class="fas fa-carrot"></i>
          <p>วัตถุดิบ</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="staple_type.php" class="nav-link <?= ($menu ?? '') == 'staple-type' ? 'active' : '' ?>">
          <i class="fas fa-layer-group"></i>
          <p>ประเภทวัตถุดิบ</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="factor.php" class="nav-link <?= ($menu ?? '') == 'factor' ? 'active' : '' ?>">
          <i class="fas fa-percentage"></i>
          <p>ข้อมูล Factor</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="menu_type.php" class="nav-link <?= ($menu ?? '') == 'menu_type' ? 'active' : '' ?>">
          <i class="fas fa-tags"></i>
          <p>ประเภทเมนู</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="garnish.php" class="nav-link <?= ($menu ?? '') == 'garnish' ? 'active' : '' ?>">
          <i class="fas fa-seedling"></i>
          <p>วัตถุดิบโรยหน้า</p>
        </a>
      </li>

      <?php if (isset($_SESSION['level']) && $_SESSION['level'] == 'admin') { ?>
      <li class="nav-header">จัดการระบบ</li>
      <li class="nav-item">
        <a href="user.php" class="nav-link <?= ($menu ?? '') == 'user' ? 'active' : '' ?>">
          <i class="fas fa-users-cog"></i>
          <p>ผู้ใช้งาน</p>
        </a>
      </li>
      <?php } ?>

      <li class="nav-header">บัญชี</li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link text-danger">
          <i class="fas fa-sign-out-alt"></i>
          <p>ออกจากระบบ</p>
        </a>
      </li>
    </ul>
  </div>
</aside>
