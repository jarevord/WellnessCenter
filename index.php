<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gym Management System</title>
<?php
date_default_timezone_set('America/Chicago');
error_reporting(E_ALL ^ E_WARNING); 
include('./functions.php');

if(!isset($_COOKIE["username"]) || $_COOKIE["username"] == "") {
    header('location:login.php');
} 
if($_GET['action'] == "logout"){
    setcookie("username", "", time() - 3600 );
    header('location:login.php');
} 

if($_GET['action'] == 'checkin'){
  $checkinarr = array($_GET['fn'], $_GET['mi'], $_GET['ln']);
  $d=strtotime("Now");
  array_push($checkinarr, $d);
  mbrCheckin($checkinarr);
  header('location:index.php?page=members');
}

if($_GET['action'] == 'checkout'){
  $checkoutarr = array($_GET['fn'], $_GET['mi'], $_GET['ln'], $_GET['cit']);
  $d=strtotime("Now");
  array_push($checkoutarr, $d);
  mbrCheckout($checkoutarr);
  header('location:index.php?page=checkedin_members');
}

if($_POST['action'] == 'newtrans'){
  $newtransarr = array($_POST['type'], $_POST['amount'],$_POST['patron']);
  newTransaction($newtransarr);
  header('location:index.php?page=receipts&patron=' .$_POST['patron'].'&type='.$_POST['type'].'&amount='.$_POST['amount']);
  
}

if($_POST['action'] == 'newuser'){
  $newuserarr = array($_POST['username'], $_POST['password'], $_POST['type']);
  newUser($newuserarr);
  header('location:index.php?page=users');
}

if($_POST['action'] == 'edituser'){
  $edituserarr = array($_POST['username'], $_POST['password'], $_POST['type']);
  editUser($edituserarr);
  header('location:index.php?page=users');

}

if($_POST['action'] == 'newmember'){
  //$newmemberarr = array($_POST['lastname'],$_POST['firstname'],$_POST['middlename'],$_POST['email'],$_POST['contact'],$_POST['gender'],str_replace("\n", " ", str_replace("\r", " ", $_POST['address'])), $_POST['incplan']);
  $newmemberarr = array($_POST['lastname'],$_POST['firstname'],$_POST['middlename'],$_POST['email'],$_POST['contact'],$_POST['gender'],str_replace("\n", " ", str_replace("\r", " ", $_POST['address'])), "", "");
  newMember($newmemberarr);
  header('location:index.php?page=members');
}

if($_POST['action'] == 'editmember'){
  $editmemberarr = array($_POST['lastname'],$_POST['firstname'],$_POST['middlename'],$_POST['email'],$_POST['contact'],$_POST['gender'],str_replace("\n", " ", str_replace("\r", " ", $_POST['address'])), $_POST['goodUntil'], $_POST['mbrID'], (3 * $_POST['800ID']));
  editMember($editmemberarr);
  header('location:index.php?page=members');
}

if($_POST['action'] == 'deletemember'){
  deleteMember($_POST['mbrID']);
  header('location:index.php?page=members');
}

if($_POST['action'] == 'updtrans'){
   
  $newGood = strtotime("+" . $_POST['duration'] . " days");
  $mbrtoUpd = getMember($_POST['id']);
  $mbrtoUpd[7] = $newGood;
  editMember($mbrtoUpd);
  $newtransarr = array($_POST['type'], $_POST['amount'],$_POST['patron']);
  newTransaction($newtransarr);
  
  header('location:index.php?page=members');
}

if($_POST['action'] == 'newplan'){
  $newplanarr = array($_POST['plan'], $_POST['duration'], $_POST['amount']);
  newPlan($newplanarr);
  header('location:index.php?page=plans');
}
include('./header.php');

?>
</head>
<style>
	body{
        background: #80808045;
  }
  .modal-dialog.large {
    width: 80% !important;
    max-width: unset;
  }
  .modal-dialog.mid-large {
    width: 50% !important;
    max-width: unset;
  }
  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    /*right: -4.5em;*/
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
}
#viewer_modal .modal-dialog {
        width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
}
  #viewer_modal .modal-content {
       background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #viewer_modal img,#viewer_modal video{
    max-height: calc(100%);
    max-width: calc(100%);
  }

</style>

<body>
	<?php include 'topbar.php' ?>
	<?php include 'navbar.php' ?>
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <main id="view-panel" >
      <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
  	<?php include $page.'.php' ?>
  	

  </main>

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
</body>
<script>
	 window.start_load = function(){
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
  }
 window.viewer_modal = function($src = ''){
    start_load()
    var t = $src.split('.')
    t = t[1]
    if(t =='mp4'){
      var view = $("<video src='"+$src+"' controls autoplay></video>")
    }else{
      var view = $("<img src='"+$src+"' />")
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view)
    $('#viewer_modal').modal({
            show:true,
            backdrop:'static',
            keyboard:false,
            focus:true
          })
          end_load()  

}
  window.uni_modal = function($title = '' , $url='',$size=""){
    start_load()
    $.ajax({
        url:$url,
        error:err=>{
            console.log()
            alert("An error occured")
        },
        success:function(resp){
            if(resp){
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                if($size != ''){
                    $('#uni_modal .modal-dialog').addClass($size)
                }else{
                    $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                }
                $('#uni_modal').modal({
                  show:true,
                  backdrop:'static',
                  keyboard:false,
                  focus:true
                })
                end_load()
            }
        }
    })
}
window._conf = function($msg='',$func='',$params = []){
     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
     $('#confirm_modal .modal-body').html($msg)
     $('#confirm_modal').modal('show')
  }
   window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

    if($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({delay:3000}).toast('show');
  }
  $(document).ready(function(){
    $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
  })
  $('.datetimepicker').datetimepicker({
      format:'Y/m/d H:i',
      startDate: '+3d'
  })
  $('.select2').select2({
    placeholder:"Please select here",
    width: "100%"
  })
</script>	
</html>