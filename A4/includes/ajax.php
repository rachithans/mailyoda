<?php
    include 'db.php'; 
// This code contains code re-used from GL5 in this course. This code is used with Prof. Raghav Sampangi's permission. 
// This code is used as a starting point for my solution for A4
function sanitizeData($inputData) {
    $returnValue = trim($inputData);
    $returnValue = htmlspecialchars($returnValue);
    $returnValue = stripslashes($returnValue);

    return $returnValue;
}
		if ($_POST['fname'] !== "" && $_POST['lname'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" ) {
			$email_error = false;
			$fname = sanitizeData($_POST['fname']);
			$lname = sanitizeData($_POST['lname']);
			$email = sanitizeData($_POST['email']);
            $password = sanitizeData($_POST['password']);
			// https://learn.zybooks.com/zybook/DALCSCI2170SampangiWinter2022/chapter/10/section/2
			//Regex to check first letter is capital or not 
			$regex = "/^[A-Z]/";
			//regex for email https://www.regextester.com/94044 on 15 March 2022
			$regexemail = "/^[._A-Za-z0-9-\\+]+(\\.[._A-Za-z0-9-]+)?(@dal.ca|@jediacademy.edu|@theforce.org)$/";
			if (!preg_match($regex, $fname)) {
					$fname = ucfirst($fname);
				}
			if (!preg_match($regex, $lname)) {
				$lname = ucfirst($lname);
			}
			if (!preg_match($regexemail, $email)) {
                echo "error";
            }
            else{
                // https://learn.zybooks.com/zybook/DALCSCI2170SampangiWinter2022/chapter/8/section/2, Hasing the password
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);

                $sql = "INSERT INTO je_login (je_login_email,je_login_password) VALUES ('$email','$passwordHash')";
                     if ($db->query($sql)) {
                        echo "  account registered";

                     }else{
                        die("Error ($db->errno) $db->error<br>SQL = $sql\n");

                     }
                     $login_id = 0;
                     $sql = "SELECT * FROM je_login where je_login_email = '$email' AND je_login_password = '$passwordHash'";
                     $result = $db->query($sql);
                     if (mysqli_num_rows($result) > 0) {
                         $row = $result -> fetch_assoc();
                         $loginId =  $row['je_login_id'];
                         $sql = "INSERT INTO je_users (je_user_firstname,je_user_lastname,je_user_login_id,je_user_role,je_user_suspended) VALUES ('$fname','$lname','$loginId',0,0)";
                         if ($db->query($sql)) {
                             echo "  account registered";
 
                         }
                     }
                 
        
             }
        }
	
    ?>