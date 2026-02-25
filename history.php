<?php
include "session.php";
include '_db/connect.php';
$menu = "history";
$csrf_token = generateCsrfToken();
?>
<?php include("header.php"); ?>

<section class="content-header">
  <div class="container-fluid">
    <h1><i class="fas fa-history me-2"></i>ทะเบียนประวัติการคำนวณ</h1>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0">ประวัติการคำนวณทั้งหมด</h5>
        <a href="calculate.php" class="btn btn-primary btn-sm">
          <i class="fas fa-plus me-1"></i>คำนวณใหม่
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="row mb-3">
        <div class="col-md-4">
          <label class="form-label fw-bold">กรองตามวันที่</label>
          <input type="date" id="filterDate" class="form-control" onchange="filterTable()">
        </div>
        <div class="col-md-3">
          <label class="form-label fw-bold">กรองตามมื้อ</label>
          <select id="filterMeal" class="form-select" onchange="filterTable()">
            <option value="">ทั้งหมด</option>
            <option value="เช้า">เช้า</option>
            <option value="เที่ยง">เที่ยง</option>
            <option value="เย็น">เย็น</option>
          </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
          <button class="btn btn-secondary btn-sm" onclick="clearFilter()"><i class="fas fa-times me-1"></i>ล้างตัวกรอง</button>
        </div>
      </div>
      <div class="table-responsive">
        <table id="historyTable" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th style="width: 5%;" class="text-center">ลำดับ</th>
              <th style="width: 12%;" class="text-center">วันที่</th>
              <th style="width: 8%;" class="text-center">มื้อ</th>
              <th style="width: 25%;">รายการอาหาร (ธรรมดา)</th>
              <th style="width: 8%;" class="text-center">จำนวน</th>
              <th style="width: 20%;">รายการอาหาร (พิเศษ)</th>
              <th style="width: 7%;" class="text-center">จำนวน</th>
              <th style="width: 15%;" class="text-center">จัดการ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $meal_labels = ['breakfast' => 'เช้า', 'lunch' => 'เที่ยง', 'dinner' => 'เย็น'];
            $meal_colors = ['breakfast' => 'info', 'lunch' => 'warning', 'dinner' => 'primary'];

            $sql = "SELECT h.*, 
                    GROUP_CONCAT(DISTINCT m1.menu_name ORDER BY m1.menu_name SEPARATOR ', ') as normal_menu_names
                    FROM calculate_history h
                    LEFT JOIN menu m1 ON FIND_IN_SET(m1.menu_id, h.menu_ids_normal)
                    GROUP BY h.history_id
                    ORDER BY h.calc_date DESC, FIELD(h.meal_type, 'breakfast', 'lunch', 'dinner')";
            $res = mysqli_query($conn, $sql);
            $i = 1;
            while ($row = mysqli_fetch_array($res)) {
                // Get special menu names
                $special_names = '-';
                if (!empty($row['menu_ids_special'])) {
                    $special_ids = implode(',', array_map('intval', explode(',', $row['menu_ids_special'])));
                    $sql_sp = "SELECT GROUP_CONCAT(menu_name ORDER BY menu_name SEPARATOR ', ') as names FROM menu WHERE menu_id IN ($special_ids)";
                    $res_sp = mysqli_query($conn, $sql_sp);
                    $row_sp = mysqli_fetch_array($res_sp);
                    $special_names = $row_sp['names'] ?? '-';
                }

                $meal_label = $meal_labels[$row['meal_type']] ?? $row['meal_type'];
                $meal_color = $meal_colors[$row['meal_type']] ?? 'secondary';
                $thai_date = date('d/m/', strtotime($row['calc_date'])) . (date('Y', strtotime($row['calc_date'])) + 543);
            ?>
              <tr>
                <td class="text-center"><?= $i ?></td>
                <td class="text-center"><?= $thai_date ?></td>
                <td class="text-center"><span class="badge bg-<?= $meal_color ?>"><?= $meal_label ?></span></td>
                <td><?= h($row['normal_menu_names'] ?? '') ?></td>
                <td class="text-center"><strong><?= number_format($row['amount_normal']) ?></strong></td>
                <td><?= h($special_names) ?></td>
                <td class="text-center"><strong><?= $row['amount_special'] > 0 ? number_format($row['amount_special']) : '-' ?></strong></td>
                <td class="text-center">
                  <a href="calculate.php?edit_id=<?= $row['history_id'] ?>" class="btn btn-warning btn-xs" title="แก้ไข/คำนวณใหม่">
                    <i class="fas fa-edit"></i>
                  </a>
                  <button class="btn btn-danger btn-xs" onclick="confirmDelete('crud/history_delete.php?history_id=<?= $row['history_id'] ?>&token=<?= $csrf_token ?>')" title="ลบ">
                    <i class="fas fa-trash"></i>
                  </button>
                  <button class="btn btn-info btn-xs" onclick="viewDetail(<?= $row['history_id'] ?>)" title="ดูรายละเอียด">
                    <i class="fas fa-eye"></i>
                  </button>
                </td>
              </tr>
            <?php $i++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title"><i class="fas fa-eye me-2"></i>รายละเอียดการคำนวณ</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="detailContent">
        <div class="text-center py-4">
          <i class="fas fa-spinner fa-spin fa-2x"></i>
          <p class="mt-2">กำลังโหลด...</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<script>
function filterTable() {
  var dateVal = document.getElementById('filterDate').value;
  var mealVal = document.getElementById('filterMeal').value;
  var table = document.getElementById('historyTable');
  var rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
  
  for (var i = 0; i < rows.length; i++) {
    var dateCell = rows[i].cells[1].textContent;
    var mealCell = rows[i].cells[2].textContent.trim();
    var showDate = true;
    var showMeal = true;
    
    if (dateVal) {
      var parts = dateVal.split('-');
      var filterFormatted = parts[2] + '/' + parts[1] + '/' + (parseInt(parts[0]) + 543);
      showDate = dateCell.indexOf(filterFormatted) !== -1;
    }
    if (mealVal) {
      showMeal = mealCell.indexOf(mealVal) !== -1;
    }
    rows[i].style.display = (showDate && showMeal) ? '' : 'none';
  }
}

function clearFilter() {
  document.getElementById('filterDate').value = '';
  document.getElementById('filterMeal').value = '';
  filterTable();
}

function viewDetail(historyId) {
  var modal = new bootstrap.Modal(document.getElementById('detailModal'));
  document.getElementById('detailContent').innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">กำลังโหลด...</p></div>';
  modal.show();
  
  $.get('crud/history_detail.php', {id: historyId}, function(html) {
    document.getElementById('detailContent').innerHTML = html;
  }).fail(function() {
    document.getElementById('detailContent').innerHTML = '<div class="alert alert-danger">ไม่สามารถโหลดข้อมูลได้</div>';
  });
}
</script>

<?php include('footer.php'); ?>
</body>
</html>
