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
        <table id="menuTable" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 10%;">ลำดับ</th>
              <th style="width: 45%;">รายการอาหาร</th>
              <th style="width: 30%;">ประเภท</th>
              <th style="width: 15%;">จัดการ</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <?php
  // Pre-load menu_type options once (for modals)
  $typeOptions = [];
  $typeQuery = mysqli_query($conn, "SELECT menu_type_id, menu_type_name FROM menu_type");
  while($t = mysqli_fetch_array($typeQuery)) { $typeOptions[] = $t; }
  ?>

  <!-- Single Edit Modal (reused for all rows) -->
  <div class="modal fade" id="modalUpdate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-edit me-2"></i>แก้ไขรายการอาหาร</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="crud/menu_update.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="hidden" name="menu_id" id="edit_menu_id">
            <div class="mb-3">
              <label class="form-label">ชื่อรายการอาหาร</label>
              <input type="text" class="form-control" name="menu_name" id="edit_menu_name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">ประเภท</label>
              <select name="menu_type" id="edit_menu_type" class="form-select" required>
                <option value="">-- กรุณาเลือก --</option>
                <?php foreach($typeOptions as $t): ?>
                <option value="<?= $t['menu_type_id'] ?>"><?= h($t['menu_type_name']) ?></option>
                <?php endforeach; ?>
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
                <?php foreach($typeOptions as $t): ?>
                <option value="<?= $t['menu_type_id'] ?>"><?= h($t['menu_type_name']) ?></option>
                <?php endforeach; ?>
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

<script>
var csrfToken = <?= json_encode($csrf_token) ?>;

$(document).ready(function() {
  var menuTable = $('#menuTable').DataTable({
    processing: true,
    serverSide: true,
    deferRender: true,
    ajax: {
      url: 'crud/menu_api.php',
      type: 'GET'
    },
    columns: [
      { data: 'menu_id', className: 'text-center' },
      { data: 'menu_name' },
      { data: 'menu_type_name' },
      { data: null, orderable: false, className: 'text-center',
        render: function(data, type, row) {
          return '<button class="btn btn-warning btn-xs btn-edit-menu" data-raw=\'' + JSON.stringify(row.raw) + '\'>' +
                 '<i class="fas fa-edit"></i></button> ' +
                 '<button class="btn btn-danger btn-xs" onclick="confirmDelete(\'crud/menu_delete.php?menu_id=' + row.raw.menu_id + '&token=' + csrfToken + '\')">' +
                 '<i class="fas fa-trash"></i></button>';
        }
      }
    ],
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/th.json',
      processing: '<i class="fas fa-spinner fa-spin"></i> กำลังโหลด...'
    },
    pageLength: 25,
    lengthMenu: [[25, 50, 100], [25, 50, 100]],
    responsive: true
  });

  // Edit button click - populate single modal
  $('#menuTable').on('click', '.btn-edit-menu', function() {
    var raw = $(this).data('raw');
    $('#edit_menu_id').val(raw.menu_id);
    $('#edit_menu_name').val(raw.menu_name);
    $('#edit_menu_type').val(raw.menu_type_id);
    var modal = new bootstrap.Modal(document.getElementById('modalUpdate'));
    modal.show();
  });
});
</script>
</body>
</html>
