<?php
	include("db_connection.php");
	if (isset($_POST['action_hidden'])) {
		if ($_POST['action_hidden'] == 'Add') {
				$query = "INSERT INTO `file_sub_cat`(`file_cat_id`, `file_sub_cat_name`) VALUES (:file_cat_id,:file_sub_cat_name)";
				$statement = $pdo_conn->prepare($query);
				$result = $statement->execute(
					array(
	            ':file_cat_id' => $_POST["file_cat_id"],
	            ':file_sub_cat_name' => $_POST["file_sub_cat_name"]
				));
				$result = $statement->fetchAll();
				if (isset($result)) {
					echo "Sub Category has been saved successfully.";
				}
	     	}	
		}
		//Fetch Data from DB in Modal
		if ($_POST['action_hidden']=='fetch_single') {
			$query = "SELECT * FROM file_sub_cat WHERE file_sub_cat_id = :file_sub_cat_id LIMIT 1";
			$statement = $pdo_conn->prepare($query);
			$statement->execute(
				array(':file_sub_cat_id' => $_POST['file_sub_cat_id'])
			);
			$result = $statement->fetchAll();
			foreach ($result as $row) {
				$output['file_cat_id'] = $row['file_cat_id'];
				$output['file_sub_cat_name'] = $row['file_sub_cat_name'];
			}
			echo json_encode($output);
		}		
	//Update Data from Database
      if ($_POST['action_hidden'] == 'Edit') {
      $query = "UPDATE `file_sub_cat` SET `file_cat_id`=:file_cat_id,`file_sub_cat_name`=:file_sub_cat_name WHERE `file_sub_cat_id`=:file_sub_cat_id";
      $statement = $pdo_conn->prepare($query);
      $statement->execute(
         array(
          ':file_sub_cat_id' => $_POST['file_sub_cat_id'],
          ':file_cat_id' => $_POST['file_cat_id'],
          ':file_sub_cat_name' => $_POST['file_sub_cat_name'],
       ));
      $result = $statement->fetchAll();
      if (isset($result)) {
        echo "Sub Category Information has been edited.";
      		}
    	}	
?>