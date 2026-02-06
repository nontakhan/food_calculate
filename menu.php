<?php
include "session.php";
include '_db/connect.php';
$menu = "menu";
$csrf_token = generateCsrfToken();
?>
<?php include("header.php"); ?>

<section class="content-header">
  <div class="container-fluid">
    <h1><i class="fas fa-utensils me-2"></i>จัดการข้อมูลรายการอาหาร</h1>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">รายการอาหารทั้งหมด</h5>
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
          <i class="fas fa-plus me-1"></i>เพิ่มรายการอาหาร
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 10%;">ลำดับ</th>
              <th style="width: 45%;">รายการอาหาร</th>
              <th style="width: 30%;">ประเภท</th>
              <th style="width: 15%;">จัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT m.menu_id, m.menu_name, t.menu_type_name, m.menu_type_id FROM menu m LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id ORDER BY m.menu_id ASC";
            $res = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($res)) { ?>
              <tr>
                <td><?= h($row['menu_id']) ?></td>
                <td><?= h($row['menu_name']) ?></td>
                <td><span class="badge bg-info"><?= h($row['menu_type_name']) ?></span></td>
                <td>
                  <button class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $row['menu_id'] ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-xs" onclick="confirmDelete('crud/menu_delete.php?menu_id=<?= $row['menu_id'] ?>&token=<?= $csrf_token ?>')">
                    <i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              
              <!-- Modal Update -->
              <div class="modal fade" id="modalUpdate<?= $row['menu_id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><i class="fas fa-edit me-2"></i>แก้ไขรายการอาหาร</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="crud/menu_update.php" method="POST">
                      <div class="modal-body">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="menu_id" value="<?= $row['menu_id'] ?>">
                        <div class="mb-3">
                          <label class="form-label">ชื่อรายการอาหาร</label>
                          <input type="text" class="form-control" name="menu_name" value="<?= h($row['menu_name']) ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">ประเภท</label>
                          <select name="menu_type" class="form-select" required>
                            <option value="">-- กรุณาเลือก --</option>
                            <?php
                            $typeQuery = mysqli_query($conn, "SELECT * FROM menu_type");
                            while($type = mysqli_fetch_array($typeQuery)) {
                              $selected = ($row['menu_type_id'] == $type['menu_type_id']) ? 'selected' : '';
                            ?>
                            <option value="<?= $type['menu_type_id'] ?>" <?= $selected ?>><?= h($type['menu_type_name']) ?></option>
                            <?php } ?>
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
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Add -->
  <div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-plus me-2"></i>เพิ่มรายการอาหาร</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="crud/menu_insert.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <div class="mb-3">
              <label class="form-label">ชื่อรายการอาหาร</label>
              <input type="text" class="form-control" name="menu_name" required placeholder="กรอกชื่อรายการอาหาร">
            </div>
            <div class="mb-3">
              <label class="form-label">ประเภท</label>
              <select name="menu_type" class="form-select" required>
                <option value="">-- กรุณาเลือก --</option>
                <?php
                $typeQuery2 = mysqli_query($conn, "SELECT * FROM menu_type");
                while($type2 = mysqli_fetch_array($typeQuery2)) { ?>
                <option value="<?= $type2['menu_type_id'] ?>"><?= h($type2['menu_type_name']) ?></option>
                <?php } ?>
              </select>
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
