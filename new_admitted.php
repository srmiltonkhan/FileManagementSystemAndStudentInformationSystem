<!-- student_filter.php -->
 <?php 
  include("db_connection.php");
  if (!isset($_SESSION['type'])) {
    header("location:index.php");
  }
?>
<?php

 function fetch_data()  
 {   
      global $pdo_conn;
      $output = '';  
           $sql = "SELECT * FROM stud_bsc_info INNER JOIN stud_ape_info ON stud_ape_info.stud_id = stud_bsc_info.stud_id INNER JOIN faculty ON  faculty.faculty_id = stud_bsc_info.faculty_id INNER JOIN department ON department.department_id = stud_bsc_info.department_id INNER JOIN program ON program.program_id = stud_bsc_info.program_id INNER JOIN user_details ON user_details.user_id = stud_bsc_info.user_id WHERE stud_ape_info.stud_status = 'New Admitted'";  
      $statement = $pdo_conn->prepare($sql);
      $statement->execute();
      foreach($statement->fetchAll() as $row)  
      {       
      $output .= '<tr>  
                          <td>'.$row["stud_id_num"].'</td>  
                          <td>'.$row["stud_name"].'</td>   
                          <td>'.$row["dep_name"].'</td>  
                          <td>'.$row["program_name"].'</td>  
                          <td>'.$row["mobile"].'</td> 
                          <td>'.$row["batch"].'</td>                       
                     </tr>  
                          ';  
      }  
      return $output;  
 } 
require_once('class/tcpdf/tcpdf.php');  

 if(isset($_POST["create_pdf"]))  
 {  
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'B', 12);  
        // Title
        $this->Cell(0, 10, '', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 15, 'Khawja Yunus Ali University', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', '', 10);  
        $this->Cell(0, 15, 'New Admitted Student Report', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        // Logo
        $image_file = 'kyau_logo.png';
        $this->Image($image_file, 10, 5, 20, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
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
$pdf->SetTitle('New Admitted Student Report');
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
$pdf->AddPage('L', 'A4');

      $content = '';  
      $content .= '  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th>ID</th>  
                <th>Name</th>  
                <th>Department</th>  
                <th>Program</th>  
                <th>Number</th>  
                <th>Batch</th>  
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>'; 
      $pdf->writeHTML($content);
// ---------------------------------------------------------
ob_end_clean(); 
//Close and output PDF document
$pdf->Output('New Admitted Student Report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
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
              <h2 class="no-margin-bottom">New Admitted Student Information</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >New Admitted Student List</div>
                <div class="col p-1" align="right">
                     <form method="post">  
                          <input type="submit" name="create_pdf" class="btn btn-sm btn-primary" value="PDF" />  
                     </form>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                 <div class="table-responsive">  
                     <table id="stud_tbl" class="table table-bordered">  
                          <tr>  
                               <th>ID</th>  
                               <th>Name</th>   
                               <th>Department</th>  
                               <th>Program </th>  
                               <th>Mobile </th>  
                               <th>Batch</th>  
                          </tr>  
                     <?php  
                     echo fetch_data();  
                     ?>  
                     </table>  
  
                </div>                    
               
               </div>
            </div>

          </section>    
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
