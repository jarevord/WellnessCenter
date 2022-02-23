
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		background: url(assets/uploads/<?php echo $_COOKIE['system']['cover_img'] ?>) !important
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=members" class="nav-item nav-members"><span class='icon-field'><i class="fa fa-user-friends"></i></span> Members</a>
				<a href="index.php?page=checkedin_members" class="nav-item nav-registered_members"><span class='icon-field'><i class="fa fa-id-card"></i></span> Checked In Members</a>
				<!--<a href="index.php?page=schedule" class="nav-item nav-schedule"><span class='icon-field'><i class="fa fa-calendar-day"></i></span> Schedule</a>-->
				<?php if(isset($_COOKIE['login_type']) && ($_COOKIE['login_type'] == 1 || $_COOKIE['login_type'] == 2) ): ?>
				<a href="index.php?page=transactions" class="nav-item nav-plans"><span class='icon-field'><i class="fa fa-cash-register"></i></span> Transactions</a>
				<!--<a href="index.php?page=packages" class="nav-item nav-packages"><span class='icon-field'><i class="fa fa-list"></i></span> Packages</a>-->
				<!--<a href="index.php?page=trainer" class="nav-item nav-trainer"><span class='icon-field'><i class="fa fa-user"></i></span> Trainers</a>-->
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				<?php endif; ?>
				
				<?php if(isset($_COOKIE['login_type']) && ($_COOKIE['login_type'] == 1 || $_COOKIE['login_type'] == 1) ): ?>
				<a href="index.php?page=plans" class="nav-item nav-plans"><span class='icon-field'><i class="fa fa-th-list"></i></span> Plans</a>
				
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
