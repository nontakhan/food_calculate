<?php
include "session.php";
include '_db/connect.php';
$menu = "user";
$csrf_token = generateCsrfToken();

// Only admin can access
if (($_SESSION['level'] ?? '') !== 'admin') {
    alertRedirect('คุณไม่มีสิทธิ์เข้าถึงหน้านี้', 'menu.php');
}
?>
<?php include("header.php"); ?>

<section class="content-header">
  <div class="container-fluid">
    <h1><i class="fas fa-users-cog me-2"></i>จัดการข้อมูลผู้ใช้งาน</h1>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">ผู้ใช้งานทั้งหมด</h5>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
          <i class="fas fa-user-plus me-1"></i>เพิ่มผู้ใช้งาน
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 10%;">ลำดับ</th>
              <th style="width: 30%;">ชื่อผู้ใช้</th>
              <th style="width: 20%;">ระดับ</th>
              <th style="width: 20%;">สถานะ</th>
              <th style="width: 20%;">จัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM user ORDER BY id ASC";
            $res = mysqli_query($conn, $sql);
            $i = 1;
            while ($row = mysqli_fetch_array($res)) { ?>
              <tr>
                <td><?= $i ?></td>
                <td><i class="fas fa-user me-2"></i><?= h($row['username']) ?></td>
                <td>
                  <?php if($row['level'] == 'admin'): ?>
                    <span class="badge bg-danger"><i class="fas fa-shield-alt me-1"></i>Admin</span>
                  <?php else: ?>
                    <span class="badge bg-secondary"><i class="fas fa-user me-1"></i>User</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if($row['status'] == 'Y'): ?>
                    <span class="badge bg-success"><i class="fas fa-check me-1"></i>ใช้งาน</span>
                  <?php else: ?>
                    <span class="badge bg-warning"><i class="fas fa-times me-1"></i>ระงับ</span>
                  <?php endif; ?>
                </td>
                <td>
                  <button class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row['id'] ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-xs" onclick="confirmDelete('crud/user_delete.php?user_id=<?= $row['id'] ?>&token=<?= $csrf_token ?>')">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              
              <div class="modal fade" id="modalUpdate<?= $row['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><i class="fas fa-user-edit me-2"></i>แก้ไขผู้ใช้งาน</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="crud/user_update.php" method="POST">
                      <div class="modal-body">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                        <div class="mb-3">
                          <label class="form-label">ชื่อผู้ใช้</label>
                          <input type="text" class="form-control" name="username" value="<?= h($row['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">รหัสผ่านใหม่ <small class="text-muted">(เว้นว่างถ้าไม่ต้องการเปลี่ยน)</small></label>
                          <input type="password" class="form-control" name="password" placeholder="กรอกรหัสผ่านใหม่">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">ระดับ</label>
                          <select name="level" class="form-select" required>
                            <option value="user" <?= $row['level'] == 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $row['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">สถานะ</label>
                          <select name="status" class="form-select" required>
                            <option value="Y" <?= $row['status'] == 'Y' ? 'selected' : '' ?>>ใช้งาน</option>
                            <option value="N" <?= $row['status'] == 'N' ? 'selected' : '' ?>>ระงับ</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" name="update" class="btn btn-warning">บันทึกการแก้ไข</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php $i++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>เพิ่มผู้ใช้งาน</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="crud/user_insert.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="mb-3">
              <label class="form-label">ชื่อผู้ใช้</label>
              <input type="text" class="form-control" name="username" required placeholder="กรอกชื่อผู้ใช้">
            </div>
            <div class="mb-3">
              <label class="form-label">รหัสผ่าน</label>
              <input type="password" class="form-control" name="password" required placeholder="กรอกรหัสผ่าน">
            </div>
            <div class="mb-3">
              <label class="form-label">ระดับ</label>
              <select name="level" class="form-select" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">สถานะ</label>
              <select name="status" class="form-select" required>
                <option value="Y" selected>ใช้งาน</option>
                <option value="N">ระงับ</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
            <button type="submit" name="save" class="btn btn-success">เพิ่มผู้ใช้งาน</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); ?>
</body>
</html>
