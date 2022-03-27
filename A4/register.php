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
    <!-- Content here -->
    <!-- // Referenced from https://dal.brightspace.com/d2l/le/content/201526/viewContent/2923422/View Accessed on MArch 1 2022 -->
	<div class="container mt-5 col-md-6 col-sm-5">
    <form action="javascript:sendDataToServer()" method="post" class="bg-light">
        <h1 class="text-center"> Registeration form</h1>
       
	    <div class="form-group mt-4 ms-3 me-3">
            <label for="fname">First Name</label>
            <input type="text" class="form-control " id="fname" name="fname" pattern = "^[A-Z].*" placeholder =" Only First letter should be capital" title="Only First letter should be capital"> 
        </div>
		
		<div class="form-group mt-4 ms-3 me-3">
            <label for="fname">Last Name</label>
            <input type="text" class="form-control "  id="lname" name="lname" placeholder ="First letter should be capital" title="Only First letter should be capital" pattern = "^[A-Z].*"  required aria-describedby="emailHelp "
                placeholder="Enter last name">
				

        </div>

        <div class="form-group mt-4 ms-3 me-3">
            <label for="Email1">Email address</label>
            <input type="email"  pattern="^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)?(@dal.ca|@jediacademy.edu|@theforce.org)$" placeholder = "Email domain should be dal.ca or jediacademy.edu or theforce.org " title = "Email domain should be dal.ca or jediacademy.edu or theforce.org "required class="form-control" id="email" name="email" aria-describedby="emailHelp"
               >
        </div>
		<div id="invalidemail"> </div>
        <div class="form-group mt-2 ms-3 me-3">
            <label for="exampleInputPassword1" class="mt-3">Password</label>
            <input type="password" class="form-control " id="password" name="password" placeholder="Password">
        </div>

        <div class="text-center cold-md-6 mt-4 mb-4 pb-4">
			<input type="submit" class="btn-success" value="Submit data" id="btn-submit">       
			<input type="button" class="btn-primary" onclick = "window.location.href = 'index.php';" value="Back to Login" id="btn-submit">    

		 </div>
    </form>
</div>


</main>


<?php getFooter();?>


<script>

// This code contains code re-used from GL5 in this course. This code is used with Prof. Raghav Sampangi's permission. 
// This code is used as a starting point for my solution for A4 
function sendDataToServer(){

// (1) Create the XMLHttpRequest object to send background requests
let x = new XMLHttpRequest()

//gettin the values of form fields
let fname = document.getElementById("fname").value
let lname = document.getElementById("lname").value
let email = document.getElementById("email").value
let password = document.getElementById("password").value

//setting the url 
let url = "./includes/ajax.php"
x.open("POST", url, true)

// (3) Send the request, with any data to the server
let message = "fname=" + fname + "&lname=" + lname +"&email=" + email + "&password=" + password 
x.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
x.send(message)

// (4) Handle the event when the server sends a response
x.onreadystatechange = function() {

	if (this.readyState == 4 && this.status == 200) {
		//printing the response in console
		console.log(this.response);
		$response =this.response;
		//if there will content in the form only then it will go to script.js
		if($response=="error"  && $response != undefined ){
			
			para = document.createElement('p');
			para.innerHTML = 'email domain is incorrect'
			para.style.fontStyle = 'italic';
			para.style.color = 'red';
			document.getElementById('invalidemail').appendChild(para)
		}

		if($response!="error"  && $response != undefined ){
			window.location.href = 'index.php?registered=1';

		}
	}
}

}
	
</script>
</body>

</html>