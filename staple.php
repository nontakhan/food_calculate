<?php
include "session.php";
include '_db/connect.php';
$menu = "staple";
$csrf_token = generateCsrfToken();
?>
<?php include("header.php"); ?>

<section class="content-header">
  <div class="container-fluid">
    <h1><i class="fas fa-carrot me-2"></i>จัดการข้อมูลวัตถุดิบ</h1>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">วัตถุดิบทั้งหมด</h5>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
          <i class="fas fa-plus me-1"></i>เพิ่มวัตถุดิบ
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 5%;">ลำดับ</th>
              <th style="width: 20%;">วัตถุดิบ</th>
              <th style="width: 10%;">ปริมาณเสิร์ฟ</th>
              <th style="width: 20%;">รายการอาหาร</th>
              <th style="width: 8%;">%yield</th>
              <th style="width: 15%;">ประเภท</th>
              <th style="width: 7%;">ปลา</th>
              <th style="width: 15%;">จัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT s.*, m.menu_name, m.menu_id, t.staple_type_name
                    FROM staple s 
                    LEFT JOIN menu m ON m.menu_id = s.menu_id
                    LEFT JOIN staple_type t ON t.id = s.staple_type_id 
                    ORDER BY m.menu_name";
            $res = mysqli_query($conn, $sql);
            $i = 1;
            while ($row = mysqli_fetch_array($res)) { ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= h($row['staple_name']) ?></td>
                <td><?= h($row['staple_serve']) ?></td>
                <td><span class="badge bg-info"><?= h($row['menu_name']) ?></span></td>
                <td><?= h($row['staple_yield']) ?></td>
                <td><?= h($row['staple_type_name']) ?></td>
                <td>
                  <?php if($row['is_fish'] == 1): ?>
                    <span class="badge bg-primary">ใช่</span>
                  <?php else: ?>
                    <span class="badge bg-secondary">ไม่ใช่</span>
                  <?php endif; ?>
                </td>
                <td>
                  <button class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row['staple_id'] ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-xs" onclick="confirmDelete('crud/staple_delete.php?staple_id=<?= $row['staple_id'] ?>&token=<?= $csrf_token ?>')">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              
              <div class="modal fade" id="modalUpdate<?= $row['staple_id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><i class="fas fa-edit me-2"></i>แก้ไขวัตถุดิบ</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="crud/staple_update.php" method="POST">
                      <div class="modal-body">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="staple_id" value="<?= $row['staple_id'] ?>">
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label class="form-label">ชื่อวัตถุดิบ</label>
                            <input type="text" class="form-control" name="staple_name" value="<?= h($row['staple_name']) ?>" required>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">ปริมาณต่อ 1 เสิร์ฟ</label>
                            <input type="number" step="0.1" class="form-control" name="staple_serve" value="<?= h($row['staple_serve']) ?>" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label class="form-label">รายการอาหาร</label>
                            <select name="menu_id" class="form-select" required>
                              <?php
                              $menuQuery = mysqli_query($conn, "SELECT * FROM menu ORDER BY menu_name");
                              while($menuRow = mysqli_fetch_array($menuQuery)) {
                                $selected = ($row['menu_id'] == $menuRow['menu_id']) ? 'selected' : '';
                              ?>
                              <option value="<?= $menuRow['menu_id'] ?>" <?= $selected ?>><?= h($menuRow['menu_name']) ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">ประเภทวัตถุดิบ</label>
                            <select name="staple_type_id" class="form-select" required>
                              <?php
                              $typeQuery = mysqli_query($conn, "SELECT * FROM staple_type");
                              while($typeRow = mysqli_fetch_array($typeQuery)) {
                                $selected = ($row['staple_type_id'] == $typeRow['id']) ? 'selected' : '';
                              ?>
                              <option value="<?= $typeRow['id'] ?>" <?= $selected ?>><?= h($typeRow['staple_type_name']) ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label class="form-label">%yield</label>
                            <input type="number" step="0.01" class="form-control" name="staple_yield" value="<?= h($row['staple_yield']) ?>">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">เป็นปลาหรือไม่</label>
                            <select name="is_fish" class="form-select">
                              <option value="0" <?= $row['is_fish'] == 0 ? 'selected' : '' ?>>ไม่ใช่</option>
                              <option value="1" <?= $row['is_fish'] == 1 ? 'selected' : '' ?>>ใช่</option>
                            </select>
                          </div>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-plus me-2"></i>เพิ่มวัตถุดิบ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="crud/staple_insert.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">ชื่อวัตถุดิบ</label>
                <input type="text" class="form-control" name="staple_name" required placeholder="กรอกชื่อวัตถุดิบ">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">ปริมาณต่อ 1 เสิร์ฟ</label>
                <input type="number" step="0.1" class="form-control" name="staple_serve" required placeholder="0.0">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">รายการอาหาร</label>
                <select name="menu_id" class="form-select" required>
                  <option value="">-- เลือกรายการอาหาร --</option>
                  <?php
                  $menuQuery2 = mysqli_query($conn, "SELECT * FROM menu ORDER BY menu_name");
                  while($menuRow2 = mysqli_fetch_array($menuQuery2)) { ?>
                  <option value="<?= $menuRow2['menu_id'] ?>"><?= h($menuRow2['menu_name']) ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">ประเภทวัตถุดิบ</label>
                <select name="staple_type_id" class="form-select" required>
                  <option value="">-- เลือกประเภท --</option>
                  <?php
                  $typeQuery2 = mysqli_query($conn, "SELECT * FROM staple_type");
                  while($typeRow2 = mysqli_fetch_array($typeQuery2)) { ?>
                  <option value="<?= $typeRow2['id'] ?>"><?= h($typeRow2['staple_type_name']) ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">%yield</label>
                <input type="number" step="0.01" class="form-control" name="staple_yield" placeholder="0.00">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">เป็นปลาหรือไม่</label>
                <select name="is_fish" class="form-select">
                  <option value="0" selected>ไม่ใช่</option>
                  <option value="1">ใช่</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
            <button type="submit" name="save" class="btn btn-success">เพิ่มวัตถุดิบ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); ?>
</body>
</html>
