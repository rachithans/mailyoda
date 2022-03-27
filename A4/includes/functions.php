<?php 
//taken from https://www.sitepoint.com/community/t/prevent-direct-access-to-php-files/320889/3
// This code contains code re-used from Assignmenet 3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
// This code is used as a starting point for my solution for A4
//preventing direct access from url
    if (!defined('SECURE_PAGE'))
    {
        die('<h1>Direct File Access Prohibited</h1>');
    }
    function getHeader($type){
        $location = $type;

        // this function get header from header.php
        return include 'header.php';
    }
    function getFooter(){
        // this function get footer from footer.php
        return include 'footer.php';
    }

    function getLogin(){
        return include 'Login.php';
    }

    // (1) Sanitize form data input
	function sanitizeData($inputData) {
		$returnValue = trim($inputData);
		$returnValue = htmlspecialchars($returnValue);
		$returnValue = stripslashes($returnValue);

		return $returnValue;
	}
 
    function getInbox(){

        // this function get footer from footer.php
        return include 'inbox.php';
    }
    function getCompose(){

        // this function get footer from footer.php
        return include 'compose.php';
    }
    function getSentandDraft(){

        // this function get footer from footer.php
        return include 'sentanddraft.php';
    }
  
?>