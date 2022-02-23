<?php
include("db_connection.php");
include 'function.php';
if(isset($_POST['btn_action_hidden'])){
   if($_POST['btn_action_hidden'] == 'load_sub_category'){
    echo fill_sub_cat_list($pdo_conn, $_POST['file_cat_id']);
   }
}
if(isset($_POST['btn_action_hidden'])){
   if($_POST['btn_action_hidden'] == 'load_sup_catgory'){
    echo fill_sup_cat_list($pdo_conn, $_POST['file_sub_cat_id']);
   }
}
		// Start Date and Time in PHP 
		date_default_timezone_set('Asia/Dhaka');
		$currentDateTime=date('m/d/Y H:i:s');
		$create_date = date("Y-m-d", strtotime($currentDateTime));
	if (isset($_POST['action_hidden'])) {
		if ($_POST['action_hidden'] == 'Add') {
					$file_id_num = $_POST['file_id_num'];
					// unique attribute should not be null
					$finder_query = "SELECT * FROM file_mgt WHERE file_id_num = '$file_id_num'";
					$statement = $pdo_conn->prepare($finder_query);
					$statement->execute();
					$row_count = $statement->fetch();
					if ($row_count > 0) {
						echo "File ID Number"."<span class = 'badge badge-warning'>".$_POST['file_id_num']."</span> "." already exist.";	
					}else{
					$upld_file = '';
					if($_FILES["upld_file"]["name"] != ''){
						$upld_file = upld_file();
					}
					$query = "INSERT INTO `file_mgt`(`user_id`, `file_id_num`, `file_cat_id`, `file_sub_cat_id`, `file_sup_cat_id`, `file_name`, `upld_file`, `create_date`) VALUES (:user_id,:file_id_num,:file_cat_id,:file_sub_cat_id,:file_sup_cat_id,:file_name,:upld_file,:create_date)";
					$statement = $pdo_conn->prepare($query);
					$statement->execute(array(
					':user_id' => $_SESSION["user_id"],
					':file_id_num'=>$_POST['file_id_num'],
					':file_cat_id'=>$_POST['file_cat_id'],
					':file_sub_cat_id'=>$_POST['file_sub_cat_id'],
					':file_sup_cat_id'=>$_POST['file_sup_cat_id'],
					':file_name'=>$_POST['file_name'],
					':upld_file'=>$upld_file,
					':create_date'=>$create_date
				));
					$result = $statement->fetchAll();
					if (isset($result)) {
						echo "File Information has been saved successfully.";
					}
				}

			}
		}
		//Fetch Data from DB in Modal
		if ($_POST['action_hidden']=='fetch_single') {
			$query = "SELECT * FROM file_mgt 
			WHERE file_id = :file_id LIMIT 1";
			$statement = $pdo_conn->prepare($query);
			$statement->execute(
				array(':file_id' => $_POST['file_id'])
			);
			$result = $statement->fetchAll();
			foreach ($result as $row) {
				$output['file_id_num'] = $row['file_id_num'];
				$output['file_cat_id'] = $row['file_cat_id'];
				$output['file_sub_cat_id'] = $row['file_sub_cat_id'];
				$output["sub_select_box"] = fill_sub_cat_list($pdo_conn, $row["file_cat_id"]);// drop down data show in rltion db
				$output['file_sup_cat_id'] = $row['file_sup_cat_id'];
				$output["sup_select_box"] = fill_sup_cat_list($pdo_conn, $row["file_sub_cat_id"]); // drop down data show in rltion db
				$output['file_name'] = $row['file_name'];
				if($row["upld_file"] != '')
				{
					$output['image_view'] = '<img src="file/'.$row["upld_file"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_file" value="'.$row["upld_file"].'" />';
				}
				else
				{
					$output['image_view'] = '<input type="hidden" name="hidden_file" value="" />';
				}
				$output['upld_file'] = $row['upld_file'];

			}
			echo json_encode($output);
		}
	//Update Data from Database
      if ($_POST['action_hidden'] == 'Edit') {
      	$upld_file = '';
		if($_FILES["upld_file"]["name"] != '')
		{
			
			if ($_POST['file_id']) {
				$query = "SELECT * FROM file_mgt WHERE file_id = :file_id LIMIT 1";
				$statement = $pdo_conn->prepare($query);
				$statement->execute(
					array(':file_id' => $_POST['file_id'])
				);
				$result = $statement->fetchAll();
				foreach ($result as $row) {
					$filename = 'file/'.$row['upld_file'].'';	
					if (file_exists($filename) == true) {
						unlink($filename);
						$upld_file = upld_file();
					}else{
						$upld_file = upld_file();
					}
										
				}
			}
		}    	
      $query = "UPDATE `file_mgt` SET `user_id`=:user_id,`file_id_num`=:file_id_num,`file_cat_id`=:file_cat_id,`file_sub_cat_id`=:file_sub_cat_id,`file_sup_cat_id`=:file_sup_cat_id,`file_name`=:file_name,`upld_file`=:upld_file,`create_date`=:create_date WHERE file_id=:file_id";
      $statement = $pdo_conn->prepare($query);
      $statement->execute(
         array(
          ':file_id' => $_POST['file_id'],
          ':user_id' => $_SESSION["user_id"],
          ':file_id_num' => $_POST['file_id_num'],
          ':file_cat_id' => $_POST['file_cat_id'],
          ':file_sub_cat_id' => $_POST['file_sub_cat_id'],
          ':file_sup_cat_id' => $_POST['file_sup_cat_id'],
          ':file_name' => $_POST['file_name'],
          ':upld_file' => $upld_file,
          ':create_date' => $create_date
       ));
      $result = $statement->fetchAll();
      if (isset($result)) {
        echo "File Information has been edited.";
      		}
    	}				
?>