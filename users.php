<?php 

?>

<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
			<button onclick="window.location='index.php?page=manage_user'" class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Username</th>
					<th class="text-center">Type</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					$usrTblList = getUserList();
					$i = 1;
					 foreach($usrTblList as $usr){

					 if($usr[0] != '' && $usr[0] != 'UserName'){

					 
				 ?>
				 <tr>
				 	<td class="text-center">
				 		<?php echo($i++);  ?>
				 	</td>
				 	<td>
				 		<?php echo($usr[0]); ?>
				 	</td>
				 	
				 	<td>
				 		<?php 
						 if($usr[2] == 1){
							 echo("Admin");
						 }
						 else if($usr[2] == 2){
							 echo("Employee");
						 }
						 else if($usr[2] == 3){
							 echo("Student");
						 }
						 else{
							 echo("Other");
						 } ?>
				 	</td>
				 	
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $usr[0] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $usr[0] ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php }
				} ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>
	$('table').dataTable();
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})


</script>