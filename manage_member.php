
<div class="container-fluid">
	<form action="./" id="manage-member" method="POST">
	<?php 
		if($_GET['form'] == 'new'){
			?>
		<input type="hidden" name="action" id="action" class="action" value="newmember">
		<div id="msg"></div>
		<div class="row form-group">
			<div class="col-md-4">
						
					</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Last Name</label>
				<input type="text" name="lastname" class="form-control"  required>
			</div>
			<div class="col-md-4">
				<label class="control-label">First Name</label>
				<input type="text" name="firstname" class="form-control" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Middle Initial</label>
				<input type="text" name="middlename" class="form-control" >
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Email</label>
				<input type="email" name="email" class="form-control" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Contact #</label>
				<input type="text" name="contact" class="form-control" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Gender</label>
				<select name="gender" required="" class="custom-select" id="">
					<option>Male</option>
					<option>Female</option>
				</select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">800 #</label>
				<input type="text" name="800ID" class="form-control" required>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Address</label>
				<textarea name="address" class="form-control"></textarea>
			</div>
		</div>
		
		<!--<div class="col-md-4">
				<label class="control-label">Plan</label>
				<select name="incplan" required="" class="custom-select" id="">
					<?php
					//$planList = getPlanList();
					//foreach($planList as $pl){
					//	if($pl[0] != 'plan'){
					//		?>
						<option> <?=$pl[0];?> </option> <?php
					//	}
					//}
					?>
				</select>
				<br>
			</div> -->
		<?php }
		elseif($_GET['form'] == 'edit'){
			$memberInfo = getMember($_GET['id']);
			?>
			<input type="hidden" name="action" id="action" class="action" value="editmember">
			<input type="hidden" name="fullname" id="fullname" class="fullname" value="<?php echo($_GET['fn'].'_'.$_GET['mi'].'_'.$_GET['ln'])?>">
			<input type="hidden" name="goodUntil" id="goodUntil" class="goodUntil" value="<?php echo($memberInfo[7]) ?>">
			<input type="hidden" name="mbrID" id="mbrID" class="mbrID" value="<?php echo($memberInfo[8]) ?>">

		<div id="msg"></div>
		<div class="row form-group">
			<div class="col-md-4">
						
					</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Last Name</label>
				<input type="text" name="lastname" class="form-control"  value="<?php echo($memberInfo[0]) ?>" required>
			</div>
			<div class="col-md-4">
				<label class="control-label">First Name</label>
				<input type="text" name="firstname" class="form-control" value="<?php echo($memberInfo[1]) ?>"required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Middle Initial</label>
				<input type="text" name="middlename" class="form-control" value="<?php echo($memberInfo[2]) ?>">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Email</label>
				<input type="email" name="email" class="form-control" value="<?php echo($memberInfo[3]) ?>"required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Contact #</label>
				<input type="text" name="contact" class="form-control" value="<?php echo($memberInfo[4]) ?>"required>
			</div>
			<div class="col-md-4">
				<label class="control-label">Gender</label>
				<select name="gender" required="" class="custom-select" id="">
					<?php if($memberInfo[5] == "Male"){ ?>
					<option selected>Male</option>
					<option>Female</option>
					<?php }
					else{ ?>
					<option>Male</option>
					<option selected>Female</option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">800 #</label>
				<input type="text" name="800ID" class="form-control" value="<?php echo($memberInfo[9] / 3) ?>" required>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Address</label>
				<textarea name="address" class="form-control"><?php echo($memberInfo[6]) ?></textarea>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Account Valid Until</label><br>
				<label class="control-label"><?php echo(date("m/d/Y",$memberInfo[7])); ?></label>
			</div>
		</div> 
		<?php
		}
		elseif($_GET['form'] == 'delete'){
			$memberInfo = getMember($_GET['id']);
			?>
			<input type="hidden" name="action" id="action" class="action" value="deletemember">
			<input type="hidden" name="mbrID" id="mbrID" class="mbrID" value="<?php echo($memberInfo[8]) ?>">

		<div id="msg"></div>
		<div class="row form-group">
			<div class="col-md-4">
						
					</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Last Name:</label>
				<label><?php echo($memberInfo[0]) ?></label>
			</div>
			<div class="col-md-4">
				<label class="control-label">First Name: </label>
				<label><?php echo($memberInfo[1]) ?></label>
			</div>
			<div class="col-md-4">
				<label class="control-label">Middle Initial: </label>
				<label><?php echo($memberInfo[2]) ?></label>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<label class="control-label">Email:</label>
				<label><?php echo($memberInfo[3]) ?></label>
			</div>
			<div class="col-md-4">
				<label class="control-label">Contact #:</label>
				<label><?php echo($memberInfo[4]) ?></label>
			</div>
			<div class="col-md-4">
				<label class="control-label">Gender:</label>
				
					<?php if($memberInfo[5] == "Male"){ ?>
					<label> Male</label>
					
					<?php }
					else{ ?>
					
					<label> Female</label>
					<?php } ?>
				
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Address: </label>
				<label><?php echo($memberInfo[6]) ?></label>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Account Valid Until</label><br>
				<label class="control-label"><?php echo(date("m/d/Y",$memberInfo[7])); ?></label>
			</div>
		</div> 
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Delete this Member Information?</label><br>
				
			</div>
		</div> 
		<?php
		}
		else{
			echo("this is something else");
		}
			?>
			<br>
		<button value="Submit" type="Submit">Submit</button>
	</form>
	<hr>
	</br>
<?php	if($_GET['form'] == 'edit') {?>
	<form action="./index.php?page=transactions&form=mbrUpdate" id="manage-member2" method="POST">
	<div class="row form-group">
		<div class="col-md-4">
				<label class="control-label">Update Membership Plan</label>
		</div>
	</div>
	
	<div class="col-md-4">
				<input type="hidden" name="action" value="mbrUpdatePlan">
				<input type="hidden" name="id" value="<?=$_GET['id']?>">
				<label class="control-label">Plan</label>
				<select name="updatedPlan" required="" class="custom-select" id="updatedPlan">
					<?php
					$planList = getPlanList();
					foreach($planList as $pl){
						if($pl[0] != 'plan'){
							?>
						<option> <?=$pl[0];?> </option> <?php
						}
					}
					?>
				</select>
				<br>
	</div>
				</br>
	<button value="Submit" type="Submit">Submit</button>
	</form>
	<?php }	?>
</div>

