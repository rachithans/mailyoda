<?php
    include './includes/db.php'; 

    session_start();
    $email = $_SESSION["email"];

?>

    <!-- This is the form where user can compose the email and submit that. This code is referenced from Assignment 3 and bootstrap
        https://getbootstrap.com/docs/4.0/components/forms/ -->
    <form action="index.php?send" method="post" class="bg-light form-inline">
       <?php if($_GET['invalidemail']){?>
       <!-- if the user has enetered the email which does not exist in the system then it will show the error to user -->
                <h4 class="text-center text-danger"> The receiptant email does not exist </h2>
                
       <?php } ?>
	    <div class="form-group form-inline mt-4 ms-3 me-3">
            <label for="toemail">To email</label>
            <input type="email" class="form-control " id="toemail" required name="toemail" aria-describedby="emailHelp ">
        </div>
		
		<div class="form-group mt-4 ms-3 me-3">
            <label for="fromemail">From email</label>
            <input type="email" class="form-control "  id="fromemail" name="fromemail" aria-describedby="emailHelp "
                value="<?php echo $email?>" disabled>
        </div>

        <div class="form-group mt-4 ms-3 me-3">
            <label for="subject">Email Subject</label>
            <input type="text" class="form-control" id="subject" value= "<?php $subject='';
                if($_GET['invalidemail']){
                        $subject = $_SESSION['subject'] ;
                    } 
                echo $subject; 
            ?> " required name="subject" aria-describedby="emailHelp">
        </div>
        <div class="form-group mt-4 ms-3 me-3">
            <label for="subject">Message</label>
            <?php $message = "";?>
            <textarea class="form-control" id="message" name="message"  required rows="10"><?php if($_GET['invalidemail']){ $message = $_SESSION['message'] ;} echo $message; ?> </textarea>        
            </div>
  

        <div class="text-center cold-md-6 mb-4 mt-3 pb-4">
		<input type="submit" formaction="./includes/send.php?send=1" value="Send Email" class="btn-info" id="btn-submit">  
        <input type="submit" class="btn-warning" formaction="./includes/send.php?sendencrypted=2" value="Encrypt and Send Email" id="btn-submit">  
        <input type="submit" class="btn-success" formaction="./includes/save.php?saveEncrypted=3" value="Encrypt and Save Email" id="btn-submit">  
        <input type="submit" class="btn-primary" formaction="./includes/save.php?save=4" value="Save Email(without Encrypt)" id="btn-submit">  
        </div>
        
        <div class="text-center cold-md-6 mb-4 pb-4">
        <button type="reset" class="btn btn-danger ">Cancel</button>
        </div>
        
    </form>

