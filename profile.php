<?php 
  include("db_connection.php");
  if (!isset($_SESSION['type'])) {
    header("location:index.php");
  }
?>
<?php
  $query = "SELECT * FROM user_details WHERE user_id = '".$_SESSION["user_id"]."'";
  $statement = $pdo_conn->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach ($result as $row) {
    $user_name = $row['user_name'];
    $user_id_num = $row['user_id_num'];
    $user_email = $row['user_email'];
    $user_mobile = $row['user_mobile'];
    $user_department = $row['user_department'];
    $user_designation = $row['user_designation'];
    $user_type = $row['user_type'];
    $user_status = $row['user_status'];
    $user_reg_date = $row['user_reg_date'];
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
              <h2 class="no-margin-bottom">My Profile Information</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >Profile Information</div>
                <div class="col p-1" align="right">
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                <div class="table-responsive">
                  <table class="table table-bordered table-sm table-striped">
                    <tr>
                      <td>Profile Image</td>
                      <td><img class='img-thumbnail' src='img/user_image/<?php echo $_SESSION['user_image'];?>' onerror="this.onerror=null; this.src='img/user_image/default_image.jpg'" alt='' width='100' height='50'></td>
                    </tr>                     
                    <tr>
                      <td>Profile Name</td>
                      <td><?php echo $user_name;?></td>
                    </tr>                   
                    <tr>
                      <td>ID Number</td>
                      <td><?php echo $user_id_num;?></td>
                    </tr>
                    <tr>
                      <td>Your Email</td>
                      <td><?php echo $user_email;?></td>
                    </tr>
                    <tr>
                      <td>Mobile Number</td>
                      <td><?php echo $user_mobile;?></td>
                    </tr>                     
                    <tr>
                      <td>Department</td>
                      <td><?php echo $user_department;?></td>
                    </tr>                    
                    <tr>
                      <td>Designation</td>
                      <td><?php echo $user_designation;?></td>
                    </tr> 
                     <tr>
                      <td>Account Type</td>
                      <td><?php echo $user_type;?></td>
                    </tr> 
                    <tr>
                      <td>Account Status</td>
                      <td><?php echo $user_status;?></td>
                    </tr>                     
                    <tr>
                      <td>Registration Date</td>
                      <td><?php echo $user_reg_date;?></td>
                    </tr>                                                         
                  </table>
                </div>
              </div>
            </div>
          </section>
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
<script>
  
</script>
