
<div class="container-fluid">
	<div id="msg"></div>
	<?php
	if($_GET['form'] == 'edit'){
		$euName = $_GET['un'];
		$euInfo = getUser($euName);
	?>
	<form action="./" id="manage-user" method="POST">	
		<input type="hidden" name="action" id="action" class="action" value="edituser">
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" value="<?=$euInfo[0]?>" required  autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			
		</div>
		
		<div class="form-group">
			<label for="type">User Type</label>
			<select name="type" id="type" class="custom-select">
				<option value="3">Student<option>
				<option value="2">Staff</option>
				<option value="1">Admin</option>
			</select>
		</div>
		
		<button value="Submit" type="Submit">Submit</button>
		

	</form>

	<?php
	}
	
	else{
	?>
	<form action="./" id="manage-user" method="POST">	
		<input type="hidden" name="action" id="action" class="action" value="newuser">
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" required  autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			
		</div>
		
		<div class="form-group">
			<label for="type">User Type</label>
			<select name="type" id="type" class="custom-select">
				<option value="3">Student<option>
				<option value="2">Staff</option>
				<option value="1">Admin</option>
			</select>
		</div>
		
		<button value="Submit" type="Submit">Submit</button>
		

	</form>
	<?php } ?>
</div>
