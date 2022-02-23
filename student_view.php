<?php
  require_once("db_connection.php");
  if($_POST['btn_action'] == 'btn_student_details'){
        $query = "SELECT * FROM stud_bsc_info INNER JOIN stud_ape_info ON stud_ape_info.stud_id = stud_bsc_info.stud_id INNER JOIN faculty ON  faculty.faculty_id = stud_bsc_info.faculty_id INNER JOIN department ON department.department_id = stud_bsc_info.department_id INNER JOIN program ON program.program_id = stud_bsc_info.program_id INNER JOIN user_details ON user_details.user_id = stud_bsc_info.user_id WHERE stud_bsc_info.stud_id = '".$_POST["stud_id"]."'";
        $statement = $pdo_conn->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $output='';
      foreach($result as $row){
        $profile_image = '';
        if ($row['profile_image'] !='') {
          $profile_image = '<img src="img/stud_image/'.$row["profile_image"].'" class="thumbnail" width="100" height="100"/>';
        }else{
          $profile_image = '';
        }
       $output .= '
          <div class="border row">
          <div class="border col-sm-4">
            <h6>Student Basic Information</h6>
            <hr/>
            <table class="table table-bordered table-sm">
              <tr>
                <td>Student ID</td>
               <td>'.$row["stud_id_num"].'</td>             
              </tr>
              <tr>
                <td>Student Name</td>
               <td>'.$row["stud_name"].'</td>             
              </tr> 
              <tr>
                <td>Email</td>
               <td>'.$row["email"].'</td>             
              </tr> 
               <tr>
                <td>Mobile</td>
               <td>'.$row["mobile"].'</td>             
              </tr> 
                <tr>
                <td>Faculty</td>
               <td>'.$row["faculty_name"].'</td>             
              </tr> 
              <tr>
                <td>Department</td>
               <td>'.$row["dep_name"].'</td>             
              </tr>  
              <tr>
                <td>Program</td>
               <td>'.$row["program_name"].'</td>             
              </tr>
              <tr>
                <td>Batch</td>
               <td>'.$row["batch"].'</td>             
              </tr>    
               <tr>
                <td>Gender</td>
               <td>'.$row["gender"].'</td>             
              </tr> 
                <tr>
                <td>Blood Group</td>
               <td>'.$row["bld_grp"].'</td>             
              </tr>              
               <tr>
                <td>DOB</td>
               <td>'.$row["dob"].'</td> 
               <tr>            
              </tr>                                                                                                                                   
                <td>Registration Date</td>
               <td>'.$row["reg_time"].'.'.$row["reg_date"].'</td>             
              </tr>   
                <tr>
                <td>Entered By</td>
               <td>'.$row["user_name"].'</td>             
              </tr>                    
            </table>            
          </div>
           <div class="border col-sm-4">
           <h6>Student Academic Information</h6>
           <hr>
            <table class="table table-bordered table-sm">
              <tr>
               <td>Form Number</td>
               <td>'.$row["ad_form_num"].'</td>             
              </tr> 
              <tr>
               <td>Waiver Percentage</td>
               <td>'.$row["waiver_perctg"].'</td>             
              </tr> 
               <tr>
               <td>Semester</td>
               <td>'.$row["ad_semester"].','.$row["ad_semester_y"].'</td>             
              </tr>  
              <tr>
               <td>Student Status</td>
               <td>'.$row["stud_status"].'</td>             
              </tr> 
               <tr>
               <td>Sibling ID</td>
               <td>'.$row["sibling_id"].'</td>             
              </tr>                                                      
            </table>
           <h6>Personal Information</h6>
           <hr>
          <table class="table table-bordered table-sm">
            <tr>
             <td>Student NID</td>
             <td>'.$row["nid"].'</td>             
            </tr>   
             <tr>
             <td>Birth R.N.</td>
             <td>'.$row["brth_regst_num"].'</td>             
            </tr>  
             <tr>
             <td>Marital Status</td>
             <td>'.$row["marital_sts"].'</td>             
            </tr>  
              <tr>
             <td>Present Address</td>
             <td>'.$row["prst_addr"].'</td>             
            </tr> 
            <tr>
             <td>Parmanent Address</td>
             <td>'.$row["per_addr"].'</td>             
            </tr>   
            <tr>
             <td>citizenship</td>
             <td>'.$row["citizenship"].'</td>             
            </tr>                                                                              
          </table>
          </div>
            <div class="border col-sm-4">
            <div align="right" class="p-2">'.$profile_image.'</div>
              <h6>Family Information</h6>
              <hr>
            <table class="table table-bordered table-sm">
            <tr>
             <td>Father Name</td>
             <td>'.$row["father_nm"].'</td>             
            </tr>  
            <tr>
             <td>Father Occupation</td>
             <td>'.$row["father_occpt"].'</td>             
            </tr>  
            <tr>
             <td>Mother Name</td>
             <td>'.$row["mother_nm"].'</td>             
            </tr>  
            <tr>
             <td>Mother Occupation</td>
             <td>'.$row["mother_occpt"].'</td>             
            </tr> 
            <tr>
             <td>Gardian Mobile</td>
             <td>'.$row["gardn_mobile"].'</td>             
            </tr>                              
            </table>
          </div>
          <div class = "col-sm-6 border">
             <h6 class="mt-2">Secondary School Certificate (S.S.C)</h6>
             <hr>
            <table class="table table-bordered table-sm">
            <tr>
             <td>Degree Title</td>
             <td>'.$row["ssc_exm_deg_tle"].'</td>             
            </tr>
              <tr>
             <td>Concentration/Mojor/Group</td>
             <td>'.$row["ssc_con_mjr_grp"].'</td>             
            </tr> 
            <tr>
             <td>Board</td>
             <td>'.$row["ssc_board"].'</td>             
            </tr> 
             <tr>
             <td>Institute</td>
             <td>'.$row["ssc_institue"].'</td>             
            </tr>   
              <tr>
             <td>Roll No</td>
             <td>'.$row["ssc_roll"].'</td>             
            </tr>    
            <tr>
             <td>Registration No</td>
             <td>'.$row["ssc_registration"].'</td>             
            </tr> 
             <tr>
             <td>Year of Passing</td>
             <td>'.$row["ssc_y_passing"].'</td>             
            </tr> 
             <tr>
             <td>Result</td>
             <td>'.$row["ssc_result"].'</td>             
            </tr>                                                                                
             </table>
          </div> 
          <div class = "col-sm-6 border">
             <h6 class="mt-2">Higher School Certificate (H.S.C)</h6>
             <hr>
            <table class="table table-bordered table-sm">
              <tr>
             <td>Degree Title</td>
             <td>'.$row["hsc_exm_deg_tle"].'</td>             
            </tr>
             <tr>
             <td>Concentration/Mojor/Group</td>
             <td>'.$row["hsc_con_mjr_grp"].'</td>             
            </tr>
             <tr>
             <td>Board</td>
             <td>'.$row["hsc_board"].'</td>             
            </tr>  
             <tr>
             <td>Institute</td>
             <td>'.$row["hsc_institue"].'</td>             
            </tr>
              <tr>
             <td>Roll No</td>
             <td>'.$row["hsc_roll"].'</td>             
            </tr>  
               <tr>
             <td>Registration No</td>
             <td>'.$row["hsc_registration"].'</td>             
            </tr>   
            <tr>
             <td>Year of Passing</td>
             <td>'.$row["hsc_y_passing"].'</td>             
            </tr>  
            <tr>
             <td>Result</td>
             <td>'.$row["hsc_result"].'</td>             
            </tr>                                                                                
             </table>
          </div>                          
          </div>

       ';
      }
      $output .= '
       </table>
      </div>
      ';
      echo $output;
  } 
 ?>