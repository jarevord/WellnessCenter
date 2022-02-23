
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="./" id="manage-plan" method="POST">
				<div class="card">
					<div class="card-header">
						    Plan Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="action" value="newplan">
							<div class="form-group">
								<label class="control-label">Plan</label>
								<input type="text" class="form-control text-right" name="plan" >
							</div>
							<div class="form-group">
								<label class="control-label">Duration (days)</label>
								<input type="text" class="form-control text-right" name="duration" >
							</div>
							<div class="form-group">
								<label class="control-label">Amount</label>
								<input type="number" class="form-control text-right" step="any" name="amount">
							</div>
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>Plan List</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<colgroup>
								<col width="5%">
								<col width="55%">
								<col width="20%">
								<col width="20%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Plan</th>
									<th class="text-center">Duration</th>
									<th class="text-center">Pricing</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$planTblList = getPlanList();
								$i = 1;
								 foreach($planTblList as $pln){
			
								 if($pln[0] != '' && $pln[0] != 'plan'){

								?>
								<tr>
								<td class="text-center">
				 					<?php echo($i++);  ?>
				 				</td>
				 				<td>
				 					<?php echo($pln[0]); ?>
				 				</td>
								 <td>
				 					<?php echo($pln[1] . " day(s)."); ?>
				 				</td>
								 <td>
				 					<?php echo($pln[2]); ?>
				 				</td>
								 </tr>
								<?php }
								 }
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
</style>
