<?php
include "session.php";
include '_db/connect.php';

// Sanitize GET parameters to prevent SQL Injection
$values1_raw = $_GET["values1"] ?? '';
$values2_raw = $_GET["values2"] ?? '';
$total_menu_raw = $_GET['total_menu'] ?? '';
$amount1 = intval($_GET['amount1'] ?? 0);
$amount2 = intval($_GET['amount2'] ?? 0);

// Ensure all IDs are integers only
$values1 = implode(',', array_map('intval', array_filter(explode(',', $values1_raw), 'strlen')));
$values2 = implode(',', array_map('intval', array_filter(explode(',', $values2_raw), 'strlen')));
$total_menu = implode(',', array_map('intval', array_filter(explode(',', $total_menu_raw), 'strlen')));

include("head.php");

//print_r($sql);

?>
<style>
.content {
  max-width: 90%;
  margin: auto;
}
@media screen and (max-width: 768px) {
  .content { max-width: 100%; padding: 5px; }
  .panel-body { overflow-x: auto; -webkit-overflow-scrolling: touch; }
  .panel-body table { min-width: 500px; }
}
</style>
<body onunload="opener.location.reload()" class="content">
<br>
<div class="col-lg-12">
    <div class="login-panel panel panel-info">
      <div class="panel-heading">
      	<div align="center"><img src='images/logo.png'> </img></div>
		<br>
        <h3 align="center" class="panel-title"><span class="style4">การคำนวณการสั่งซื้อวัตถุดิบ (เนื้อสัตว์)</span></h3>
        <h5>วันที่ ...................................................................</h5>
      </div>
      <div class="panel-body">
        <p>1. เมนูอาหาร</p>
        <table class="table table-bordered table-striped dataTable" role="grid" width="75%">
          <thead class="thead-dark">
              <tr role="row" class="info">
                  <th tabindex="0" rowspan="1" colspan="1" ><center>มื้อ</center></th>
                  <th tabindex="0" rowspan="1" colspan="1" ><center>ประเภท</center></th>
                  <th tabindex="0" rowspan="1" colspan="1" ><center>เมนู</center></th>
              </tr>
          </thead>
          <tbody>
          <?php
          $sql3 = "SELECT menu_name, 'พิเศษ' type from menu where menu_id in ($values2)
                  UNION
                  select menu_name, 'ธรรมดา' type from menu where menu_id in ($values1) ";
          $res3 = mysqli_query($conn, $sql3);
          $y = 1;
          while ($row3 = mysqli_fetch_array($res3)) { ?>
              <tr>
                  <td></td>
                  <td><?= htmlspecialchars($row3['type']); ?></td>
                  <td><?= htmlspecialchars($row3['menu_name']); ?></td>
                  
              </tr>
          <?php $y++; }
          ?>
          </tbody>
          </table>
      </div>
  </div>
</div>  

<script>
$(function () {
$(".datatable").DataTable();
$('#example2').DataTable({
"paging": true,
"lengthChange": false,
"searching": false,
http://fordev22.com/
"ordering": true,
"info": true,
"autoWidth": false,
});
});
</script>
</body>

</html>