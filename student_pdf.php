<?php

include('db_connection.php'); 
if(isset($_GET["pdf"]) && isset($_GET['stud_id']))
{
 function fetch_data()  
 {   
      global $pdo_conn;
      $output = '';  
      $sql = "SELECT * FROM stud_bsc_info INNER JOIN stud_ape_info ON stud_ape_info.stud_id = stud_bsc_info.stud_id INNER JOIN faculty ON  faculty.faculty_id = stud_bsc_info.faculty_id INNER JOIN department ON department.department_id = stud_bsc_info.department_id INNER JOIN program ON program.program_id = stud_bsc_info.program_id INNER JOIN user_details ON user_details.user_id = stud_bsc_info.user_id WHERE stud_bsc_info.stud_id = :stud_id";  
      $statement = $pdo_conn->prepare($sql);
      $statement->execute(
        array(
           ':stud_id' =>  $_GET["stud_id"]
        )
      );
      $result = $statement->fetchAll();
      
      foreach($result as $row)  
      {       
        $profile_image = '';
        if ($row['profile_image'] !='') {
          $profile_image = '<img src="img/stud_image/'.$row["profile_image"].'" class="thumbnail" width="80" height="80"/>';
        }else{
          $profile_image = '';
        }
      $output .= ' 
              <h3>Student Basic Information</h3> 
                 <table border="1" cellspacing="0" cellpadding="4">    
                  <tr>
                    <td width="50%"><h1>'.$row["stud_name"].'</h1></td> 
                    <td width="50%"><div align = "right">'.$profile_image.'</div></td>
                  </tr>       
                  <tr> 
                    <td width="20%">ID</td>
                    <td width="40%">'.$row["stud_id_num"].'</td>  
                    <td width="20%">Batch</td>
                    <td width="20%">'.$row["batch"].'</td>                         
                  </tr> 
                  <tr>
                    <td width="20%">Mobile</td>
                    <td width="40%">'.$row["mobile"].'</td> 
                    <td width="20%">Gender</td>
                    <td width="20%">'.$row["gender"].'</td>                          
                  </tr>
                  <tr>
                    <td width="20%">Email</td>
                    <td width="40%">'.$row["email"].'</td> 
                    <td width="20%">Blood Group</td>
                    <td width="20%">'.$row["bld_grp"].'</td>                       
                  </tr>
                  <tr>
                    <td width="20%">Faculty</td>
                    <td width="40%">'.$row["faculty_name"].'</td>  
                    <td width="20%">DOB</td>
                    <td width="20%">'.$row["dob"].'</td>                       
                  </tr>
                  <tr>
                    <td width="20%">Department</td>
                    <td width="40%">'.$row["dep_name"].'</td>   
                    <td width="20%">Reg. Date</td>
                    <td width="20%">'.$row["reg_time"].'.'.$row["reg_date"].'</td>                         
                  </tr>
                 <tr>
                    <td width="20%">Program</td>
                    <td width="40%">'.$row["program_name"].'</td>
                    <td width="20%">Entered By</td>
                    <td width="20%">'.$row["user_name"].'</td>      
                  </tr>          
               </table> 
                <h3>Student Academic Information</h3> 
                 <table border="1" cellspacing="0" cellpadding="4"> 
                  <tr>
                    <td width="20%">Form Number</td>
                     <td width="20%">'.$row["ad_form_num"].'</td> 
                     <td width="20%">Student Status</td>
                     <td width="40%">'.$row["stud_status"].'</td>      
                  </tr> 
                  <tr>
                     <td width="20%">Waiver</td>
                     <td width="20%">'.$row["waiver_perctg"].'</td>
                    <td width="20%">Sibling ID</td>
                    <td width="40%">'.$row["sibling_id"].'</td>   
                  </tr> 
                <tr>
                  <td>Semester</td>
                  <td>'.$row["ad_semester"].','.$row["ad_semester_y"].'</td>             
                </tr>                                     
                 </table>
                <h3>Student Personal Information</h3> 
                 <table border="1" cellspacing="0" cellpadding="4"> 
                  <tr>
                   <td width="20%"> NID</td>
                   <td width="20%">'.$row["nid"].'</td>  
                   <td width="20%">Present Address</td>
                   <td width="40%">'.$row["prst_addr"].'</td>                               
                  </tr>   
                   <tr>
                   <td width="20%">Birth R.N.</td>
                   <td width="20%">'.$row["brth_regst_num"].'</td>  
                   <td width="20%">Parmanent Address</td>
                   <td width="40%">'.$row["per_addr"].'</td>                               
                  </tr>  
                   <tr>
                   <td width="20%">Marital Status</td>
                   <td width="20%">'.$row["marital_sts"].'</td> 
                   <td width="20%">citizenship</td>
                   <td width="40%">'.$row["citizenship"].'</td>                                 
                  </tr>                   
                 </table>  
                 <h3>Student Family Information</h3> 
                 <table border="1" cellspacing="0" cellpadding="4">
                    <tr>
                   <td width="20%">Father Name</td>
                   <td width="40%">'.$row["father_nm"].'</td> 
                    <td width="20%">Mother Occupation</td>
                   <td width="20%">'.$row["mother_occpt"].'</td>                               
                  </tr>  
                  <tr>
                   <td width="20%">Father Occupation</td>
                   <td width="40%">'.$row["father_occpt"].'</td>  
                   <td width="20%">Gardian Mobile</td>
                   <td width="20%">'.$row["gardn_mobile"].'</td>                               
                  </tr>  
                  <tr>
                   <td>Mother Name</td>
                   <td>'.$row["mother_nm"].'</td>             
                  </tr>                    
                 </table>
                <h3>Secondary School Certificate (S.S.C)</h3> 
                 <table border="1" cellspacing="0" cellpadding="4">   
                  <tr>
                     <td width="20%">Degree Title</td>
                     <td width="40%">'.$row["ssc_exm_deg_tle"].'</td>  
                     <td width="20%">Roll No</td>
                     <td width="20%">'.$row["ssc_roll"].'</td>                       
                  </tr>
                  <tr>
                    <td width="20%">Con./Mjr./Grp.</td>
                    <td width="40%">'.$row["ssc_con_mjr_grp"].'</td>  
                    <td width="20%">Registration No</td>
                    <td width="20%">'.$row["ssc_registration"].'</td>                                
                  </tr> 
                  <tr>
                    <td width="20%">Board</td>
                    <td width="40%">'.$row["ssc_board"].'</td> 
                    <td width="20%">Year of Passing</td>
                    <td width="20%">'.$row["ssc_y_passing"].'</td>             
                  </tr> 
                  <tr>
                    <td width="20%">Institute</td>
                    <td width="40%">'.$row["ssc_institue"].'</td>  
                    <td width="20%">Result</td>
                    <td width="20%">'.$row["ssc_result"].'</td>                                   
                    </tr>                   
                 </table> 
                <h3>Higher School Certificate (H.S.C)</h3> 
                 <table border="1" cellspacing="0" cellpadding="4"> 
                <tr>
                 <td width="20%">Degree Title</td>
                 <td width="40%">'.$row["hsc_exm_deg_tle"].'</td> 
                 <td width="20%">Roll No</td>
                 <td width="20%">'.$row["hsc_roll"].'</td>                                  
                </tr>
                 <tr>
                 <td width="20%">Con./Mjr./Grp.</td>
                 <td width="40%">'.$row["hsc_con_mjr_grp"].'</td>
                 <td width="20%">Registration No</td>
                 <td width="20%">'.$row["hsc_registration"].'</td>                                
                </tr>
                 <tr>
                 <td width="20%">Board</td>
                 <td width="40%">'.$row["hsc_board"].'</td>  
                 <td width="20%">Year of Passing</td>
                 <td width="20%">'.$row["hsc_y_passing"].'</td>                             
                </tr>  
                 <tr>
                 <td width="20%">Institute</td>
                 <td width="40%">'.$row["hsc_institue"].'</td> 
                 <td width="20%">Result</td>
                 <td width="20%">'.$row["hsc_result"].'</td>                                
                </tr>                     
                 </table>                                       
              ';  
      }  
      return $output;  
 } 
require_once('class/tcpdf/tcpdf.php'); 
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        // $this->SetFont('helvetica', 'B', 12);  
        // $this->Cell(0, 10, '', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        // $this->Cell(0, 9, 'Khawja Yunus Ali University', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        // $this->SetFont('helvetica', '', 8);  
        // $this->Cell(0, 10, 'Founder: Dr. M. M. Amjad Hussain', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        // $this->SetFont('helvetica', '', 10);  
        // $this->Cell(0, 15, 'Student Information', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        // Logo
        $image_file = 'img/kyau_logo/logo-title.png';
        $this->Image($image_file, 10, 5, 185, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Line(1,1,1,1,);

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Md. Milton Khan');
$pdf->SetTitle('Student Information');
$pdf->SetSubject('KYAU');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 035', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 10);

// add a page
$pdf->AddPage('P', 'A4');

      $content = '';   
      $content .= fetch_data();  
      // $content .= '</table>'; 
      $pdf->writeHTML($content);
// ---------------------------------------------------------
ob_end_clean(); 
// $test = $row["stud_id_num"];
$test =  $_GET['stud_id'];
 $file_name = $test.'.pdf';
//Close and output PDF document
$pdf->Output($file_name, 'I');
}
?>
