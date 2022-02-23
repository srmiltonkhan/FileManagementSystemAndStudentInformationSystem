<?php
include("db_connection.php");
include 'function.php';
if(isset($_POST['btn_action_hidden'])){
   if($_POST['btn_action_hidden'] == 'load_sub_category'){
    echo fill_sub_cat_list($pdo_conn, $_POST['file_cat_id']);
   }
}

	if (isset($_POST['action_hidden'])) {
		if ($_POST['action_hidden'] == 'Add') {
					$query = "INSERT INTO `file_sup_cat`(`file_cat_id`, `file_sub_cat_id`, `file_sup_cat_name`) VALUES (:file_cat_id,:file_sub_cat_id,:file_sup_cat_name)";
					$statement = $pdo_conn->prepare($query);
					$statement->execute(array(
					':file_cat_id'=>$_POST['file_cat_id'],
					':file_sub_cat_id'=>$_POST['file_sub_cat_id'],
					':file_sup_cat_name'=>$_POST['file_sup_cat_name']
				));
				$result = $statement->fetchAll();
				if (isset($result)) {
					echo "Sup Category Information has been saved successfully.";
				}
			}
		}
		//Fetch Data from DB in Modal
		if ($_POST['action_hidden']=='fetch_single') {
			$query = "SELECT * FROM file_sup_cat WHERE file_sup_cat_id = :file_sup_cat_id LIMIT 1";
			$statement = $pdo_conn->prepare($query);
			$statement->execute(
				array(':file_sup_cat_id' => $_POST['file_sup_cat_id'])
			);
			$result = $statement->fetchAll();
			foreach ($result as $row) {
				$output['file_cat_id'] = $row['file_cat_id'];
				$output['file_sub_cat_id'] = $row['file_sub_cat_id'];
				$output['file_sub_cat_id'] = $row['file_sub_cat_id'];
				$output["sub_select_box"] = fill_sub_cat_list($pdo_conn, $row["file_cat_id"]);// drop down data show in rltion db
				$output['file_sup_cat_name'] = $row['file_sup_cat_name'];
			}
			echo json_encode($output);
		}
	//Update Data from Database
      if ($_POST['action_hidden'] == 'Edit') {
      $query = "UPDATE `file_sup_cat` SET `file_cat_id`=:file_cat_id,`file_sub_cat_id`=:file_sub_cat_id,`file_sup_cat_name`=:file_sup_cat_name WHERE file_sup_cat_id = :file_sup_cat_id";
      $statement = $pdo_conn->prepare($query);
      $statement->execute(
         array(
          ':file_sup_cat_id' => $_POST['file_sup_cat_id'],
          ':file_cat_id' => $_POST['file_cat_id'],
          ':file_sub_cat_id' => $_POST['file_sub_cat_id'],
          ':file_sup_cat_name' => $_POST['file_sup_cat_name'],
       ));
      $result = $statement->fetchAll();
      if (isset($result)) {
        echo "Sup Category Information has been edited.";
      		}
    	}			
?>