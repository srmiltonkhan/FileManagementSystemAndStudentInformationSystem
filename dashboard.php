<?php 
  include("db_connection.php");
  if (!isset($_SESSION['type'])) {
    header("location:index.php");
  }
  //Total Student Count
  $query_count = "SELECT COUNT(`stud_id`) AS total from stud_bsc_info";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $total_students = $result['total'];
    //Total Male Count
  $query_count = "SELECT COUNT(`stud_id`) AS total from stud_bsc_info WHERE gender = 'Male'";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $total_male = $result['total'];
  //Total Male Count
  $query_count = "SELECT COUNT(`stud_id`) AS total from stud_bsc_info WHERE gender = 'Female'";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $total_female = $result['total'];
    //New Admitted
  $query_count = "SELECT COUNT(`stud_id`) AS total from stud_ape_info WHERE stud_status = 'New Admitted'";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $new_admitted = $result['total'];
  //Running Student count
  $query_count = "SELECT COUNT(`stud_id`) AS total from stud_ape_info WHERE stud_status = 'Running'";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $running_stud = $result['total'];
  //Dropout Student count
  $query_count = "SELECT COUNT(`stud_id`) AS total from stud_ape_info WHERE stud_status = 'Drop out'";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $drop_stud = $result['total'];
  //Dropout Student count
  $query_count = "SELECT COUNT(`stud_id`) AS total from stud_ape_info WHERE stud_status = 'Internship'";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $intern_stud = $result['total'];
    //Dropout Student count
  $query_count = "SELECT COUNT(`stud_id`) AS total from stud_ape_info WHERE stud_status = 'Passed'";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $passed_stud = $result['total'];
  //Total Users
  $query_count = "SELECT COUNT(`user_id`) AS total from user_details";
  $statement = $pdo_conn->prepare($query_count);
  $statement->execute();
  $result = $statement->fetch();
  $total_users = $result['total'];
  
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
              <h2 class="no-margin-bottom">Dashboard</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-graduation-cap"></i></div>
                    <div class="title"><span>Total<br>Students</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 75%; height: 4px;" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $total_students;?></strong></div>
                  </div>
                </div>
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-users"></i></div>
                    <div class="title"><span>Total<br>Male</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $total_male;?></strong></div>
                  </div>
                </div>  
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fas fa-address-card"></i></div>
                    <div class="title"><span>Total <br>Female</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $total_female;?></strong></div>
                  </div>
                </div>                                                          
              </div>
              <div class="row bg-white has-shadow mt-1">
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-graduation-cap"></i></div>
                    <div class="title"><span>New<br>Admitted</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 75%; height: 4px;" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <a href="new_admitted.php"><div class="number"><strong><?php echo $new_admitted;?></strong></div></a>
                  </div>
                </div>
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-users"></i></div>
                    <div class="title"><span>Running<br>Students</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <a href="running_stud.php"><div class="number"><strong><?php echo $running_stud;?></strong></div></a>
                  </div>
                </div>  
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fas fa-address-card"></i></div>
                    <div class="title"><span>Dropout <br>Students</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $drop_stud;?></strong></div>
                  </div>
                </div>                                                          
              </div> 
               <div class="row bg-white has-shadow mt-1">
                <!-- Item -->
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-graduation-cap"></i></div>
                    <div class="title"><span>Internship<br>Students</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 75%; height: 4px;" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $intern_stud;?></strong></div>
                  </div>
                </div>
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-users"></i></div>
                    <div class="title"><span>Passed<br>Students</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $passed_stud;?></strong></div>
                  </div>
                </div> 
                <div class="col-xl-4 col-sm-4">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-users"></i></div>
                    <div class="title"><span>Total<br>Users</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong><?php echo $total_users;?></strong></div>
                  </div>
                </div>                                                                           
              </div>                           
              <div class="row bg-white has-shadow mt-1">
                <div class="p-2">Admit Form Information User Wise</div>
                <div class="table-responsive">

                </div>
              </div>
            </div>
          </section>
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
          <?php  
      // session_start();  
      // if(isset($_SESSION["user_name"])){  
      //      if((time() - $_SESSION['last_login_timestamp'])>10)  
      //      {  
      //           header("location:logout.php");  
      //      }else{  

      //      }  
      // }  
      // else{  
      //      header('location:index.php');  
      // }  
      ?> 
    <?php echo $end_body_html_and_java_script_section; ?>


