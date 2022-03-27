<!-- // This code contains code re-used from A3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
// This code is used as a starting point for my solution for A4 -->
<?php define('SECURE_PAGE', true); 
include './includes/functions.php' ;
include "./includes/db.php";

?>
<?php
session_start();
?>

<?php getHeader("profile.php");?>


<main class="pg-main-content">
    <!-- Content here -->
    <!-- // Referenced from https://dal.brightspace.com/d2l/le/content/201526/viewContent/2923422/View Accessed on MArch 1 2022 -->

    <?php
		if($_SESSION['fname'] == ""){
      header("Location: ./index.php");
		}
		else{
      if($_SESSION["suspend"] == 1){
        ?> <h1 class="text-center bg-info mb-3"> Your Account has been Suspended </h1> <?php
      }
            // if the profile has been upadted then it will be updated in datbase and a flag will display on page
            if($_GET['update']){

				if($_POST["fname"] !== $_SESSION["fname"] || $_POST["lname"] !== $_SESSION["lname"] || $_POST["email"] !== $_SESSION["email"] ){
                    ?>
    <div class="alert alert-primary" role="alert">
        Your Profile has been updated
    </div>
    <?php
                }
                if($_POST["fname"] !== $_SESSION["fname"]){

                    $fname = $_POST["fname"];
                    $_SESSION["fname"] = $fname;
                    $userId = $_SESSION['userId'];

                    $sql = "UPDATE je_users SET je_user_firstname =  '$fname'  WHERE je_user_id = $userId" ;
                    // Issue the command 
                    if (!$db->query($sql)) {
                        die("Error ($db->errno) $db->error<br>SQL = $sql\n");
                    }
        
                }

                if($_POST["lname"] != $_SESSION["lname"]){
                    $lname = $_POST["lname"];
                    $_SESSION["lname"] = $lname;
                    $userId = $_SESSION['userId'];
                  

                    $sql = "UPDATE je_users SET je_user_lastname =  '$lname'  WHERE je_user_id = $userId" ;
                    // Issue the command 
                    if (!$db->query($sql)) {
                        die("Error ($db->errno) $db->error<br>SQL = $sql\n");
                    }
        
                }
                if($_POST["email"] != $_SESSION["email"]){

                    $email = $_POST["email"];
                    $_SESSION["email"] = $email;
                    $userId = $_SESSION['userId'];
                  
                    $sql = "UPDATE je_login SET je_login_email =  '$email'  WHERE je_login_id = $userId" ;
                    // Issue the command 
                    if (!$db->query($sql)) {
                        die("Error ($db->errno) $db->error<br>SQL = $sql\n");
                    }
        
                }

            }
            
           
			// https://learn.zybooks.com/zybook/DALCSCI2170SampangiWinter2022/chapter/5/section/3 Accessed on March 1 2022
			$userId = $_SESSION['userId'];
           //getting the user details from database
			$sql = "SELECT * from je_login where je_login_id = $userId";
			$result = $db -> query($sql);
			while ($res = $result->fetch_assoc()) {

		?>
    <div class="container">
        <div class="text-center">
            <img src="./img/user-profile.png" class="img-fluid img-thumbnail" alt="Responsive image" style="width: 12%"
                style="height: 15%">
        </div>
        <form action="./profile.php?update=updatedprofile" class="container col-md-8 bg-light mb-5" method="post">

            <div class="form-group mt-3">
                <label for="fname" class="mt-3"> First Name</label>
                <input type="text" class="form-control " id="fname" name="fname"
                    value="<?php echo $_SESSION["fname"]; ?>">
            </div>

            <div class="form-group">
                <label for="lname" class="mt-3"> Last Name</label>
                <input type="text" class="form-control " id="lname" name="lname"
                    value="<?php echo $_SESSION["lname"]; ?>">
            </div>

            <div class="form-group">
                <label for="Email1" class="mt-3">Email address</label>
                <input type="email" class="form-control " id="exampleInputEmail1" name="email"
                    aria-describedby="emailHelp" value="<?php echo $_SESSION["email"]; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="mt-3">Password</label>
                <input type="password" class="form-control " id="Password1" name="password" disabled
                    value="<?php echo $res["je_login_password"]; ?>">
            </div>

            <button type="submit" class="btn btn-primary mt-3 mb-3">Submit</button>

        </form>
        <?php 
                 
                }
            } ?>

</main>
<?php getFooter();?>

</body>

</html>
