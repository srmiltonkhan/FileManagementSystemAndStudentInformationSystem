<?php 
function fill_faculty_list($pdo_conn){
	 $query = "SELECT * FROM faculty WHERE faculty_status = 'active' ORDER BY faculty_name ASC";
	 $statement = $pdo_conn->prepare($query);
	 $statement->execute();
	 $result = $statement->fetchAll();
	 $output = '';
	 foreach($result as $row){
	  $output .= '<option value="'.$row["faculty_id"].'">'.$row["faculty_name"].'</option>';
	 }
	 return $output;
}
//Retrive Data in Brand Dropdown 
function fill_department_list($pdo_conn,$faculty_id){
	$query = "SELECT * FROM department WHERE dep_status = 'active' AND faculty_id = '".$faculty_id."' ORDER BY dep_name ASC";
	$statement = $pdo_conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "<option value = '' data-size='2'>Select Department</option>";
	foreach ($result as $row ) {
		$output.="<option value ='".$row["department_id"]."'>".$row["dep_name"]."</option>";
	}
	return $output;
}
//Retrive Data in Brand Dropdown 
function fill_program_list($pdo_conn,$department_id){
	$query = "SELECT * FROM program WHERE program_status = 'active' AND department_id = '".$department_id."' ORDER BY program_name ASC";
	$statement = $pdo_conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "<option value = '' data-size='2'>Select Program</option>";
	foreach ($result as $row ) {
		$output.="<option value ='".$row["program_id"]."'>".$row["program_name"]."</option>";
	}
	return $output;
}
  function auto_bath_number($num) {
    if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    }
    return $num.'th';
  }

  	function upload_image(){
		if(isset($_FILES["profile_image"])){
		    // $cur_date = date('Ymdhis');
		    $stud_id_num=  $_POST['stud_id_num'];
			$extension = explode('.', $_FILES['profile_image']['name']);
			$new_name = $stud_id_num . '.' . $extension[1];
			$destination = './img/stud_image/' . $new_name;
			move_uploaded_file($_FILES['profile_image']['tmp_name'], $destination);
			return $new_name;
		}
	}
	// File category Dropdown
function fill_file_category_list($pdo_conn){
	 $query = "SELECT * FROM file_cat ORDER BY category_name ASC";
	 $statement = $pdo_conn->prepare($query);
	 $statement->execute();
	 $result = $statement->fetchAll();
	 $output = '';
	 foreach($result as $row){
	  $output .= '<option value="'.$row["file_cat_id"].'">'.$row["category_name"].'</option>';
	 }
	 return $output;
}
//Retrive Data in Sub-Category Dropdown 
function fill_sub_cat_list($pdo_conn,$file_cat_id){
	$query = "SELECT * FROM file_sub_cat WHERE file_cat_id = '".$file_cat_id."' ORDER BY file_sub_cat_name ASC";
	$statement = $pdo_conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "<option value = '' data-size='2'>Select Sub-Category</option>";
	foreach ($result as $row ) {
		$output.="<option value ='".$row["file_sub_cat_id"]."'>".$row["file_sub_cat_name"]."</option>";
	}
	return $output;
}
//Retrive supercategory Dropdown 
function fill_sup_cat_list($pdo_conn,$file_sub_cat_id){
	$query = "SELECT * FROM file_sup_cat WHERE file_sub_cat_id = '".$file_sub_cat_id."' ORDER BY file_sup_cat_name ASC";
	$statement = $pdo_conn->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = "<option value = '' data-size='2'>Select Sup-Category</option>";
	foreach ($result as $row ) {
		$output.="<option value ='".$row["file_sup_cat_id"]."'>".$row["file_sup_cat_name"]."</option>";
	}
	return $output;
}
function upld_file(){
	if(isset($_FILES["upld_file"])){
		$file_id_num = $_POST["file_id_num"];
		// $cur_date = date('Ymdhis');
		$extension = explode('.', $_FILES['upld_file']['name']);
		$new_name = $file_id_num . '.' . $extension[1];// extension 1 means after file name . 1 serial
		$destination = './file/' . $new_name;
		move_uploaded_file($_FILES['upld_file']['tmp_name'], $destination);
		return $new_name;
	}
}		
?>