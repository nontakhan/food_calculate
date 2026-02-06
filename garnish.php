<?php
include "session.php";
include '_db/connect.php';
$menu = "garnish";
$csrf_token = generateCsrfToken();
?>
<?php include("header.php"); ?>

<section class="content-header">
  <div class="container-fluid">
    <h1><i class="fas fa-seedling me-2"></i>จัดการข้อมูลวัตถุดิบโรยหน้า</h1>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">วัตถุดิบโรยหน้าทั้งหมด</h5>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
          <i class="fas fa-plus me-1"></i>เพิ่มวัตถุดิบโรยหน้า
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 10%;">ลำดับ</th>
              <th style="width: 50%;">ชื่อวัตถุดิบโรยหน้า</th>
              <th style="width: 20%;">หน่วย</th>
              <th style="width: 20%;">จัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM garnish ORDER BY garnish_id ASC";
            $res = mysqli_query($conn, $sql);
            $i = 1;
            while ($row = mysqli_fetch_array($res)) { ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= h($row['garnish_name']) ?></td>
                <td><?= h($row['garnish_unit'] ?? '-') ?></td>
                <td>
                  <button class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row['garnish_id'] ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-xs" onclick="confirmDelete('crud/garnish_delete.php?garnish_id=<?= $row['garnish_id'] ?>&token=<?= $csrf_token ?>')">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              
              <div class="modal fade" id="modalUpdate<?= $row['garnish_id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><i class="fas fa-edit me-2"></i>แก้ไขวัตถุดิบโรยหน้า</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="crud/garnish_update.php" method="POST">
                      <div class="modal-body">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="garnish_id" value="<?= $row['garnish_id'] ?>">
                        <div class="mb-3">
                          <label class="form-label">ชื่อวัตถุดิบโรยหน้า</label>
                          <input type="text" class="form-control" name="garnish_name" value="<?= h($row['garnish_name']) ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">หน่วย</label>
                          <input type="text" class="form-control" name="garnish_unit" value="<?= h($row['garnish_unit'] ?? '') ?>">
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
          <h5 class="modal-title"><i class="fas fa-plus me-2"></i>เพิ่มวัตถุดิบโรยหน้า</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="crud/garnish_insert.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="mb-3">
              <label class="form-label">ชื่อวัตถุดิบโรยหน้า</label>
              <input type="text" class="form-control" name="garnish_name" required placeholder="กรอกชื่อวัตถุดิบโรยหน้า">
            </div>
            <div class="mb-3">
              <label class="form-label">หน่วย</label>
              <input type="text" class="form-control" name="garnish_unit" placeholder="กรอกหน่วย (ถ้ามี)">
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
