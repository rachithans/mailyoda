<?php 
define('SECURE_PAGE', true);

 include 'db.php'; 
 include 'functions.php' ;

session_start();
// sending normal email to user
    if($_GET['send']){
        if ($_POST['toemail'] !== "" && $_POST['fromemail'] !== "" && $_POST['subject'] !== "" && $_POST['message'] !== "" ) {
            $toemail = sanitizeData($_POST['toemail']);
            $fromemail = sanitizeData($_SESSION['email']);
            $subject =  sanitizeData($_POST['subject']);
            $message = sanitizeData($_POST['message']);
            $fromemailId = sanitizeData($_SESSION['loginId']);


            $sql = "SELECT * FROM je_login where je_login_email = '$toemail'";
		    
            $result = $db->query($sql);
           
		if (mysqli_num_rows($result) > 0) {
            $row = $result -> fetch_assoc();
            $toemailId = $row['je_login_id'];

        

             $date = date("Y-m-d h:i:s");
            //storing data in inbox table             
             $sql = "INSERT INTO je_inbox (je_email_from_email,je_email_to_id,je_email_subject,je_email_content,je_email_enc,je_date_received) 
                        VALUES (' $fromemail','$toemailId', '$subject',' $message',0,'$date')";
             if ($db->query($sql)) {
                echo "email sent";
             }else{
                die("Error ($db->errno) $db->error<br>SQL = $sql\n");

             }
             //storing data in sent/drafts  table
             $sql = "INSERT INTO je_email_sentdrafts (je_sentdraft_to_email,je_sentdraft_from_id,je_sentdraft_subject,je_sentdraft_content,je_sentdraft_draft,je_sentdraft_enc,
             je_sentdraft_datetime)
                        VALUES ('$toemail','$fromemailId', '$subject',' $message',0,0,'$date')";
             if ($db->query($sql)) {
                echo "email sent";
             }else{
                die("Error ($db->errno) $db->error<br>SQL = $sql\n");

             }
             //if email is sent then user will be transferred to inbox page
             header("Location: ../index.php?emailsent=1");
    }else{
        $_SESSION['message']  = $_POST['message'];
        $_SESSION['subject'] = $_POST['subject'];
        //if receiptant email is wrong then user will stay in compose.php page
        header("Location: ../index.php?invalidemail=1");    
    }
}
    

}
// sending encrypted email
if($_GET['sendencrypted']){
    if ($_POST['toemail'] !== "" && $_POST['fromemail'] !== "" && $_POST['subject'] !== "" && $_POST['message'] !== "" ) {
        $toemail = sanitizeData($_POST['toemail']);
        $fromemail = sanitizeData($_SESSION['email']);
        $subject =  sanitizeData($_POST['subject']);
        $message = sanitizeData($_POST['message']);
        $fromemailId = sanitizeData($_SESSION['loginId']);


        $sql = "SELECT * FROM je_login where je_login_email = '$toemail'";
        $result = $db->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = $result -> fetch_assoc();
            $toemailId = $row['je_login_id'];

        
            $encremail = "";
            $decr = "";
            
            $wordencrypt = explode(" ",$message);
            $wordfind = array();
            $i=0;
            // https://learn.zybooks.com/zybook/DALCSCI2170SampangiWinter2022/chapter/10/section/2, Regex information
            // https://stackoverflow.com/questions/5191560/how-to-match-all-email-addresses-at-a-specific-domain-using-regex, Regex for email
          
            $arrayRegex = array( "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/","/c.+p/","/T.+p/i","/e.+t/i","/e.+t/i","/a.+e/i","/a.*w/i","/c.+e/i","/u.+e/","/^[0-9\-\(\)\/\+\s]*$/");
            
            //encrypting the words that regex will match first it takes word one by one then it compares to regex if word is matched then its ascii
            // value will be shifted shifted by modulo 16  and stored in new associative array in the key value pair
            foreach ($wordencrypt as $msg){
                foreach($arrayRegex as $reg){
                    if(preg_match($reg,$msg)){
                    
                        for($j = 0; $j<strlen($msg);$j++){
                            // https://www.w3schools.com/php/func_string_ord.asp
                            $r = ord($msg[$j])%16;
                            //  https://www.php.net/manual/en/function.chr.php
                            $encrmsg  = $encrmsg . chr(ord($msg[$j])+$r);
                        }
                        
                        
                        $wordencrypt[$i] = $encrmsg;
                        $wordfind += [$msg => $encrmsg];
                        $encrmsg = "";
                    }
                }
                $i ++;
            }
            
            $eas = '$eas$';
            foreach($wordfind as $word => $value){
                // replacing values in message
            $message = str_replace($word,$eas.$value,$message); 
            }
            
            $date = date("Y-m-d h:i:s");
            // storing values in inbox table
            $sql = "INSERT INTO je_inbox (je_email_from_email,je_email_to_id,je_email_subject,je_email_content,je_email_enc,je_date_received) 
                    VALUES (' $fromemail','$toemailId', '$subject',' $message',1,'$date')";
            if ($db->query($sql)) {
                    echo "email sent";
            }else{
                die("Error ($db->errno) $db->error<br>SQL = $sql\n");

            }
            // storing values in sent/drafts table
            $sql = "INSERT INTO je_email_sentdrafts (je_sentdraft_to_email,je_sentdraft_from_id,je_sentdraft_subject,je_sentdraft_content,
                je_sentdraft_draft,je_sentdraft_enc,je_sentdraft_datetime) 
                VALUES ('$toemail','$fromemailId','$subject',' $message',0,1,'$date')";
            if ($db->query($sql)) {
          }else{
         die("Error ($db->errno) $db->error<br>SQL = $sql\n");

        }
        // sending user to inbox once email is saved
            header("Location: ../index.php?emailsent=1");
        }else{
            $_SESSION['message']  = $_POST['message'];
            $_SESSION['subject'] = $_POST['subject'];
            //if receiptant email is wrong then user will stay in compose.php page
            header("Location: ../index.php?invalidemail=1");    
        }
    }

}
?>