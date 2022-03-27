<?php
//taken from https://www.sitepoint.com/community/t/prevent-direct-access-to-php-files/320889/3
// This code contains code re-used from Assignmenet 3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
// This code is used as a starting point for my solution for A4

//preventing direct access from url
  if (!defined('SECURE_PAGE'))
    {
        header("Location: ../index.php");
    }
    

session_start();

$home = "";
  $loginValid = 0;
  if($type === "admin"  ){
    $home = "../";
  }

if(isset($_GET['var'])){
    include $home . "includes/logout.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>MailYoda</title>


    <!--  https://getbootstrap.com/ Accessed on March 1 2022  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Link to the main CSS file -->
    <link href="<?php echo $home; ?>css/main.css" rel="stylesheet">


</head>

<body>

    <header class="pg-banner bg-primary sticky-top">
        <?php
		//if the session is set then in navr bar fname and lname will be shown and also logout button.
        if (isset($_SESSION['fname'])) {
            //if the user has chanes the profile then session will be updated
            if($_GET['update']){
                
                if($_POST["fname"] != $_SESSION["fname"] || $_POST["lname"] != $_SESSION["lname"] || $_POST["email"] != $_SESSION["email"] ){
                    if($_POST["fname"] != $_SESSION["fname"]){
                         $_SESSION["fname"] = $_POST["fname"] ;
                    }
                    if($_POST["lname"] != $_SESSION["lname"]){
                        $_SESSION["lname"] = $_POST["lname"] ;
                   }
                   if($_POST["email"] != $_SESSION["email"]){
                    $_SESSION["email"] = $_POST["email"] ;
               }
                }
            }
        }
        
	?>
        <!-- Navbar design taken from  https://getbootstrap.com/docs/4.0/components/navbar/ on 10 march -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">

            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo $home; ?>index.php">
                    <!-- logo created using draw.io -->
                    <img src="<?php echo $home; ?>./img/logo.png" alt="" width="30" height="24"
                        class="d-inline-block align-text-top"> <span class="text-white">MailYoda</span>
                </a>
                <?php  if (!isset($_SESSION['fname'])) { ?>
                    <ul class="nav ">

                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo $home; ?>register.php">Register</a>
                        </li>
                    </ul>
                    <?php } ?>
                <?php  if (isset($_SESSION['fname'])) { ?>


                <ul class="nav ">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $home; ?>index.php?inbox=1">Inbox</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $home; ?>index.php?compose=1">Compose</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo $home; ?>index.php?sent/draft=2">Sent/Drafts</a>
                    </li>
                    
                    <!-- dropdown menu for navigation bar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?>!
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="ms-3 " href='<?php echo $home; ?>profile.php'>MY Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="nav-item"><a class="ms-3 " href="<?php echo $home; ?>index.php?var=1">Logout</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </ul>
                    </li>

                </ul>
                <?php
		}
		?>
            </div>
        </nav>
       
        <!-- From https://getbootstrap.com/docs/5.1/getting-started/introduction/ on 10 march 2022-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </header>