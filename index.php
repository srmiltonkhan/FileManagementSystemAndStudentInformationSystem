<?php
  include("db_connection.php");
  if(isset($_SESSION['type'])){
     header("location:dashboard.php");
  }
  $message = "";
  if(isset($_POST["login"])){
      $query = "SELECT * FROM user_details WHERE user_email = :user_email";
      $statement = $pdo_conn->prepare($query);
      $statement->execute(
      array(
      'user_email' => $_POST["user_email"]
       ));
      $count = $statement->rowCount();
      if($count > 0){
        $result = $statement->fetchAll();
        foreach($result as $row){
          if(password_verify($_POST["user_password"], $row["user_password"])){
              if($row['user_status'] == 'active'){
               $_SESSION['type'] = $row['user_type'];
               $_SESSION['user_id'] = $row['user_id'];
               $_SESSION['user_name'] = $row['user_name'];
               $_SESSION['user_image'] = $row['user_image'];
               $_SESSION['last_login_timestamp'] = time(); 
                  header("location:dashboard.php");
              }else{
                $message = "<div class='alert alert-warning'>Your Account is disabled. Please contact with IT Department.</div>";
              }
          }else{
            $message = "<div class='alert alert-warning'>Your Password doesn't match with our system.</div>";
          }
        }
      }else{
        $message = "<div class='alert alert-warning'>Your Email Address doesn't match with our system.</div>";
      }
  }
?>
<!-- Add Dashboard Parent File -->
<?php require 'dashboard_parent_file.php';?>
 <!-- HTML and Head Taq Section -->
<?php echo $html_and_head_section; ?>
<body>
    <div class="container">
      <div class="border p-3 mt-5">
      <div class="from-row">
        <div class="col">
          <div class="image_container" align="center">
            <img src="img/kyau_title/kyau_title.png">
            <div><h1>Welcome to University Management System</h1></div>
          </div>
          <div align="center"><?php echo $message;?></div>
        </div>
      </div>
      <form method="post">
        <div class="form-row mt-5">
          <div class="col-sm-6" align="center">
                <div class="col-sm-6">
                  <img src="img/kyau_logo/kyau_logo.png">
                </div>
                <div class="col-sm-6 mt-3">
                  <p class="text-justify">Please, Login to University Management System by using Your Email Addresss and Password.</p>
                </div>
            </div>
            <div class="col-sm-6">
                  <div class="form-group">
                      <label for="user_email">Your Email</label>
                      <input type="email" name="user_email" id="user_email" class="form-control" autocomplete="off" required="1">
                  </div>
                  <div class="form-group">
                      <label for="user_password">Your Password</label>
                      <input type="Password" name="user_password" id="user_password" class="form-control" autocomplete="off" required="1">
                  </div>

                  <div class="form-row mt-5">
                    <div class="col-sm-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Remember Me</label>
                      </div>
                    </div>
                     <div class="col-sm-6">
                      <div align="right"><a href="#">Forget Password</a></div>
                    </div>                 
                  </div>
                  <div class="form-group mt-5">
                      <input type="submit" name="login" id="login" value="Login" class="form-control btn btn-primary btn-block">
                  </div>

                  <div class="crate_account_section mt-5">
                    <p><a href="#">Not Registered? Create an Account?</a></p>
                  </div>  
                  <div align="right">
                    <p style="font-family: sans-serif; font-size: 10px; color: #00004d;">Design & Developed by Md. Milton Khan</p>
                  </div>              
            </div>
        </div>
      </form>
      </div>
    </div>
<!-- End Body and HTML TaqJavaScript Section-->
<?php echo $end_body_html_and_java_script_section; ?>