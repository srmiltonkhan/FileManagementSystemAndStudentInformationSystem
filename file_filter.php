<?php
 include("db_connection.php");
 if (!isset($_SESSION['type'])) {
    header("location:index.php");
  }
?>
<?php 
  $category_name ="";
  $query = "SELECT DISTINCT category_name FROM file_mgt INNER JOIN file_cat ON file_cat.file_cat_id = file_mgt.file_cat_id ORDER BY category_name ASC";
  $statement = $pdo_conn->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach ($result as  $row) {
    $category_name .= '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
  }
?>
<?php 
  $file_sub_cat_name ="";
  $query = "SELECT DISTINCT file_sub_cat_name FROM file_mgt INNER JOIN file_sub_cat ON file_sub_cat.file_sub_cat_id = file_mgt.file_sub_cat_id  ORDER BY file_sub_cat_name ASC";
  $statement = $pdo_conn->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach ($result as  $row) {
    $file_sub_cat_name .= '<option value="'.$row['file_sub_cat_name'].'">'.$row['file_sub_cat_name'].'</option>';
  }
?>
<?php 
  $file_sup_cat_name ="";
  $query = "SELECT DISTINCT file_sup_cat_name FROM file_mgt INNER JOIN file_sup_cat ON file_sup_cat.file_sup_cat_id = file_mgt.file_sup_cat_id ORDER BY file_sup_cat_name ASC";
  $statement = $pdo_conn->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach ($result as  $row) {
    $file_sup_cat_name .= '<option value="'.$row['file_sup_cat_name'].'">'.$row['file_sup_cat_name'].'</option>';
  }
?>
<!-- Add Dashboard Parent File -->
<?php require 'dashboard_parent_file.php';?>
 <!-- HTML and Head Taq Section -->
<?php echo $html_and_head_section; ?>
      <!-- Body and Header Section -->
    <?php echo $body_and_header_section_start; ?>
    <!-- Navigation Menu Bar -->
    <?php include("navigation_bar_menu.php"); ?>
    <?php echo $body_and_header_section_end; ?>
      <!-- Side Navbar Section -->
    <?php echo $side_nabar_and_content_inner_section; ?>
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">File Filter Report</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
                <div class="container-fluid border">
                  <div class="p-1 mt-1 w-100 mx-auto">
                    <div class="row">
                      <div class="col">
                        <select id="category_name" class="form-control form-control-sm">
                          <option value="">Please Select Category</option>
                          <?php echo $category_name;?>
                        </select>
                      </div>
                      <div class="col">
                        <select id="file_sub_cat_name" class="form-control form-control-sm">
                          <option value="">Please Select Sub-Category</option>
                          <?php echo $file_sub_cat_name;?>
                        </select>
                      </div>
                      <div class="col">
                        <select id="file_sup_cat_name" class="form-control form-control-sm">
                          <option value="">Please Select Sup-Category</option>
                          <?php echo $file_sup_cat_name;?>
                        </select>
                      </div>
                     <div class="col">
                          <input type="button" name="filter" id="filter" value="filter" class="btn btn-sm btn-primary">
                      </div>                                             
                    </div>
                  </div>
                </div>
              </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="file_data_table" class="table table-bordered table-hover table-striped table-sm" >
                      <thead class="thead-dark">
                        <tr>
                          <th>SL</th>
                          <th>File ID</th>
                          <th>File Name</th>
                          <th>Category</th>
                          <th>Sub-Catg</th>
                          <th>Sup-Catg</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>
          </section>
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
    <?php echo $pdf_print_excel; ?>

    <script type="text/javascript">
    $(document).ready(function(){
        fetch_data('no');
        //fetch data from DB
        function fetch_data(filter_data, category_name , file_sub_cat_name, file_sup_cat_name){
        var dataTable = $('#file_data_table').DataTable({
         "processing" : true,
         "serverSide" : true,
         "order" : [],
         "ajax" : {
          url:"file_filter_fetch.php",
          type:"POST",
          data:{
           filter_data:filter_data,category_name:category_name, file_sub_cat_name:file_sub_cat_name,file_sup_cat_name:file_sup_cat_name
          }
         },
           dom: 'lBfrtip',
           buttons: [
            'pdf','excel', 'csv', 'copy','print'
           ],
           "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
        });
       }
       //Search Button Action
     $('#filter').click(function(){
      var category_name = $('#category_name').val();
      var file_sub_cat_name = $('#file_sub_cat_name').val();
      var file_sup_cat_name = $('#file_sup_cat_name').val();
      if(category_name !='' && file_sub_cat_name !='' && file_sup_cat_name !=''){
       $('#file_data_table').DataTable().destroy();
       fetch_data('yes', category_name, file_sub_cat_name, file_sup_cat_name);
      }
      else{
       $('#alert_action').fadeIn().html('<div class="bg-info text-white p-2" align="center">Please Select Both Fields.</div>');
      }
     });
    });
    </script>
