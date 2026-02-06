<?php
include '_db/connect.php';
include "session.php";
$menu = "food";

?>

<?php include("header.php"); ?>


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <h1>ระบบสั่งอาหารออนไลน์ (e-food system) ราคา <s>7,000</s> บาท ลดเหลือ <font color="red"> 5,500 </font>บาท</h1>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

     
              
          





          <div class="card">
            <div class="card-header">
              <h3 class="card-title">สนใจระบบ inbox มาที่เพจ  <a href="https://www.facebook.com/devtai.com2019" target="_blank">สอนเขียนโปรแกรม devtai.com <i class="fa fa-check-circle"></i></a></h3>
            </div>
            <br>
            <div class="card-body p-1">

              <div class="row">
                <div class="col-md-1">
                  
                </div>


                <div class="col-md-10">

                  <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                 ระบบสั่งอาหารออนไลน์ (e-food system)
                </h3>
              </div>
              <div class="card-body pad table-responsive">

<iframe width="900" height="534" src="https://www.youtube.com/embed/dS5huqAyE30" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

ระบบ สั่งอาหารออนไลน์ (e-food system)<br>
* หมายเหตุ: ระบบนี้ยังไม่มีการดึง api ธนาคาร (สามารถพัฒนาต่อได้ยอด ในงานใช้จริง)<br>
พัฒนาด้วย PHP + MySQLi + Admin LTE + Bootstrap 4<br>
(ออกแบบรายงานด้วย API Google Chart & Chart js)<br>
<hr>
ระบบการทำงาน/ขอบเขต <br> 
<i class="fas fa-user"></i> <b>ผู้ดูแลระบบ/admin  </b> <br>
<i class="fas fa-edit"></i> อนุมัติการเติมเงิน, ปรับสถานะการเติมเงิน<br>
<i class="fas fa-edit"></i> จัดการสมาชิก (เพิ่ม, ลบ, แก้ไข)<br>
<i class="fas fa-edit"></i> จัดการธนาคาร (เพิ่ม, ลบ, แก้ไข)<br>
<i class="fas fa-edit"></i> จัดการอาหาร (เพิ่ม, ลบ, แก้ไข)<br>
<i class="fas fa-edit"></i> ออกรายงาน<br>
<i class="fas fa-edit"></i> รายงานอาหาร 5 อันดับ, รายงานยอดขายแยกตามวัน, รายงานยอดขายแยกตามเดือน,รายงานยอดขายแยกตามปี
 <br>

<i class="fas fa-user"></i> <b>ผู้ใช้งานที่เป็นสมาชิก/member </b><br>
<i class="fas fa-edit"></i> เติมเงินเข้าสู่ระบบ<br>
<i class="fas fa-edit"></i> ดูสถานะการเติมเงิน<br>
<i class="fas fa-edit"></i> ดูประวัติการเติมเงิน<br>
<i class="fas fa-edit"></i> สั่งอาหาร<br>
<i class="fas fa-edit"></i> นัดวัน/เวลา ไปรับอาหาร<br>
<i class="fas fa-edit"></i> ชำระเงินหักจากระบบ <br>
<i class="fas fa-edit"></i> ดูสถานะการสั่งอาหาร<br>
<i class="fas fa-edit"></i> แก้ไขข้อมูลส่วนตัว<br>
<i class="fas fa-user"></i> <b>ผู้ใช้งาน(ครัว)/kitchen</b> <br>
<i class="fas fa-edit"></i> ดูรายการสั่งอาหาร <br>
<i class="fas fa-edit"></i> ปรับสถานะการสั่งอาหาร <br>
<i class="fas fa-edit"></i> แก้ไขข้อมูลส่วนตัว <br>
☎ ติดต่อสอบถาม 098-373-8651<br>
<hr>
<h3>รับเขียนโปรแกรม , พัฒนาระบบ ,เว็บไซต์</h3>

              </div>
              <!-- /.card -->
            </div>
          </div>
                  
                </div>


                <div class="col-md-1">
                  
                </div>

              </div>

            </div>
              
          </div>

          
        

          


        </div>
        <!-- /.col -->
      </div>

      

    </section>
    <!-- /.content -->

    
<?php include('footer.php'); ?>

<script>
  $(function () {
    $(".datatable").DataTable();
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    // });
  });
</script>
  
</body>
</html>
