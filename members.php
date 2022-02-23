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
						<b>Member List</b>
						<span class="">

							<button onclick="window.location='index.php?page=manage_member&form=new'" class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button">
					<i class="fa fa-plus"></i> New</button>
				</span>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered table-condensed table-hover">
							<colgroup>
								<col width="5%">
								<col width="20%">
								<col width="15%">
								<col width="15%">
								<col width="20%">
								<col width="5%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Name</th>
									<th class="">ID No.</th>
									<th class="">Contact</th>
									<th class="text-center">Action</th>
									<th class="">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$mbrTblList = getMemberList();
									$i=1;
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
										 <p><b><?php echo $mbr[1] . " " . $mbr[2] . " " . $mbr[0]; ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo($mbr[9] / 3); ?></b></p>
										 <!--<p><b><?php //echo $mbr[3]; ?></b></p>-->
									</td>
									<td class="">
										 <p><b><?php echo $mbr[4]; ?></b></p>
										 
									</td>
									<td class="text-center">
									<button onclick="window.location='index.php?ln=<?=$mbr[0]?>&fn=<?=$mbr[1]?>&mi=<?=$mbr[2]?>&action=checkin'" class="btn btn-sm btn-outline-primary view_member" type="button" data-id="<?php echo($mbr[1] . " " . $mbr[2] . " " . $mbr[0]) ?>" >Check-In</button>
										<button onclick="window.location='index.php?page=member_activity&form=view&id=<?=$mbr[8]?>'" class="btn btn-sm btn-outline-primary view_member" type="button" data-id="<?php echo($mbr[1] . " " . $mbr[2] . " " . $mbr[0]) ?>" >View</button>
										<button onclick="window.location='index.php?page=manage_member&form=edit&id=<?=$mbr[8]?>'" class="btn btn-sm btn-outline-primary edit_member" type="button" data-id="<?php echo($mbr[1] . " " . $mbr[2] . " " . $mbr[0])?>" >Edit</button>
										<button onclick="window.location='index.php?page=manage_member&form=delete&id=<?=$mbr[8]?>'" class="btn btn-sm btn-outline-primary delete_member" type="button" data-id="<?php echo($mbr[8])?>" >Delete</button>
									</td>
									<td class="text-center">
										<?php if($mbr[7] > strtotime(date('Y-m-d'))): ?>
										<span class="badge badge-success">Active</span>
										<?php else: ?>
										<span class="badge badge-danger">Exprired</span>
										<?php endif; ?>
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
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_member').click(function(){
		uni_modal("<i class='fa fa-plus'></i> New Member","manage_member.php",'mid-large')
	})
	$('.view_member').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Member Details","view_member.php?id="+$(this).attr('data-id'),'large')
		
	})
	$('.edit_member').click(function(){
		uni_modal("<i class='fa fa-edit'></i> Manage Member Details","manage_member.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	

	function delete_member($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_member',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>