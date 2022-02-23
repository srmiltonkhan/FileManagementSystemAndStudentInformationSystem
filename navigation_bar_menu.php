                  
<div class='col-2 clearfix'>
    <ul class='nav-menu list-unstyled d-flex flex-md-row align-items-md-center float-right'>     
      <li class='nav-item dropdown'>
          <a id='languages' rel='nofollow' data-target='#' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' class='nav-link language  dropdown-toggle'> 
            <img class='rounded-circle' src='img/user_image/<?php echo $_SESSION['user_image'];?>' onerror="this.onerror=null; this.src='img/user_image/default_image.jpg'" alt='' width='30' height='30'>
              <span class='d-none d-sm-inline-block'><?php echo $_SESSION["user_name"]; ?></span>
          </a>
          <ul aria-labelledby='languages' class='dropdown-menu'>
            <li><a rel='nofollow' href='profile.php' class='dropdown-item'><i class='fa fa-user'></i>My Profile</a></li>
            <li><a rel='nofollow' href='change_password.php' class='dropdown-item'><i class='fa fa-edit'></i>Change Password</a></li>
            <li>
              <a rel='nofollow' href='logout.php' class='dropdown-item'><i class='fas fa-sign-out-alt'></i>Logout</a>
            </li>                                               
          </ul>
      </li>                   
    </ul>
</div> 


            