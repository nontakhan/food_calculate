<?php
include "session.php";
include '_db/connect.php';
$menu = "report";
$csrf_token = generateCsrfToken();
?>
<?php include("header.php"); ?>

<section class="content-header">
  <div class="container-fluid">
    <h1><i class="fas fa-file-alt me-2"></i>พิมพ์สรุปรายการวัตถุดิบ</h1>
  </div>
</section>

<section class="content">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0"><i class="fas fa-search me-2"></i>เลือกเงื่อนไขการพิมพ์</h5>
    </div>
    <div class="card-body">
      <form id="reportForm">
        <div class="row g-3 mb-3">
          <div class="col-lg-4">
            <label class="form-label fw-bold"><i class="fas fa-calendar me-1 text-info"></i> วันที่เริ่มต้น <span class="text-danger">*</span></label>
            <input type="date" class="form-control form-control-lg" required name="date_from" id="date_from" value="<?= date('Y-m-d') ?>">
          </div>
          <div class="col-lg-4">
            <label class="form-label fw-bold"><i class="fas fa-calendar me-1 text-info"></i> วันที่สิ้นสุด <span class="text-danger">*</span></label>
            <input type="date" class="form-control form-control-lg" required name="date_to" id="date_to" value="<?= date('Y-m-d') ?>">
          </div>
          <div class="col-lg-4">
            <label class="form-label fw-bold"><i class="fas fa-clock me-1 text-info"></i> มื้ออาหาร</label>
            <select name="meal_type" id="meal_type" class="form-select form-select-lg">
              <option value="all">ทุกมื้อ</option>
              <option value="breakfast">เช้า</option>
              <option value="lunch">เที่ยง</option>
              <option value="dinner">เย็น</option>
            </select>
          </div>
        </div>
        <div class="text-center mt-4">
          <button type="button" class="btn btn-success btn-lg px-5" onclick="previewReport()">
            <i class="fas fa-eye me-2"></i> ดูตัวอย่างก่อนพิมพ์
          </button>
          <button type="button" class="btn btn-primary btn-lg px-5" onclick="printReport()">
            <i class="fas fa-print me-2"></i> พิมพ์สรุปรายการ
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Preview section -->
  <div id="previewSection" style="display:none;">
    <div class="card mt-4">
      <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-eye me-2"></i>ตัวอย่างข้อมูลที่จะพิมพ์</h5>
      </div>
      <div class="card-body" id="previewContent">
      </div>
    </div>
  </div>
</section>

<script>
function printReport() {
  var dateFrom = document.getElementById('date_from').value;
  var dateTo = document.getElementById('date_to').value;
  var mealType = document.getElementById('meal_type').value;

  if (!dateFrom || !dateTo) {
    Swal.fire({icon: 'warning', title: 'กรุณาเลือกวันที่'});
    return;
  }
  if (dateFrom > dateTo) {
    Swal.fire({icon: 'warning', title: 'วันที่เริ่มต้นต้องไม่เกินวันที่สิ้นสุด'});
    return;
  }

  var url = 'print_summary_by_date.php?date_from=' + dateFrom + '&date_to=' + dateTo + '&meal_type=' + mealType;
  window.open(url, '_blank');
}

function previewReport() {
  var dateFrom = document.getElementById('date_from').value;
  var dateTo = document.getElementById('date_to').value;
  var mealType = document.getElementById('meal_type').value;

  if (!dateFrom || !dateTo) {
    Swal.fire({icon: 'warning', title: 'กรุณาเลือกวันที่'});
    return;
  }
  if (dateFrom > dateTo) {
    Swal.fire({icon: 'warning', title: 'วันที่เริ่มต้นต้องไม่เกินวันที่สิ้นสุด'});
    return;
  }

  var section = document.getElementById('previewSection');
  var content = document.getElementById('previewContent');
  content.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="mt-2">กำลังโหลดข้อมูล...</p></div>';
  section.style.display = 'block';

  $.get('crud/report_preview.php', {
    date_from: dateFrom,
    date_to: dateTo,
    meal_type: mealType
  }, function(html) {
    content.innerHTML = html;
  }).fail(function() {
    content.innerHTML = '<div class="alert alert-danger">ไม่สามารถโหลดข้อมูลได้</div>';
  });
}
</script>

<?php include('footer.php'); ?>
</body>
</html>
