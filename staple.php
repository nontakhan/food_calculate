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
        <table id="stapleTable" class="table table-bordered table-striped table-hover">
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
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <?php
  // Pre-load menu and staple_type options once (for modals)
  $menuOptions = [];
  $menuQuery = mysqli_query($conn, "SELECT menu_id, menu_name FROM menu ORDER BY menu_name");
  while($m = mysqli_fetch_array($menuQuery)) { $menuOptions[] = $m; }

  $typeOptions = [];
  $typeQuery = mysqli_query($conn, "SELECT id, staple_type_name FROM staple_type");
  while($t = mysqli_fetch_array($typeQuery)) { $typeOptions[] = $t; }
  ?>

  <!-- Single Edit Modal (reused for all rows) -->
  <div class="modal fade" id="modalUpdate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-edit me-2"></i>แก้ไขวัตถุดิบ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="crud/staple_update.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            <input type="hidden" name="staple_id" id="edit_staple_id">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">ชื่อวัตถุดิบ</label>
                <input type="text" class="form-control" name="staple_name" id="edit_staple_name" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">ปริมาณต่อ 1 เสิร์ฟ</label>
                <input type="number" step="0.1" class="form-control" name="staple_serve" id="edit_staple_serve" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">รายการอาหาร</label>
                <select name="menu_id" id="edit_menu_id" class="form-select" required>
                  <?php foreach($menuOptions as $m): ?>
                  <option value="<?= $m['menu_id'] ?>"><?= h($m['menu_name']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">ประเภทวัตถุดิบ</label>
                <select name="staple_type_id" id="edit_staple_type_id" class="form-select" required>
                  <?php foreach($typeOptions as $t): ?>
                  <option value="<?= $t['id'] ?>"><?= h($t['staple_type_name']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">%yield</label>
                <input type="number" step="0.01" class="form-control" name="staple_yield" id="edit_staple_yield">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">เป็นปลาหรือไม่</label>
                <select name="is_fish" id="edit_is_fish" class="form-select">
                  <option value="0">ไม่ใช่</option>
                  <option value="1">ใช่</option>
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

  <!-- Add Modal -->
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
                  <?php foreach($menuOptions as $m): ?>
                  <option value="<?= $m['menu_id'] ?>"><?= h($m['menu_name']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">ประเภทวัตถุดิบ</label>
                <select name="staple_type_id" class="form-select" required>
                  <option value="">-- เลือกประเภท --</option>
                  <?php foreach($typeOptions as $t): ?>
                  <option value="<?= $t['id'] ?>"><?= h($t['staple_type_name']) ?></option>
                  <?php endforeach; ?>
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

<script>
var csrfToken = <?= json_encode($csrf_token) ?>;

$(document).ready(function() {
  // Destroy default DataTable init from footer.php (if any on #example1)
  // Initialize server-side DataTable for staple
  var stapleTable = $('#stapleTable').DataTable({
    processing: true,
    serverSide: true,
    deferRender: true,
    ajax: {
      url: 'crud/staple_api.php',
      type: 'GET'
    },
    columns: [
      { data: 'num', orderable: false, className: 'text-center' },
      { data: 'staple_name' },
      { data: 'staple_serve', className: 'text-center' },
      { data: 'menu_name' },
      { data: 'staple_yield', className: 'text-center' },
      { data: 'staple_type_name' },
      { data: 'is_fish', className: 'text-center' },
      { data: null, orderable: false, className: 'text-center',
        render: function(data, type, row) {
          return '<button class="btn btn-warning btn-xs btn-edit" data-raw=\'' + JSON.stringify(row.raw) + '\'>' +
                 '<i class="fas fa-edit"></i></button> ' +
                 '<button class="btn btn-danger btn-xs" onclick="confirmDelete(\'crud/staple_delete.php?staple_id=' + row.raw.staple_id + '&token=' + csrfToken + '\')">' +
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
  $('#stapleTable').on('click', '.btn-edit', function() {
    var raw = $(this).data('raw');
    $('#edit_staple_id').val(raw.staple_id);
    $('#edit_staple_name').val(raw.staple_name);
    $('#edit_staple_serve').val(raw.staple_serve);
    $('#edit_menu_id').val(raw.menu_id);
    $('#edit_staple_type_id').val(raw.staple_type_id);
    $('#edit_staple_yield').val(raw.staple_yield);
    $('#edit_is_fish').val(raw.is_fish);
    var modal = new bootstrap.Modal(document.getElementById('modalUpdate'));
    modal.show();
  });
});
</script>
</body>
</html>
