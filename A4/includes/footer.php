<?php 
// This code contains code re-used from Assignmenet 3 in this course. This code is used with Prof. Raghav Sampangi's permission. 
// This code is used as a starting point for my solution for A4
//taken from https://www.sitepoint.com/community/t/prevent-direct-access-to-php-files/320889/3 on 10 march 2022 
    	
    //preventing direct access from url
		if (!defined('SECURE_PAGE'))
		{
            header("Location: ../index.php");
		}
?>
<!-- Footer desing referenced from https://mdbootstrap.com/docs/b4/jquery/navigation/footer/ on 10 march 2022 -->
<!-- Footer -->
<footer class="page-footer  bg-primary col-md-12 text-white font-small  pt-4">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">
        <div class="row">
            <div class="col-md-6 mt-md-0 mt-3">

                <!-- Content -->

                <p>&copy; 2022, Dal Comp Sci</p>
                <!-- The following text was given by Raghav sampangi in teh assignment details -->
                <p>MailYoda: Simple and secure, it is; a way to securely send messages.
                </p>
            </div>

            <div class="col-md-3 mb-md-0 mb-3">
                <ul class="list-unstyled ">
                    <li>
                        <a class="text-white me-1" href="#!">Privacy Policy</a> 
                        <a class="text-white me-1" href="#!">Terms of Use</a>
                        <a class="text-white" href="#!">Contact Us</a>


                    </li>

                </ul>

            </div>
        </div>
        </div>

</footer>