<!-- login from referenced from https://getbootstrap.com/docs/4.0/components/forms/ on March 1 2022-->
<?php 
//taken from https://www.sitepoint.com/community/t/prevent-direct-access-to-php-files/320889/3 on 10 March 2022

// This code contains code re-used from Assignmenet 3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
// This code is used as a starting point for my solution for A4
	//preventing direct access from url
    if (!defined('SECURE_PAGE'))
    {
        header("Location: ../index.php");
    }
    
    include './includes/db.php'; 
?>

<?php
session_start();
?>
<?php
    //if something will be entered to login form then it will check the details in database
    if(strlen($_POST['email'])>0 && strlen($_POST['password'])>0) {
        $postEmail = sanitizeData($_POST['email']);
        $postPassword = sanitizeData($_POST['password']);
        $sql = "SELECT * FROM je_login where je_login_email = '$postEmail' ";
		$result = $db->query($sql);
		if (mysqli_num_rows($result) > 0) {
            $row = $result -> fetch_assoc();
            // https://learn.zybooks.com/zybook/DALCSCI2170SampangiWinter2022/chapter/8/section/2, Verifying the hashed password
            if (password_verify($postPassword, $row["je_login_password"])) {
                $dbUserId =  $row['je_login_id'];
                $_SESSION['loginId'] = $row['je_login_id'];
                $sql1 = "SELECT * FROM je_users where je_user_login_id = $dbUserId";
    
                $row1 = $db -> query($sql1) -> fetch_assoc();
    // Sessions learned form  https://learn.zybooks.com/zybook/DALCSCI2170SampangiWinter2022/chapter/8/section/1 on 7 March 2022
                $_SESSION['fname'] = $row1['je_user_firstname'];
                $_SESSION['lname'] = $row1['je_user_lastname'];
                $_SESSION['userId'] = $row1['je_user_id'];
                $_SESSION["email"] = $_POST['email'];
                $_SESSION["suspend"] = $row1['je_user_suspended'];
                $_SESSION["admin"]  = $row1['je_user_role'];
                header("Location: ./index.php");
    
            }
            else{
                header("Location: ./index.php?invalid=1");
              }
		}
        else{
            header("Location: ./index.php?invalid=1");
          }
       
    }
    else{
        if($_GET["registered"]==1){
            ?>
            <h3 class="text-center text-danger"> Your Account has been created. Please enter your credentials to login </h3>
            <?php
        }

?>
<!-- Form design reference from https://getbootstrap.com/docs/4.0/components/forms/ on 7 March 2022 -->

<div class="container mt-5 col-md-6 col-sm-5">
    <form action="./index.php" method="post" class="bg-light">
        <h1 class="text-center"> Login </h1>

        <div class="form-group mt-4 ms-3 me-3">
            <label for="Email1">Email address</label>
            <input type="email" class="form-control " id="exampleInputEmail1" name="email" aria-describedby="emailHelp"
                placeholder="Enter email">
        </div>
        <div class="form-group mt-4 ms-3 me-3">
            <label for="exampleInputPassword1" class="mt-3">Password</label>
            <input type="password" class="form-control " id="Password1" name="password" placeholder="Password">
        </div>

        <div class="text-center cold-md-6 mb-4 pb-4">
            <button type="submit" class="btn btn-primary text-center btn-lg mt-5">Login</button>
        </div>
        
     
    </form>
    <div class="text-center cold-md-6 mb-4 pb-4">
            <button type="button" onclick= "window.location.href = 'register.php'" class="btn btn-success text-center btn-lg mt-5">New to this MailYoda? Register here.</button>
    </div>>
</div>
<?php
        if($_GET["invalid"]==1){
         ?>
<div class="text-center">
    <p class="text-danger lead"><strong> Invalid Credentials</strong> </p>
</div>
<?php }
    }
  
    ?>