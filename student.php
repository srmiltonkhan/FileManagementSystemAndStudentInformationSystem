<?php 
  include("db_connection.php");
  if (!isset($_SESSION['type'])) {
    header("location:index.php");
  }
?>
<?php require 'function.php';?>
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
              <h2 class="no-margin-bottom">Students Information</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >Student List</div>
                <div class="col p-1" align="right">
                <button class="btn btn-primary btn-sm launch-modal" data-toggle="modal" data-target="#stud_modal" id="add_button"><i class="fas fa-plus-square"></i> Add Student</button>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="student_data_table" class="table table-bordered table-hover table-striped table-sm" >
                      <thead class="thead-dark">
                        <tr>
                          <th>SL</th>
                          <th>Student ID</th>
                          <th>Image</th>                         
                          <th>Student</th>
                          <th>Email</th>
                          <th>Department</th>
                          <th>Bth.</th>
                          <th>Reg. Date</th>
                          <th width="15%">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>                
          </section> 
<div class="modal fade" id="stud_modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
           <h6 class="modal-title">Add Student Information</h6>
           <button type="button" class="close" data-dismiss="modal" id="close">&times;</button>
         </div>
        <form method="post" id="stud_form" enctype="multipart/form-data">
           <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12">
                    <h6>Student Basic Information</h6>
                    <hr/>
               <div class="form-group row">    
                  <div class="col-sm-5">
                    <div class="row mb-1">
                      <label class="col-sm-4">Student ID</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="stud_id_num" name="stud_id_num" placeholder="Student ID" pattern="^[0-9]{13}$" title="Student ID Only 13 digits are allowed" required>
                      </div>
                    </div> 
                     <div class="row mb-1">
                      <label class="col-sm-4">Name</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="stud_name" name="stud_name" placeholder="Student Name" pattern="^[a-zA-Z\s].{1,60}" title="All characters are allowed, length should be 1-60 characters" required>
                      </div>
                    </div> 
                   <div class="row mb-1">
                      <label class="col-sm-4">Email</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email" pattern=".{12,100}" title="Student Email should be 12-100 characters">
                      </div>                  
                    </div> 
                   <div class="row mb-1">
                      <label class="col-sm-4">Mobile</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="Mobile" pattern="^[0-9]{1,11}$" title="Mobile Number must be at 11 digits" required="">                        
                      </div>
                    </div> 
                   <div class="row mb-1">
                      <label class="col-sm-4">Faculty</label>
                      <div class="col-sm-8">
                       <select id="faculty_id" name="faculty_id" class="form-control form-control-sm" required>
                          <option value="">Select Faculty</option>
                          <?php echo fill_faculty_list ($pdo_conn);?>
                       </select>                       
                      </div>                       
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4">Department</label>
                      <div class="col-sm-8">
                        <select id="department_id" name="department_id" class="form-control form-control-sm" required>
                        <option value="">Select Department</option>
                        </select>                      
                      </div>                     
                    </div>                                                                                                                          
                  </div>           
                  <!-- 2nd Section -->
                  <div class="col-sm-5">
                    <div class="row mb-1">
                      <label class="col-sm-4">Program</label>
                      <div class="col-sm-8">
                        <select id="program_id" name="program_id" class="form-control form-control-sm" required>
                          <option value="">Select Program</option>                                      
                        </select>  
                      </div>                     
                    </div>                      
                    <div class="row mb-1">
                      <label class="col-sm-4">Batch</label>
                      <div class="col-sm-8">
                        <select id="batch" name="batch" class="form-control form-control-sm selectpicker border" data-live-search="true" data-size = '5' required>
                          <option value="">Selct Batch</option>
                          <?php
                            for ($i=1; $i<=20; $i++)
                            {
                            ?>
                               <option value="<?php echo auto_bath_number($i);?>"><?php echo auto_bath_number($i);?></option>
                            <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4">Gender</label>
                      <div class="col-sm-8">
                        <select id="gender" name="gender" class="form-control form-control-sm">
                          <option value="">Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>  
                      </div>
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4">Blood</label>
                      <div class="col-sm-8">
                        <select id="bld_grp" name="bld_grp" class="form-control form-control-sm">
                          <option value="">Select Blood Group</option>
                          <option value="A+">A+</option>
                          <option value="B+">B+</option>
                          <option value="AB+">AB+</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                          <option value="A-">O-</option>
                          <option value="B-">B-</option>
                          <option value="AB-">AB-</option>
                        </select>
                      </div>                       
                    </div> 
                    <div class="row mb-1">
                      <label class="col-sm-4">DOB</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" id="dob" name="dob" placeholder="date">
                      </div>
                    </div> 
                     <div class="row"> 
                      <label class="col-sm-4">Profile</label>  
                      <div class="col-sm-8">                         
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text form-control-sm">Upload</span>
                          </div>
                          <div class="custom-file">
                            <input type="file" id="profile_image" name="profile_image" class="custom-file-input form-control-sm" onchange="loadFile(event)" accept=".jpg" title="Only JPG Allowed">
                            <label class="custom-file-label form-control-sm" id="stud_img_lbl">Choose file</label>
                          </div>
                        </div> 
                      </div> 
                      <!--  Start Feedback Division -->
                      <div class="col-sm-3"></div>
                      <div id="invld_fdbk_pfl_img" class="col-sm-9 text-danger reset_label mb-1"></div>                    
                    </div>      
                  </div>
                  <div class="col-sm-2">
                    <!-- Picture Section-->
                    <span id="image_view"></span>
                    <div class="ml-2"><img id="upld_img" width="140" class="img-thumbnail" /></div>       
                  <script type="text/javascript">
                    $(".custom-file-input").on("change",function(){
                      var user_image = $(this).val().split("\\").pop();
                      $(this).siblings(".custom-file-label").addClass("selected").html(user_image)
                    });
                    var loadFile = function(event) {
                      var image = document.getElementById('upld_img');
                      image.src = URL.createObjectURL(event.target.files[0]);
                    };
                  </script>                     
                  </div>  
                </div>
                </div>                          
              </div>  
              <!-- Academic Information   -->
              <div class="row">
                <div class="col-sm-12">
                  <h6>Student Academic Information</h6>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row mb-1">
                      <label class="col-sm-4">Form Number</label>
                      <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" id="ad_form_num" name="ad_form_num" placeholder="Form Number" pattern="^[0-9]{3,6}$" title="Student ID length should be 3-6 digits">
                      </div>                  
                    </div>
                    <div class="row mb-1">
                      <label class="col-sm-4">Waiver</label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm" name="waiver_perctg" id="waiver_perctg">
                          <option value="">Please Choose Waiver Percentage</option>
                          <option value="10%">10%</option>
                          <option value="20%">20%</option>
                          <option value="30%">30%</option>
                          <option value="40%">40%</option>
                          <option value="50%">50%</option>
                          <option value="60%">60%</option>
                          <option value="80%">80%</option>
                          <option value="100%">100%</option>
                        </select>
                      </div>                  
                    </div>
                   <div class="row mb-1">
                      <label class="col-sm-4">Semester</label>
                      <div class="col-sm-5">
                        <select class="form-control form-control-sm" id="ad_semester" name="ad_semester" required>
                          <option value="">Please Choose Semester</option>
                          <option value="Summer">Summer</option>
                          <option value="Fall">Fall</option>
                          <option value="Spring">Spring</option>
                        </select>   
                      </div>
                      <div class="col-sm-3">
                          <input type="text" class="form-control form-control-sm year" name="ad_semester_y" id="ad_semester_y"placeholder="Year" required>
                          <div id="invld_fdbk_ad_semester_y" class="col-sm-9 text-danger reset_label mb-1"></div> 
                        <script>
                         //Date Section
                          $('.year').datepicker({
                            autoclose: true,
                            minViewMode: 2,
                            format: 'yyyy'
                            });                          
                        </script>     
                      </div>                                         
                    </div>                                        
                  </div>
                    <div class="col-sm-6">
                    <div class="row mb-1">
                        <label class="col-sm-4">Student Status</label>
                        <div class="col-sm-8">
                         <select class="form-control form-control-sm" name="stud_status" id="stud_status" required>
                          <option value="">Please choose student status</option>
                          <option value="New Admitted">New Admitted</option>
                          <option value="Running">Running</option>
                          <option value="Internship">Internship</option>
                          <option value="Drop out">Drop out</option>
                          <option value="Passed">Passed</option>
                        </select>                                            
                        </div>
                    </div>
                     <div class="row">
                      <label class="col-sm-4">Sibling ID</label>
                       <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="sibling_id" name="sibling_id" placeholder="Sibling ID">                     
                      </div>                     
                    </div>                                       
                  </div>                    
                  </div>
                </div>
              </div>
              <!-- Student Personal Information -->
              <div class= "row mt-3">
                <div class="col-sm-12">
                  <h6>Student Personal Information</h6>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row mb-1">
                        <label class="col-sm-4">NID</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control form-control-sm" name="nid" id="nid" placeholder=" Please type Student NID" pattern="^[0-9]{10,17}$" title="Nid Number length should be 10-17 digits">
                        </div>
                      </div> 
                     <div class="row mb-1">
                      <label class="col-sm-4">Birth R.N.</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="brth_regst_num" id="brth_regst_num" placeholder=" Please type Student Birth Registration Number">
                      </div>
                    </div> 
                    <div class="row">
                      <label class="col-sm-4">Marital Status</label>
                      <div class="col-sm-8">
                        <select class="form-control form-control-sm" id="marital_sts" name="marital_sts" required>
                          <option value="">Please Choose Matrital Status</option>
                          <option value="Unmarried">Unmarried</option>
                          <option value="Married">Married</option>
                        </select>
                        <div id="invld_fdbk_marital_sts" class="col-sm-9 text-danger reset_label mb-1"></div> 
                      </div>
                    </div>                                                              
                    </div>
                    <div class="col-sm-6">
                      <div class="row mb-1">
                        <label class="col-sm-4">Present</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control form-control-sm" name="prst_addr" id="prst_addr" placeholder="Please type Present Address">
                        </div>
                      </div>
                      <div class="row mb-1">
                      <label class="col-sm-4">Parmanent</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="per_addr" id="per_addr" placeholder="Please type Parmanent Address">
                      </div>
                    </div> 
                    <div class="row">
                      <label class="col-sm-4">Citizenship</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="citizenship" id="citizenship" required>
                      </div>
                    </div>                                                                
                    </div>                   
                  </div>
                </div>
              </div>
              <!-- Family Infromation -->
              <div class="row mt-3">
                <div class="col-sm-12">
                  <h6>Student Family Information</h6>
                  <hr>
                  <div class="row">                  
                  <div class="col-sm-6">
                    <div class="row mb-1">
                      <label class="col-sm-4">Father</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="father_nm" id="father_nm" pattern="^[a-zA-Z\s].{2,50}" title="All characters are allowed, length should be 1-50 characters" placeholder="Father Name" required>
                      </div>
                    </div>  
                   <div class="row mb-1">
                    <label class="col-sm-4">Occupation</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" name="father_occpt" id="father_occpt" placeholder="Father Occupation" required>
                    </div>
                  </div>
                    <div class="row">
                    <label class="col-sm-4">Mother Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" name="mother_nm" id="mother_nm" placeholder="Mother Name" required>
                    </div>
                  </div>                                                        
                  </div>
                   <div class="col-sm-6">
                    <div class="row mb-1">
                    <label class="col-sm-4">Mother Occupation</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" name="mother_occpt" id="mother_occpt" placeholder="Mother Occupation" required>
                    </div>
                  </div> 
                    <div class="row mb">
                    <label class="col-sm-4">Gardian Mobile</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" name="gardn_mobile" id="gardn_mobile" placeholder="Gardian Mobile">
                    </div>
                  </div>                                     
                  </div> 
                   </div>  
                   <!-- Secondary School Certificate (S.S.C) -->
                   <div class="row mt-3">
                     <div class="col-sm-12">
                       <h6>Secondary School Certificate (S.S.C)</h6>
                       <hr>
                       <div class="row">
                         <div class="col-sm-6">
                            <div class="row mb-1">
                              <label class="col-sm-4">Ex./Degree Title</label>
                              <div class="col-sm-8">
                                <select class="form-control form-control-sm" name="ssc_exm_deg_tle" id="ssc_exm_deg_tle">
                                  <option value="">Please Choose Exam / Degree Title</option>
                                  <option value="S.S.C">S.S.C</option>
                                  <option value="Dhakhil">Dhakhil</option>
                                  <option value="Technical">Technical</option>
                                  <option value="A Level">A Level</option>
                                </select>
                              </div>
                            </div>
                          <div class="row mb-1">
                          <label class="col-sm-4">Concen./Mjr/Grp</label>
                          <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="ssc_con_mjr_grp" id="ssc_con_mjr_grp">
                              <option value="">Please Choose Concentration/Major/Group</option>
                              <option value="Science">Science</option>
                              <option value="Business Studies">Business Studies</option>
                              <option value="Humanities">Humanities</option>
                            </select>
                          </div>
                          </div> 
                           <div class="row mb-1">
                            <label class="col-sm-4">Board</label>
                            <div class="col-sm-8">
                              <select class="form-control form-control-sm" name="ssc_board" id="ssc_board">
                                <option value="">Please Choose Board</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Chittagong">Chittagong</option>
                                <option value="Barisal">Barisal</option>
                                <option value="Comilla">Comilla</option>
                                <option value="Dinajpur">Dinajpur</option>
                                <option value="Jessore">Jessore</option>
                                <option value="Mymensingh">Mymensingh</option>
                                <option value="Sylhet">Sylhet</option>
                                <option value="Madrasah">Madrasah</option>
                                <option value="Technical">Technical</option>
                                <option value="DIBS(Dhaka)">DIBS(Dhaka)</option>
                              </select>
                            </div>
                          </div>                          
                           <div class="row mb-1">
                            <label class="col-sm-4">Institute</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" name="ssc_institue" id="ssc_institue" placeholder="Please type Institute Name">
                            </div>
                          </div>                                                                           
                          </div>
                         <div class="col-sm-6">
                          <div class="row mb-1">
                            <label class="col-sm-4">Roll No.</label>
                          <div class="col-sm-8">
                             <input type="text" class="form-control form-control-sm" name="ssc_roll" id="ssc_roll" pattern="^[0-9]{2,10}$" title="Only Digits allowed and not more than 10 digits" placeholder="S.S.C Roll Number">
                          </div>
                        </div> 
                         <div class="row mb-1">
                          <label class="col-sm-4">Registration No.</label>
                          <div class="col-sm-8">
                             <input type="text" class="form-control form-control-sm" name="ssc_registration" id="ssc_registration" pattern="^[0-9]{2,10}$" title="Only Digits allowed and not more than 10 digits" placeholder="S.S.C Registration Number">
                          </div>
                         </div> 
                         <div class="row mb-1">
                            <label class="col-sm-4">Passing of Year</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" name="ssc_y_passing" id="ssc_y_passing" pattern="^[0-9]{4}$" title="Only Four digits allowed" placeholder="Passing of Year">
                            </div>
                          </div> 
                         <div class="row">
                            <label class="col-sm-4">Result</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" name="ssc_result" id="ssc_result" pattern="^[0-9\.]*$" title="Only dot and digits allowed (without space)" placeholder="S.S.C Result">
                            </div>
                          </div>                           
                         </div>
                       </div>
                     </div>
                   </div>
                   <!-- Higher School Certificate (H.S.C) -->
                   <div class="row mt-3">
                      <div class="col-sm-12">
                         <h6>Higher School Certificate (H.S.C)</h6>
                         <hr>
                         <div class="row">
                           <div class="col-sm-6">
                             <div class="row mb-1">
                              <label class="col-sm-4">Ex./Degree Title</label>
                              <div class="col-sm-8">
                                <select class="form-control form-control-sm" name="hsc_exm_deg_tle" id="hsc_exm_deg_tle">
                                  <option value="">Please Choose Exam / Degree Title</option>
                                  <option value="H.S.C">H.S.C</option>
                                  <option value="Alim">Alim</option>
                                  <option value="Technical">Technical</option>
                                  <option value="O Level">O Level</option>
                                </select>
                              </div>
                             </div>
                             <div class="row mb-1">
                              <label class="col-sm-4">Concen./Mjr/Grp</label>
                              <div class="col-sm-8">
                                <select class="form-control form-control-sm" name="hsc_con_mjr_grp" id="hsc_con_mjr_grp">
                                  <option value="">Please Choose Concentration/Major/Group</option>
                                  <option value="Science">Science</option>
                                  <option value="Business Studies">Business Studies</option>
                                  <option value="Humanities">Humanities</option>
                                </select>
                              </div>
                            </div> 
                            <div class="row mb-1">
                              <label class="col-sm-4">Board</label>
                              <div class="col-sm-8">
                                <select class="form-control form-control-sm" name="hsc_board" id="hsc_board">
                                  <option value="">Please Choose Board</option>
                                  <option value="Dhaka">Dhaka</option>
                                  <option value="Rajshahi">Rajshahi</option>
                                  <option value="Chittagong">Chittagong</option>
                                  <option value="Barisal">Barisal</option>
                                  <option value="Comilla">Comilla</option>
                                  <option value="Dinajpur">Dinajpur</option>
                                  <option value="Jessore">Jessore</option>
                                  <option value="Mymensingh">Mymensingh</option>
                                  <option value="Sylhet">Sylhet</option>
                                  <option value="Madrasah">Madrasah</option>
                                  <option value="Technical">Technical</option>
                                  <option value="DIBS(Dhaka)">DIBS(Dhaka)</option>
                                </select>
                              </div>
                            </div>
                            <div class="row mb-1">
                              <label class="col-sm-4">Institute</label>
                              <div class="col-sm-8">
                                 <input type="text" class="form-control form-control-sm" name="hsc_institue" id="hsc_institue" placeholder="Please type Institute Name">
                              </div>
                            </div>                              
                           </div>
                           <div class="col-sm-6">
                           <div class="row mb-1">
                           <label class="col-sm-4">Roll No.</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" name="hsc_roll" id="hsc_roll" pattern="^[0-9]{2,10}$" title="Only Digits allowed and not more than 10 digits" placeholder="Please type H.S.C Roll Number">
                            </div>
                          </div> 
                           <div class="row mb-1">
                            <label class="col-sm-4">Registration No.</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" name="hsc_registration" id="hsc_registration" pattern="^[0-9]{2,10}$" title="Only Digits allowed and not more than 10 digits" placeholder="Please type H.S.C Registration Number">
                            </div>
                          </div> 
                         <div class="row mb-1">
                            <label class="col-sm-4">Passing of Year</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" name="hsc_y_passing" id="hsc_y_passing" pattern="^[0-9]{4}$" title="Only Four digits allowed" placeholder="Passing of Year">
                            </div>
                          </div> 
                         <div class="row">
                            <label class="col-sm-4">Result</label>
                            <div class="col-sm-8">
                               <input type="text" class="form-control form-control-sm" name="hsc_result" id="hsc_result" pattern="^[0-9\.]*$" title="Only dot and digits allowed (without space)" placeholder="H.S.C Result">
                            </div>
                          </div>                                                                              
                           </div>
                         </div>
                      </div>
                   </div>
                </div>
              </div>
           </div>
           <div class="modal-footer">
              <input type="hidden" name="stud_id" id="stud_id" >
              <input type="hidden" name="action_hidden" id="action_hidden" value="Add">
              <input type="submit" name="action_submit" id="action_submit" value="Save" class="btn btn-primary btn-sm">
              <button type="button" class="btn btn-info btn-sm mb-0" class="close" data-dismiss="modal" id="close">Close</button>        
           </div>
         </form> 
      </div>                      
    </div>
</div>
  <!-- Student Information View -->
<div id="student_view_modal" class="modal fade">
<div class="modal-dialog modal-xl">
    <form method="post" id="student_form">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Student Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <Div id="student_details_data"></Div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
</div>
</div>  
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
<script>
      //Retrive Data in Department Dropdown
    $('#faculty_id').change(function(){
        var faculty_id = $('#faculty_id').val();
        var btn_action_hidden = 'load_department';
        $.ajax({
            url:"student_action.php",
            method:"POST",
            data:{faculty_id:faculty_id, btn_action_hidden:btn_action_hidden},
            success:function(data){
                $('#department_id').html(data);

            }
        });
    });
      //Retrive Data in Program Dropdown
    $('#department_id').change(function(){
        var department_id = $('#department_id').val();
        var btn_action_hidden = 'load_program';
        $.ajax({
            url:"student_action.php",
            method:"POST",
            data:{department_id:department_id, btn_action_hidden:btn_action_hidden},
            success:function(data){
                $('#program_id').html(data);

            }
        });
    });

    //Image Size Validation
   $('#profile_image').on('change',function(){
   var file_size = document.getElementById('profile_image').files[0].size;
    if (file_size > 25500) {
      $('#invld_fdbk_pfl_img').html("Picture Size must under 25KB").show().fadeOut(3000);
      document.getElementById("action_submit").disabled = true;
    }else{
      document.getElementById("action_submit").disabled = false;
    }
  });   
  $(document).ready(function(){
      // fetch data from database
        var dataTable = $('#student_data_table').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
          url:"student_fetch.php",
          type:"POST"
        },
        "columnDefs":[
          {
            "targets":[0, 3, 4],
            "orderable":false,
          },
        ],
      });
        // Add Button Function     
        $('#add_button').click(function(){
          $('.modal-title').html('Add Student Information');
          $('#stud_form')[0].reset();
          $('#alert_action').empty();
           $('#action_submit').val('Save');
          $('#batch').selectpicker("refresh");
          $('.custom-file-label').html('');
          $("#upld_img").attr('src', '');
          $('#image_view').html('');
        }); 
        //Close button function
          $('#close').click(function(){
            $('#stud_form')[0].reset();
            $('#batch').selectpicker("refresh");
            $("#upld_img").attr('src', '');
            $('#image_view').html('');
          });
         $(document).on('submit','#stud_form',function(event){
            event.preventDefault();
            $.ajax({
            url:"student_action.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data){
              $('#stud_modal').modal("hide");
              $('#alert_action').fadeIn().html('<div class = "alert alert-success">'+data+'</div>');
              dataTable.ajax.reload(); 
            }
          });             
        });       
  });
 // view data from Database 
      $(document).on('click', '.view', function(){
          var stud_id = $(this).attr("id");
          var btn_action = 'btn_student_details';
          $.ajax({
              url:"student_view.php",
              method:"POST",
              data:{stud_id:stud_id, btn_action:btn_action},
              success:function(data){
                  $('#student_view_modal').modal('show');
                  $('#student_details_data').html(data);
              }
          })
      });
      //Update section  
 $(document).on('click', '.update', function(){
  var stud_id = $(this).attr("id");
  var action_hidden = 'fetch_single';
  $.ajax({
   url:"student_action.php",
   method:"POST",
   data:{stud_id:stud_id, action_hidden:action_hidden},
   dataType:"json",
   success:function(data)
   {
    $('#stud_modal').modal('show');
    $('.modal-title').html("Edit Student Information");    
    $('#stud_id_num').val(data.stud_id_num);
    $('#stud_name').val(data.stud_name);
    $('#email').val(data.email);
    $('#mobile').val(data.mobile);
    $('#faculty_id').val(data.faculty_id);
    $('#department_id').html(data.department_select_box);
    $('#department_id').val(data.department_id);
    $('#program_id').html(data.program_select_box);
    $('#program_id').val(data.program_id);
    $('#batch').val(data.batch);
    $('#gender').val(data.gender);
    $('#bld_grp').val(data.bld_grp);
    $('#dob').val(data.dob);
    $('#stud_img_lbl').html(data.profile_image);
    $('#image_view').html(data.image_view);
    $('#ad_form_num').val(data.ad_form_num);
    $('#waiver_perctg').val(data.waiver_perctg);
    $('#ad_semester').val(data.ad_semester);
    $('#ad_semester_y').val(data.ad_semester_y);
    $('#stud_status').val(data.stud_status);
    $('#sibling_id').val(data.sibling_id);
    $('#nid').val(data.nid);
    $('#brth_regst_num').val(data.brth_regst_num);
    $('#marital_sts').val(data.marital_sts);
    $('#prst_addr').val(data.prst_addr);
    $('#per_addr').val(data.per_addr);
    $('#citizenship').val(data.citizenship);
    $('#father_nm').val(data.father_nm);
    $('#father_occpt').val(data.father_occpt);
    $('#mother_nm').val(data.mother_nm);
    $('#mother_occpt').val(data.mother_occpt);
    $('#gardn_mobile').val(data.gardn_mobile);
    $('#ssc_exm_deg_tle').val(data.ssc_exm_deg_tle);
    $('#ssc_con_mjr_grp').val(data.ssc_con_mjr_grp);
    $('#ssc_board').val(data.ssc_board);
    $('#ssc_board').val(data.ssc_board);
    $('#ssc_institue').val(data.ssc_institue);
    $('#ssc_roll').val(data.ssc_roll);
    $('#ssc_registration').val(data.ssc_registration);
    $('#ssc_y_passing').val(data.ssc_y_passing);
    $('#ssc_result').val(data.ssc_result);
    $('#hsc_exm_deg_tle').val(data.hsc_exm_deg_tle);
    $('#hsc_con_mjr_grp').val(data.hsc_con_mjr_grp);
    $('#hsc_board').val(data.hsc_board);
    $('#hsc_institue').val(data.hsc_institue);
    $('#hsc_roll').val(data.hsc_roll);
    $('#hsc_registration').val(data.hsc_registration);
    $('#hsc_y_passing').val(data.hsc_y_passing);
    $('#hsc_result').val(data.hsc_result);
    $('#stud_id').val(stud_id);
    $('#action_submit').val('Edit');
    $('#action_hidden').val("Edit");
    $('#alert_action').empty();
   }
  })
 });
     
</script>
