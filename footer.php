  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /.wrapper -->

<footer class="main-footer">
  <div class="d-flex justify-content-between align-items-center flex-wrap">
    <div>
      <strong>Copyright &copy; <?= date('Y'); ?></strong> โรงพยาบาลเทพา - ระบบคำนวณวัตถุดิบอาหาร
    </div>
    <div>
      <a href="#" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#modalVersion">
        <i class="fas fa-code-branch me-1"></i>Version 2.0.0
      </a>
    </div>
  </div>
</footer>

  <!-- Version Modal -->
  <div class="modal fade" id="modalVersion" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>ประวัติเวอร์ชัน</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th style="width: 20%;">Version</th>
                  <th>รายละเอียด</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM version ORDER BY version_id DESC";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                  while ($row = mysqli_fetch_array($res)) { ?>
                    <tr>
                      <td><span class="badge bg-primary"><?= htmlspecialchars($row['version_build'] ?? ''); ?></span></td>
                      <td><?= htmlspecialchars($row['version_detail'] ?? ''); ?></td>
                    </tr>
                  <?php }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>

<!-- Sidebar Backdrop for Mobile -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap 5 Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
  // Initialize Select2
  $('.select2').select2({
    theme: 'bootstrap-5',
    width: '100%'
  });
  
  // Initialize DataTables with performance optimization
  if ($('#example1').length && !$.fn.DataTable.isDataTable('#example1')) {
    $('#example1').DataTable({
      responsive: true,
      deferRender: true,
      processing: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/th.json',
        processing: '<i class="fas fa-spinner fa-spin"></i> กำลังโหลด...'
      },
      pageLength: 25,
      lengthMenu: [[25, 50, 100], [25, 50, 100]]
    });
  }
  
  // Sidebar Toggle for Mobile
  const sidebar = document.querySelector('.main-sidebar');
  const backdrop = document.getElementById('sidebarBackdrop');
  const toggleBtn = document.querySelector('.sidebar-toggle');
  
  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', function(e) {
      e.preventDefault();
      sidebar.classList.toggle('show');
      if (backdrop) backdrop.classList.toggle('show');
    });
  }
  
  if (backdrop) {
    backdrop.addEventListener('click', function() {
      if (sidebar) sidebar.classList.remove('show');
      backdrop.classList.remove('show');
    });
  }
});

// Confirm delete with SweetAlert2
function confirmDelete(url, message) {
  message = message || 'คุณต้องการลบข้อมูลนี้หรือไม่?';
  Swal.fire({
    title: 'ยืนยันการลบ',
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'ลบ',
    cancelButtonText: 'ยกเลิก'
  }).then(function(result) {
    if (result.isConfirmed) {
      window.location.href = url;
    }
  });
  return false;
}

// Print ingredient summary function
function printIngredientSummary() {
  // Get form data from the current page
  const menuIds = <?= isset($menu_final) ? json_encode($menu_final) : '[]' ?>;
  const menuIds2 = <?= isset($menu_final2) ? json_encode($menu_final2) : '[]' ?>;
  const amount1 = <?= isset($total) ? $total : 0 ?>;
  const amount2 = <?= isset($total2) ? $total2 : 0 ?>;
  
  if (menuIds.length === 0) {
    Swal.fire({
      icon: 'warning',
      title: 'กรุณาเลือกรายการอาหาร',
      text: 'ต้องเลือกรายการอาหารห้องธรรมดาอย่างน้อย 1 รายการ'
    });
    return;
  }
  
  const url = `print_summary.php?values1=${menuIds}&values2=${menuIds2}&amount1=${amount1}&amount2=${amount2}`;
  window.open(url, '_blank');
}
</script>
