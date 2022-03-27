<?php
// https://learn.zybooks.com/zybook/DALCSCI2170SampangiWinter2022/chapter/5/section/3 Accessed on March 1 2022
	// Create new DB connection object
	
//taken from https://www.sitepoint.com/community/t/prevent-direct-access-to-php-files/320889/3 on 10 March 2022
	
	//preventing direct access from url
	if (!defined('SECURE_PAGE'))
    {
        header("Location: ../index.php");
    }
		$db = new mysqli('localhost', 'root' ,'root', 'jedi_encrypted_email');
		if ($db -> connect_error) { 
			die(" not connected!" . $db->connect_error);
		}
	
?>