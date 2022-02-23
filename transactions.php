
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<?php
				if($_POST['action'] == 'mbrUpdatePlan'){
					$mbrupdid = $_POST['id'];
					$mbrupdplan = $_POST['updatedPlan'];

					$workingPL = getPlanList();
					$planCost = 0;
					$planDuration = 1;
					foreach($workingPL as $pl){
						if($pl[0] == $mbrupdplan){
							$planCost = $pl[2];
							$planDuration = $pl[1];
						}
					}

				$patron = getMember($mbrupdid);
				
					?>
				<div class="col-md-4">
			<form action="./" id="manage-transaction" method="POST">
					
				<div class="card">
					<div class="card-header">
						    Transaction Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="action" value="updtrans">
							<input type="hidden" name='duration' value="<?php echo($planDuration);?>">
							<input type="hidden" name="id" value="<?php echo($_POST['id']) ?>">

							<div class="form-group">
								<label class="control-label">Patron</label>
								<input type="text" class="form-control text-right" name="patron" value="<?php echo($patron[1] . " " . $patron[2] . " " . $patron[0] );?>">
							</div>
							<div class="form-group">
								<label class="control-label">Type (Cash / Check)</label>
								<input type="text" class="form-control text-right" name="type" >
							</div>
							<div class="form-group">
								<label class="control-label">Plan</label></br>
								<label class="control-label"><?php echo($mbrupdplan)?></label>
							</div>
							<div class="form-group">
								<label class="control-label">Amount</label>
								<input type="number" class="form-control text-right" step="any" name="amount" value="<?php echo($planCost)?>">
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
					<?php
				}
				else{
			?>
			<div class="col-md-4">
			<form action="./" id="manage-transaction" method="POST">
				<div class="card">
					<div class="card-header">
						    Transaction Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="action" value="newtrans">
							<div class="form-group">
								<label class="control-label">Patron</label>
								<input type="text" class="form-control text-right" name="patron" >
							</div>
							<div class="form-group">
								<label class="control-label">Type (Cash / Check)</label>
								<input type="text" class="form-control text-right" name="type" >
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
						<b>Transaction History</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-condensed table-hover">
							<colgroup>
								<col width="5%">
								<col width="55%">
								<col width="20%">
								<col width="20%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Transaction</th>
									<th class="text-center">Amount</th>
									<th class="text-center">Date</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$tranTblList = getTransList();
								$i = 1;
								foreach($tranTblList as $xact){
									if($xact[0] != '' && $xact[0] != 'Name'){	
								?>
								<tr>
									
									<td class="text-center">
									<?php
									echo $i++;
									?>
									</td>
									
									<td class="">
										 <p><b><?php echo($xact[0] . " - " . $xact[2]) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo $xact[1]; ?></b></p>
									</td>
									<td class="">
										 <p><b><?php echo(date("m/d/Y",$xact[3])); ?></b></p>
										 
									</td>
									
								</tr>
								<?php }
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php } ?><!-- Table Panel -->
		</div>
	</div>	

</div>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
</script>
<style>
	
	td{
		vertical-align: middle !important;
	}
</style>
