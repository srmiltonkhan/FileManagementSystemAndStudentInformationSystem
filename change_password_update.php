<!-- change_password_update.php -->
<?php
require_once("db_connection.php");
if(isset($_POST['page']))
{
  if($_POST['page'] == 'change_password')
  {
    if($_POST['action'] == 'change_password')
    {
      $query = "UPDATE user_details SET user_password= :user_password WHERE user_id =:user_id";
      $statement = $pdo_conn->prepare($query);
      $statement->execute(
         array(
          ':user_id' => $_SESSION['user_id'],
          ':user_password'  =>  password_hash($_POST['user_password'], PASSWORD_DEFAULT)      
       ));
      $result = $statement->fetchAll(); 
      if (isset($result)) {
        echo "Password has been changed.";
          }
       session_destroy();   
    }
  } 
}
?>



