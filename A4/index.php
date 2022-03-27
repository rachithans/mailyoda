<?php 
	define('SECURE_PAGE', true);

	include './includes/functions.php' ;
	include "./includes/db.php";
		
?>
<?php
session_start();
?>
<?php getHeader("index");?>


<main class="pg-main-content ">
    <?php
		//if user is not logged in then user will transfer to login page
		if($_SESSION['fname'] == ""){
			getLogin();

		}
		//if the user is suspended then only the flag will show on index.php
		else if($_SESSION["suspend"] == 1){
			?> <h1 class="text-center bg-info"> Your Account has been Suspended </h1> <?php
		}
		else{
			$userId = $_SESSION['userId'];
			
			 if($_GET['compose'] || $_GET['invalidemail']){
				getCompose();
			}
			else if($_GET['sent/draft'] || $_GET['sent/draftmail'] || $_GET['sent/draftmaildecrypt'] ){
				getSentandDraft();
			}
			
		else {			
				if($_GET['emailsent']){
					echo "<div class='alert text-center alert-success' role='alert'>
							Your email has been sent
					</div>";
				}
				if($_GET['emailsaved']){
					echo "<div class='alert text-center alert-info' role='alert'>
							Your email has been saved
					</div>";
				}
				getInbox();

		}
			
        }
			
	?>

</main>


<?php getFooter();?>

</body>

</html>