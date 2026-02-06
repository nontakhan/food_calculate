<?php
include "session.php";
include '_db/connect.php';
$menu = "factor";
$csrf_token = generateCsrfToken();
?>
<?php include("header.php"); ?>

<section class="content-header">
  <div class="container-fluid">
    <h1><i class="fas fa-percentage me-2"></i>จัดการข้อมูล Factor</h1>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">ข้อมูล Factor ทั้งหมด</h5>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
          <i class="fas fa-plus me-1"></i>เพิ่ม Factor
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 10%;">ลำดับ</th>
              <th style="width: 50%;">ชื่อ Factor</th>
              <th style="width: 20%;">ค่า Factor</th>
              <th style="width: 20%;">จัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM factor ORDER BY factor_id ASC";
            $res = mysqli_query($conn, $sql);
            $i = 1;
            while ($row = mysqli_fetch_array($res)) { ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= h($row['factor_name']) ?></td>
                <td><span class="badge bg-primary"><?= h($row['factor_value']) ?></span></td>
                <td>
                  <button class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row['factor_id'] ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-xs" onclick="confirmDelete('crud/factor_delete.php?factor_id=<?= $row['factor_id'] ?>&token=<?= $csrf_token ?>')">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              
              <div class="modal fade" id="modalUpdate<?= $row['factor_id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><i class="fas fa-edit me-2"></i>แก้ไข Factor</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="crud/factor_update.php" method="POST">
                      <div class="modal-body">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="factor_id" value="<?= $row['factor_id'] ?>">
                        <div class="mb-3">
                          <label class="form-label">ชื่อ Factor</label>
                          <input type="text" class="form-control" name="factor_name" value="<?= h($row['factor_name']) ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">ค่า Factor</label>
                          <input type="number" step="0.01" class="form-control" name="factor_value" value="<?= h($row['factor_value']) ?>" required>
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
          <h5 class="modal-title"><i class="fas fa-plus me-2"></i>เพิ่ม Factor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="crud/factor_insert.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="mb-3">
              <label class="form-label">ชื่อ Factor</label>
              <input type="text" class="form-control" name="factor_name" required placeholder="กรอกชื่อ Factor">
            </div>
            <div class="mb-3">
              <label class="form-label">ค่า Factor</label>
              <input type="number" step="0.01" class="form-control" name="factor_value" required placeholder="กรอกค่า Factor">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
            <button type="submit" name="save" class="btn btn-success">เพิ่มข้อมูล</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); ?>
</body>
</html>
