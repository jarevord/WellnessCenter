
<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Checked In Member List</b>
						
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<colgroup>
								<col width="5%">
								<col width="45%">
								<col width="20%">
								<col width="30%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Name</th>
									<th class="">Check-in Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
									$mbrTblList = getCheckinList();
									$i=1;
									date_default_timezone_set("America/Chicago");
									foreach($mbrTblList as $mbr){
										if($mbr[0] != '' && $mbr[0] != 'lName'){

									
								?>
								<tr>
									
									<td class="text-center">
									<?php
									echo $i++;
									?>
									</td>
									
									<td class="">
										 <p><b><?php echo $mbr[0] . " " . $mbr[1] . " " . $mbr[2]; ?></b></p>
										 
									</td>
									<td class="">
										<p><b> <?php echo(date("m-d-Y h:i:sa",$mbr[3])) ?> </b></p>
									</td>
									<td class="text-center">
										<button onclick="window.location='index.php?cit=<?=$mbr[3]?>&ln=<?=$mbr[2]?>&fn=<?=$mbr[0]?>&mi=<?=$mbr[1]?>&action=checkout'" class="btn btn-sm btn-outline-primary view_member" type="button" data-id="<?php echo($mbr[1] . " " . $mbr[2] . " " . $mbr[0]) ?>" >Check-Out</button>
									</td>
									
								</tr>
								<?php }
								} ?>
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
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
