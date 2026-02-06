<?php

$menu = "table";

?>


<?php include("header.php"); ?>


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <h1>Table</h1>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

     
              
          





          <div class="card">
            <div class="card-header bg-navy">
              <h3 class="card-title">Table</h3>
            </div>
            <br>
            <div class="card-body p-1">

              <div class="row">
                <div class="col-md-1">
                  
                </div>


                <div class="col-md-12">


                  <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row" class="info">
                                            <th  tabindex="0" rowspan="1" colspan="1" style="width: 7%;">ลำดับ</th>
                                            <th  tabindex="0" rowspan="1" colspan="1" style="width: 15%;">ชื่อข่าวสาร</th>
                                            <th  tabindex="0" rowspan="1" colspan="1" style="width: 15%;">หัวเรื่อง</th>

                                           
                                            <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">จัดการ</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                                <td>
                                                Test
                                                </td>

                                                <td>
                                                   Test1
                                                </td>

                                                <td>
                                                  Test
                                                </td>

                                              
                                                <td>
                                                  <a class="btn btn-primary btn-xs" href="#">
                                                  <i class="fas fa-folder">
                                                  </i>
                                                  View
                                              </a>
                                              <a class="btn btn-info btn-sm" href="#">
                                                  <i class="fas fa-pencil-alt">
                                                  </i>
                                                  Edit
                                              </a>
                                              <a class="btn btn-danger btn-sm" href="#">
                                                  <i class="fas fa-minus-circle">
                                                  </i>
                                                  Delete
                                              </a>
                                                </td>

                                               
                                               
                                            </tr>


                                            <tr>
                                                <td>
                                                Test
                                                </td>

                                                <td>
                                                   Test
                                                </td>

                                                <td>
                                                  Test
                                                </td>

                                               
                                                <td>
                                                  <a class="btn btn-primary btn-sm" href="#">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="#">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger btn-sm" href="#">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
                                                </td>

                                                
                                               
                                            </tr>




                                           
                                        </tbody>
                  </table>
      
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
    // http://fordev22.com/
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    // });
  });
</script>
  
</body>
</html>
