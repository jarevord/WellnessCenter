<!DOCTYPE html>
<html lang="en">

<?php
	$userList = [];
	$handel = fopen("csv/users.csv", "r");

	while(! feof($handel))
	{
	$dataline = fgetcsv($handel);
	array_push($userList, $dataline);
	}

	fclose($handel);
?>
<script>
	var ut;
  function myFunction(){
    var un = document.getElementById('username').value;
    var pw = document.getElementById('password').value;
    var uc = userCheck(un, pw);
    if(uc == 0){
      document.getElementById('buttonTest').innerHTML = "Invalid Username. Check and try again.";
    }
	else if(uc ==1){
		document.getElementById('buttonTest').innerHTML = "Incorrect Username or Password Combination.";
	}
    else{
		setCookie("username", un, 3);
		setCookie("password", pw, 3);
		setCookie("login_type", ut, 3);
		window.location.href = "./";
		//var cookietest = getCookie("username") + " " + getCookie("password") + " " + getCookie("login_type");
		//document.getElementById('buttonTest').innerHTML = "<?= $userList[1][1]?>";
		//document.getElementById('buttonTest').innerHTML = cookietest.toString();
    }
  }

  function userCheck(user, pass){
	  if(document.getElementById('username').value == "")
	  {
		  return 0;
	  }
	  else{
		  var passedArray = <?php echo json_encode($userList); ?>;
		  for(i=0; i<passedArray.length; i++){
			//document.write(passedArray[i][0]);	
			if(user == passedArray[i][0]){
				if(pass == passedArray[i][1])
				{
					ut = passedArray[i][2];
					return 2;
				}
				return 1;
			}
		  }
		  return 0;
	  }
	 
  }

  function setCookie(cname, cvalue, exdays){
	  var d = new Date();
	  d.setTime(d.getTime() + (exdays*24*60*60*1000));
	  let expires = "expries="+ d.toUTCString();
	  document.cookie =  cname + "=" + cvalue + ";" + expires + ";path=/";
  }

 function getCookie(cname){
	 let name = cname + "=";
	 let decodedCookie = decodeURIComponent(document.cookie);
	 let ca = decodedCookie.split(';');
	 for(let i=0; i<ca.length; i++){
		 let c = ca[i];
		 while (c.charAt(0) == ' '){
			 c = c.substring(1);
		 }
		 if (c.indexOf(name) == 0){
			 return c.substring(name.length, c.length);
		 }
	 }
	 return "";
 }

 function deleteCookie(cname){
	 var dcookie = getCookie(cname);
	 if(dcookie != ""){
		 setCookie(cname, "", -1);
	 }
 }
</script>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SCCC Wellness Center</title>
 	

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: calc(100%);
		background:#59b6ec61;
		display: flex;
		align-items: center;
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	#login-right .card{
		margin: auto;
		z-index: 1
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
    z-index: 10;
}
div#login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100%);
    height: calc(100%);
    background: #000000e0;
}

</style>

<body onload="deleteCookie('username')";>


  <main id="main" class=" bg-dark">
  		<div id="login-left">
  		</div>

  		<div id="login-right">
  			<div class="card col-md-8">
  				<div class="card-body">
  						
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label" style="color:white;">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label"style="color:white;">Password</label>
  							<input type="text" id="password" name="password" class="form-control">
  						</div>
  					</form>
            <center><button onclick="myFunction()" class="btn-sm btn-block btn-wave col-md-4 btn-primary" >Login</button></center>
					  
					  <div style="color:white;" id='buttonTest'>
					 
					  </div>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
 

</body>

</html>