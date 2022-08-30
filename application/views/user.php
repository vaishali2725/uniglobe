<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js" data-ng-app="crmApp"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js" data-ng-app="crmApp"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" data-ng-app="crmUserApp">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <title data-ng-bind="'CRM | ' + $state.current.data.pageTitle"></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link rel="icon" href="favicon.ico" />
		 <link href="<?php echo base_url() ?>css/custum.css" rel="stylesheet" type="text/css" />
         <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/global/css/components.min.css" id="style_components" rel="stylesheet" type="text/css" />
       
		<link href="<?php echo base_url() ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
		<!--start calender styles-->
         <link rel="stylesheet" href="<?php echo base_url()?>assets/ui-calendar-master/fullcalendar/fullcalendar.min.css">
	     <link rel="stylesheet" href="<?php echo base_url() ?>assets/ui-calendar-master/demo/calendarDemo.css" />

		<!--end calender styles-->
        <!-- BEGIN DYMANICLY LOADED CSS FILES(all plugin and page related styles must be loaded between GLOBAL and THEME css files ) -->
        <link id="ng_load_plugins_before" />
        <!-- END DYMANICLY LOADED CSS FILES -->
        <!-- BEGIN THEME STYLES -->
       
    
	   <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
        <link href="<?php echo base_url() ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url() ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" /> 
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
		
		
		
		</head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
    <!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
    <!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
    <!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
    <!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
    <!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
    <!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
    <!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
    
	
    <body >
	
	
	
	
        <!-- BEGIN PAGE SPINNER -->
        <div ng-spinner-bar class="page-spinner-bar">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <!-- END PAGE SPINNER -->
        <!-- BEGIN HEADER -->
        <div data-ng-include="'template/user/header.html'" data-ng-controller="HeaderController" class="page-header navbar navbar-fixed-top"> </div>
        <!-- END HEADER -->
        <div class="clearfix"> </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div data-ng-include="'template/user/sidebar.html'" data-ng-controller="SidebarController" class="page-sidebar-wrapper"> </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN STYLE CUSTOMIZER(optional) -->
                   <!-- <div data-ng-include="'template/theme-panel.html'" data-ng-controller="ThemePanelController" class="theme-panel hidden-xs hidden-sm"> </div>-->
                    <!-- END STYLE CUSTOMIZER -->
                    <!-- BEGIN ACTUAL CONTENT -->
                    <div ui-view class="fade-in-up"> </div>
                    <!-- END ACTUAL CONTENT -->
                </div>
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
           <!-- <div data-ng-include="'template/quick-sidebar.html'" data-ng-controller="QuickSidebarController" class="page-quick-sidebar-wrapper"></div>-->
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div data-ng-include="'template/user/footer.html'" data-ng-controller="FooterController" class="page-footer"> </div>
        <!-- END FOOTER -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE JQUERY PLUGINS -->
        <!--[if lt IE 9]>
	<script src="../assets/global/plugins/respond.min.js"></script>
	<script src="../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
	
	

      <script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
	  <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

	  <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script> 
		<!-- END CORE JQUERY PLUGINS -->
        <!-- BEGIN CORE ANGULARJS PLUGINS -->
	    <script src="<?php echo base_url() ?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
       
        <script src="<?php echo base_url() ?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

		
		<script src="<?php echo base_url() ?>assets/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/angularjs/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/angularjs/angular-touch.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/angularjs/plugins/angular-ui-router.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/angularjs/plugins/ocLazyLoad.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.5.5/angular-messages.min.js" type="text/javascript"></script>-->
        <!-- END CORE ANGULARJS PLUGINS -->
		
		<script src="<?php echo base_url() ?>assets/ng-idle-develop/angular-idle.js" type="text/javascript"></script>

		<!--start calender js-->
		  
          <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.js"></script>
          <script src="<?php echo base_url()?>assets/ui-calendar-master/fullcalendar/fullcalendar.min.js"></script>
         <script src="<?php echo base_url()?>assets/ui-calendar-master/fullcalendar/gcal.js"></script>
         <script src="<?php echo base_url()?>assets/ui-calendar-master/src/calendar.js"></script>
          <script src="<?php echo base_url()?>assets/ui-calendar-master/demo/calendarDemo.js"></script>
		<!--end calendar js-->
 <script type="text/javascript" src="https://rawgit.com/sagiegurari/simple-web-notification/master/web-notification.js"></script>
        <script type="text/javascript" src="https://rawgit.com/sagiegurari/angular-web-notification/master/angular-web-notification.js"></script>
        <!-- BEGIN APP LEVEL ANGULARJS SCRIPTS -->
        <script src="<?php echo base_url() ?>js/user/user.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>js/user/directives.js" type="text/javascript"></script>
		
        <!-- END APP LEVEL ANGULARJS SCRIPTS -->
        <!-- BEGIN APP LEVEL JQUERY SCRIPTS -->
		
        <script src="<?php echo base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url() ?>assets/apps/scripts/calendar.js" type="text/javascript"></script>
		<script src="<?php echo base_url() ?>assets/apps/scripts/calendar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <!-- END APP LEVEL JQUERY SCRIPTS -->
        

	<link rel="stylesheet" href="css/abc.css">

<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>

 <link rel="stylesheet" href="css/abc.css">
<!--chat box-->
<div id="loading_informative123">
		<!--<div class="img-ldr">
		
		<div class="loading"></div>
		</div>-->
		<div class="ldr-1">
		<ul class="progress1">

  <!--  Item  -->
  <li data-name="" data-percent=""> <svg viewBox="-10 -10 220 220">
    <g fill="#fff" stroke-width="14" transform="translate(100,100)">
      <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="url(#cl1)"/>
      <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="url(#cl2)"/>
      <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="url(#cl3)"/>
      <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="url(#cl4)"/>
      <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="url(#cl5)"/>
      <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="url(#cl6)"/>
    </g>
    </svg> <svg viewBox="-10 -10 220 220">
    <path d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="629"></path>
    </svg> </li>
</ul>
</div>
	</div>
	<style>
	#loading_informative123{
		display:none;
	}
	</style>
   
		

<div class="chat-wind">
<div id="live-chat" class="live-chat-main">
		<header class="clearfix">
			<a href="#" class="chat-close">x</a>
			<h4 id="uname"></h4>
		</header> 
		<div class="chat" id="chat0">
			<div class="chat-history" id="chat">
				<div class="stream" id="cstream">
                </div>
			</div> <!-- end chat-history -->

			<!-- <p class="chat-feedback">Your partner is typing…</p> -->

			<form method="post" id="msenger" action="#">
			<textarea name="msg" id="msg-min"></textarea>
					<input type="hidden" name="mid" value="<?php echo $this->session->userdata('id'); ?>" id="mid">
                    <input type="hidden" name="fid" value="<?php  echo $this->session->userdata('friend_id');?>" id="fid">
            
			</form>

		</div> <!-- end chat -->

	</div> <!-- end live-chat -->
	
	
<!--live chat 2 -->
<!-- end live-chat -->
	</div>

<!--end -- >

<!--chat list-->
<div id="live-chat-list">
				<?php
		   $arrto=array();
				$arrfrom=array();
		
	    $this->db->select('count(userid) as cnt');
		$this->db->from('user');
		$this->db->where('chat_status=1');
		$this->db->where('role=','admin');
		$query=$this->db->get();
		$check=$query->result_array();
		$ct=$check[0]['cnt'];
		
		  
		?>
		<header class="clearfix">

			<h5><i class="fa fa-users"></i> Chat (<span id="cht_cnt"><?php echo $ct; ?></span>)</h5>
             <div class="dropdown online-usr-ico">
			  <?php
			  $this->db->select('*');
			  $this->db->from('user');
			  $this->db->where('userid=',$this->session->userdata('id'));
			  $query=$this->db->get();
		      $chat_status=$query->result_array();
			  if($chat_status[0]['chat_status']==1){
				  $cls="fa-check-circle-o";
			  }
			  if($chat_status[0]['chat_status']==2){
				  $cls="fa-clock-o";
			  }
			  if($chat_status[0]['chat_status']==3){
				  $cls="fa-minus-circle";
			  }
			  if($chat_status[0]['chat_status']==0){
				  $cls="fa-circle-thin";
			  }
			  ?>
				     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa <?php 	echo $cls; ?> mul-ico" id="online-ic" aria-hidden="true"></i>
							<i class="fa fa-sort-desc" aria-hidden="true"></i>
						
					 </a> 
						<ul class="dropdown-menu" id="status_menu">
							<li>
								<a href="#" onclick="showstatus(1)"><i class="fa fa-check-circle-o" aria-hidden="true" ></i> <span class="">Online</span></a>
							</li>						
							<li>
								<a href="#" onclick="showstatus(0)"><i class="fa fa-circle-thin" aria-hidden="true" ></i> <span class="">Offline</span></a>
							</li>	
							<li>
								<a href="#" onclick="showstatus(2)"><i class="fa fa-clock-o" aria-hidden="true" ></i> <span class="">Away</span></a>
							</li>
							<li>
								<a href="#" onclick="showstatus(3)"><i class="fa fa-minus-circle" aria-hidden="true" ></i> <span class="">Busy</span></a>
							</li>							
						</ul>
				</div>
		</header>

		<div class="chat-block">
		
			<ul class="chat-list">
			
				 <?php
		   $arrto=array();
				$arrfrom=array();
		
	    $this->db->select('*');
		$this->db->from('user');
		$ids=$this->session->userdata('id');
		$this->db->where('userid !=', $ids);
		$this->db->where('role=', 'admin');
		
		$query=$this->db->get();
		$check=$query->result_array();
		$myid=$this->session->userdata('id');
		 foreach($check as $row){
			 $fid=$row['userid'];
			 
			 
			//echo  $img=$row['profilePicture'];
			  if(count($check)>0){
				   
				 if($row['chat_status']==1){
					 $clsnew="fa-check-circle-o";
				 }
				 
				 if($row['chat_status']==2){
					 $clsnew="fa-clock-o";
				 }
				 if($row['chat_status']==3){
					 $clsnew="fa-minus-circle";
				 }
				 if($row['chat_status']==0){
					 $clsnew="fa-circle-thin";
				 }
				 
			?> 
				<li class="chat-user clearfix" onclick="getchatnew(<?php echo $myid;?>,<?php echo $fid;?>)">
					<a href="#" >
				        <?php if(!empty($row['profilePicture']))
						{
					?>
						<!--<img src="<?php echo base_url(); ?>/upload/profile_pics/<?php echo $row['profilePicture']; ?>" alt="" width="32" height="32" title="<?php echo $row['firstName']." ".$row['lastName']?>"/>-->
						
					<?php 
			}else
			{ ?>
				<!--<img src="<?php echo base_url();?>upload/user-icon.png" width="32" height="32" title="">-->
		<?php	} ?>
						<div class="chat-message-content clearfix">
                         
							<h5 class="chat-usr-name" title=""><?php echo $name=$row['firstName']." ".$row['lastName'];
							?></h5>
							
							<i class="fa <?php echo $clsnew; ?>" id="" aria-hidden="true"></i>
						</div>
					</a>

				</li>
		 <?php  }}
		?>
			
			   <!-- end user -->
									
			</ul> <!-- end chat-history -->

          <input type="text" id="srctxt" placeholder="Search user here"/>
		</div>
</div>
	 <!-- end live-chat -->



<script type="text/javascript">
(function() {
	
	$('.chat-block').slideToggle(300, 'swing');
	$('#live-chat-list header').on('click', function() {
		$('.chat-block').slideToggle(300, 'swing');
		$('.chat-message-counter').fadeToggle(300, 'swing');
	});
})();

function getchatnew(myid,fid){

	if($("#live-chat").is(":visible") && !$("#live-chat2").is(":visible")){
		var str='1';
	}else
	if($("#live-chat2").is(":visible") && $("#live-chat").is(":visible")){
		var str='2';
	}else{
		var str='0';
	}
	
   $.ajax({
	    
	     type:"post",
		 url:"<?php echo base_url(); ?>Report_Controller/getusername",
          
		 data:{id:fid,myid:myid,str:str},
		 success:function(msg){
			
			 rsp=msg.split('+');
			 
			if($("#live-chat").is(":visible") && !$("#live-chat2").is(":visible")){
				$('#cstream1').html("");
			 if($("#fid").val()!=fid){
				$("#mid1").val(myid);
                $("#fid1").val(fid); 
				$("#uname1").html(rsp[1]);
			
				if(rsp[0]!=""){
				$('#cstream1').append(rsp[0]);
				}
				$('#msenger1 textarea').removeAttr('readonly');
			    $('#live-chat2').show();
				
				if($("#live-chat").is(":visible")){
			       $("#live-chat2").css('right','470px');
		        }
				if(!$("#live-chat").is(":visible")){
			       $("#live-chat2").css('right','215px');
		        }
		        if($("#live-chat").is(":visible") && $("#live-chat3").is(":visible")){
					$("#live-chat3").css('right','725px');
				}
		        if(!$("#live-chat").is(":visible") && $("#live-chat3").is(":visible")){
					$("#live-chat3").css('right','470px');
				}
				/*var curcnt=$('#cht_cnt').html();
				$('#cht_cnt').html(parseInt(curcnt)+1);*/
				$('.chat-history').animate({ scrollTop: $(document).height() }, 'fast');
			 }
			}else
			if($("#live-chat2").is(":visible") && $("#live-chat").is(":visible")){
			  if($("#fid").val()!=fid && $("#fid1").val()!=fid){
				  $('#cstream2').html("");
				$("#mid2").val(myid);
                $("#fid2").val(fid); 
				$("#uname2").html(rsp[1]);
				if(rsp[0]!=""){
				$('#cstream2').append(rsp[0]);
				}
				$('#msenger2 textarea').removeAttr('readonly');
				$('#live-chat3').show();
				if($("#live-chat").is(":visible") && $("#live-chat2").is(":visible")){
					$("#live-chat3").css('right','725px');
				}
				if(!$("#live-chat").is(":visible") && $("#live-chat2").is(":visible")){
					$("#live-chat3").css('right','470px');
				}
				if($("#live-chat").is(":visible") && !$("#live-chat2").is(":visible")){
					$("#live-chat3").css('right','470px');
				}
				if(!$("#live-chat").is(":visible") && !$("#live-chat2").is(":visible")){
					$("#live-chat3").css('right','215px');
				}
				/*var curcnt=$('#cht_cnt').html();
				$('#cht_cnt').html(parseInt(curcnt)+1);*/
				$('.chat-history').animate({ scrollTop: $(document).height() }, 'fast');
			  }
			}
			else{
				if($("#fid").val()!=fid){
					$("#chat").html('<div class="stream" id="cstream"></div>');
				}
				$("#mid").val(myid);
                $("#fid").val(fid); 
				$("#uname").html(rsp[1]);
				if(rsp[0]!=""){
				$('#cstream').append(rsp[0]);
				}
				$('#msenger textarea').removeAttr('readonly');
				$('#live-chat').show();
				
				if($("#live-chat2").is(":visible")){
			       $("#live-chat2").css('right','470px');
		        }
		        if($("#live-chat3").is(":visible") && $("#live-chat2").is(":visible")){
			       $("#live-chat3").css('right','725px');
		        }
				if($("#live-chat3").is(":visible") && !$("#live-chat2").is(":visible")){
			       $("#live-chat3").css('right','470px');
		        }
				/*var curcnt=$('#cht_cnt').html();
				$('#cht_cnt').html(parseInt(curcnt)+1);*/
				$('.chat-history').animate({ scrollTop: $(document).height() }, 'fast');
			}
		 }
   });  
}
$(document).keyup(function(e){
	if(e.keyCode == 13){
		e.preventDefault();
		if($('#msg-min').val().trim() == ""){
			$('#msg-min').val('');
		}else{
			//$('#msg-min').attr('readonly', 'readonly');
			//$('#chatAudio')[0].play();
			//$('#sb-mt').attr('disabled', 'disabled');	// Disable submit button
			 sendMsg();
			 
		}

        if($('#msg-min1').val().trim() == ""){
			$('#msg-min1').val('');
		}else{
			//$('#msg-min1').attr('readonly', 'readonly');
			//$('#msg-min1').focus();
			//$('#sb-mt').attr('disabled', 'disabled');	// Disable submit button
			//$('#chatAudio')[0].play();
			 sendMsg1();
		}		
		
		if($('#msg-min2').val().trim() == ""){
			$('#msg-min2').val('');
		}else{
			//$('#msg-min2').attr('readonly', 'readonly');
			//$('#msg-min2').focus();
			//$('#sb-mt').attr('disabled', 'disabled');	// Disable submit button
			//$('#chatAudio')[0].play();
			 sendMsg2();
		}		
	}
});	
$('.chat-close').on('click', function(e) {

		e.preventDefault();
		$('#live-chat').fadeOut(300);
		
		if($("#live-chat2").is(":visible")){
			$("#live-chat2").css('right','215px');
		}
		if($("#live-chat2").is(":visible") && $("#live-chat3").is(":visible")){
			
			$("#live-chat3").css('right','470px');
		}
		if(!$("#live-chat2").is(":visible") && $("#live-chat3").is(":visible")){
			
			$("#live-chat3").css('right','215px');
		}
		
		
		/*var curcnt=$('#cht_cnt').html();
		$('#cht_cnt').html(parseInt(curcnt)-1);*/
		

	});
$('.chat-close1').on('click', function(e) {

		e.preventDefault();
		$('#live-chat2').fadeOut(300);
		
		if($("#live-chat3").is(":visible")){
			$("#live-chat3").css('right','470px');
		}
		if($("#live-chat3").is(":visible") && !$("#live-chat").is(":visible")){
			$("#live-chat3").css('right','215px');
		}
		
		/*var curcnt=$('#cht_cnt').html();
		$('#cht_cnt').html(parseInt(curcnt)-1);*/

	});
	
	$('.chat-close2').on('click', function(e) {

		e.preventDefault();
		$('#live-chat3').fadeOut(300);
	});
	function sendMsg(){
		
	    $.ajax({
		type: 'post',
		url: '<?php echo base_url(); ?>test?rq=new',
		data: $('#msenger').serialize(),
		dataType: 'json',
		success: function(rsp){
				
			$('#msg-min').focus();
			//alert(rsp.time);
				//$('#msenger textarea').removeAttr('readonly');
				//$('#sb-mt').removeAttr('disabled');	// Enable submit button
				if(parseInt(rsp.status) == 0){
					
				}else if(parseInt(rsp.status) == 1){
					$('#msenger textarea').val('');
					$('#msenger textarea').focus();
	
                    $design = '<div class="chat-message clearfix my_msg">'+
									''+
										'<div class="chat-message-content clearfix">'+
											'<span class="chat-time">'+rsp.time+'</span>'+
												''+
													'<p>'+
													rsp.msg+
													'</p>'+
												'</div>'+
											
								'</div><hr>';
					$('#cstream').append($design);

					 var wtf    = $('#chat');
                     var height = wtf[0].scrollHeight;
                     wtf.scrollTop(height);
					//$('#chat').scrollTop($('#cstream').height());
				
				}
			}
		});
		
	
}

 //chat
(function() {

	$('#live-chat header').on('click', function() {

		$('#chat0').slideToggle(300, 'swing');
		$('.chat-message-counter').fadeToggle(300, 'swing');

	});
	$('#live-chat2 header').on('click', function() {

		$('#chat1').slideToggle(300, 'swing');
		$('.chat-message-counter').fadeToggle(300, 'swing');

	});
	$('#live-chat3 header').on('click', function() {

		$('#chat2').slideToggle(300, 'swing');
		$('.chat-message-counter').fadeToggle(300, 'swing');

	});

	$('.chat-close').on('click', function(e) {

		e.preventDefault();
		$('#live-chat').fadeOut(300);
		
		if($("#live-chat2").is(":visible")){
			$("#live-chat2").css('right','215px');
		}
		if($("#live-chat2").is(":visible") && $("#live-chat3").is(":visible")){
			
			$("#live-chat3").css('right','470px');
		}
		if(!$("#live-chat2").is(":visible") && $("#live-chat3").is(":visible")){
			
			$("#live-chat3").css('right','215px');
		}
		
		$.ajax({
			 type:"post",
			 url:"<?php echo base_url(); ?>userLogout",
			 data:{id:1},
			 success:function(msg){
				 
			 }
			
		});
		/*var curcnt=$('#cht_cnt').html();
		$('#cht_cnt').html(parseInt(curcnt)-1);*/
		

	});
	$('.chat-close').on('click', function(e) {

		e.preventDefault();
		$('#live-chat').fadeOut(300);
		
		if($("#live-chat2").is(":visible")){
			$("#live-chat2").css('right','215px');
		}
		if($("#live-chat2").is(":visible") && $("#live-chat3").is(":visible")){
			
			$("#live-chat3").css('right','470px');
		}
		if(!$("#live-chat2").is(":visible") && $("#live-chat3").is(":visible")){
			
			$("#live-chat3").css('right','215px');
		}
		
		$.ajax({
			 type:"post",
			 url:"<?php echo base_url(); ?>Report_Controller/closewind",
			 data:{id:1},
			 success:function(msg){
				 
			 }
			
		});
		/*var curcnt=$('#cht_cnt').html();
		$('#cht_cnt').html(parseInt(curcnt)-1);*/
		

	});
	$('.chat-close1').on('click', function(e) {

		e.preventDefault();
		$('#live-chat2').fadeOut(300);
		
		if($("#live-chat3").is(":visible")){
			$("#live-chat3").css('right','470px');
		}
		if($("#live-chat3").is(":visible") && !$("#live-chat").is(":visible")){
			$("#live-chat3").css('right','215px');
		}
		
		$.ajax({
			 type:"post",
			 url:"<?php echo base_url(); ?>Report_Controller/closewind",
			 data:{id:2},
			 success:function(msg){
				 
			 }
			
		});
		/*var curcnt=$('#cht_cnt').html();
		$('#cht_cnt').html(parseInt(curcnt)-1);*/

	});
	
	$('.chat-close2').on('click', function(e) {

		e.preventDefault();
		$('#live-chat3').fadeOut(300);
		$.ajax({
			 type:"post",
			 url:"<?php echo base_url(); ?>Report_Controller/closewind",
			 data:{id:3},
			 success:function(msg){
				 
			 }
			
		});
		/*var curcnt=$('#cht_cnt').html();
		$('#cht_cnt').html(parseInt(curcnt)-1);*/

	});

}) ();
$(document).ready(function() {
	$("#srctxt").keyup(function(){
		var txt=$("#srctxt").val();
		//$("#loading").show();
		$.ajax({
			type:"post",
			url:"<?php echo base_url(); ?>searchuser",
			data:{txt:txt},
			success:function(msg){
				
				$('.chat-list').html(msg);
				$("#loading").hide();
			}
		});
	});
	
});

function getMsg(){
	
	//alert("fssf");
var fid = $("#fid").val();
var mid = $("#mid").val();
//alert(fid+','+mid);
	$.ajax({
		type: 'post',
		url: '<?php echo base_url(); ?>test?rq=NewMsg',
		data:  {fid: fid, mid: mid},
		dataType: 'json',
		success: function(rsp){
				if(parseInt(rsp.status) == 0){
					//alert(rsp.msg);
				}else if(parseInt(rsp.status) == 1){
					$design = '<div class="chat-message clearfix">'+
									<!--'<img src="<?php echo base_url(); ?>upload/profile_pics/'+rsp.profilePicture+'" alt="" width="32" height="32">'+-->
										'<div class="chat-message-content clearfix">'+
											'<span class="chat-time">'+rsp.time+'</span>'+
												''+
													'<p class="vishal">'+
													rsp.msg+
													'</p>'+
												'</div>'+
											
								'</div><hr>';
					$('#cstream').append($design);
					 $('#live-chat header').css('background','#8BC34A');
					 $('#live-chat').show();
					 var wtf    = $('#chat');
                     var height = wtf[0].scrollHeight;
                     wtf.scrollTop(height);
					//$('#chat').scrollTop ($('#cstream').height());
					//$('.time-'+rsp.lid).livestamp();
					$('#dataHelper').attr('last-id', rsp.lid);	
				}
			}
	});
}
function showstatus(id){
	 $.ajax({
		  type:"post",
		  url:"<?php echo base_url(); ?>changestatus",
		  data:{id:id},
		  success:function(msg){
			  $("#status_menu").hide();
			  var div1Class = $('#online-ic').attr('class');
			 
			  if(id==1){
				  $("#online-ic").removeClass(div1Class);
			   $("#online-ic").addClass("fa fa-check-circle-o mul-ico");
			  }
			  if(id==3){
				   $("#online-ic").removeClass(div1Class);
				   $("#online-ic").addClass("fa fa-minus-circle mul-ico");
			  }
			  if(id==2){
				   $("#online-ic").removeClass(div1Class);
				   $("#online-ic").addClass("fa fa-clock-o mul-ico");
			  }
			  if(id==0){
				   $("#online-ic").removeClass(div1Class);
				   $("#online-ic").addClass("fa fa-circle-thin mul-ico");
			  }
			  
		  }
		 
	 });
}
	//hover menu
    $(function(){
    $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                //$('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                //$('b', this).toggleClass("caret caret-up");                
            });
    });
	/***comment****/
		$('.cmnt-textarea').on('click', function (e) {
  $(this).addClass('clicked');
}).on('transitionend', function (e) {
  $(this).toggleClass('open');
});


function repete(id){
 $('#rep_cmnt'+id).toggleClass('opened-txt');
}

function checkStatus(){
	var fid = $("#fid").val();
	var mid = $("#mid").val();
	
if(fid==""){
	$.ajax({
		type: 'post',
		url: '<?php echo base_url(); ?>test?rq=msg',
		data: {mid: mid},
		success: function(rsp){
			//alert(rsp);
			 if(rsp!=""){
			   rs=rsp.split('+');
			   
					 $('#cstream').append(rs[0]);
					 $("#fid").val(rs[2]);
					 $('#uname').html(rs[1]);
					 $('#live-chat').show();
					 if($("#live-chat2").is(":visible")){
			          $("#live-chat2").css('right','470px');
		             }
		            if($("#live-chat2").is(":visible") && $("#live-chat").is(":visible")){
			          $("#live-chat3").css('right','725px');
		            }
					if(!$("#live-chat2").is(":visible") && $("#live-chat").is(":visible")){
			          $("#live-chat3").css('right','470px');
		            }
					 /*var curcnt=$('#cht_cnt').html();
				     $('#cht_cnt').html(parseInt(curcnt)+1);*/
					 $('#live-chat header').css('background','#8BC34A');

			   
			 }
			}
		});	
}else{
	$.ajax({
		type: 'post',
		url: '<?php echo base_url(); ?>test?rq=msgfid',
		data: {mid: mid,fid: fid},
		dataType: 'json',
		cache: false,
		success: function(rsp){
			//alert(rsp.status);
			//alert(rsp.status);
				if(parseInt(rsp.status) == 0){
					return false;
				}else if(parseInt(rsp.status) == 1){
					//alert("sfs");
					getMsg();
				}
			}
		});	
}
}



// Check for latest message
//setInterval(function(){checkStatus();}, 200);

(function doStuff() {
	// alert("safdsf");
   checkStatus();
   
   setTimeout(doStuff, 5000);
 }());
 
 function openchat(myid,fid){
	//alert(myid);
	$.ajax({
		type:"post",
		url:"<?php echo site_url(); ?>msg",
		data:{mid:myid,fid:fid},
		success:function(msg){
			sp=msg.split('+');
			$("#hismsg").html('<h6 class="usr-his-name">'+sp[1]+'</h6><div id="appd">'+sp[0]+'<div>');
			$("#fsd").val(fid);
		}
		
	});
}

$(document).ready(function() {
	$('#snd').click(function(e){
		$.ajax({
		type: 'post',
		url: '<?php echo base_url(); ?>Report_Controller/sendmsg',
		data: $('#msgbx').serialize(),
		  success:function(msg){
			$("#appd").append(msg);
			$('#msgtxt').focus();
			$("#msgtxt").val(" ");
		  }
	   });
		e.preventDefault();	
	});
	
	$('#appd').animate({ scrollTop: 800 }, 'fast');
	
});
function removestatus(id){
	ct=$("#notifymsg").html();
	if(ct==""){
				  $(".msgnt").show();
			  }
	  $.ajax({
		  type:"post",
		  url:"<?php echo base_url(); ?>Report_Controller/removestatus",
		  data:{mid:id},
		  success:function(msg){
			  //alert("dfs");
			  
			  $("#notifymsg").html("");
			  
		  }
		  
	  });
}
function removecurrentstatus(mid,fid){
	 $.ajax({
		  type:"post",
		  url:"<?php echo base_url(); ?>Report_Controller/removecurrentstatus",
		  data:{mid:mid,fid:fid},
		  success:function(msg){
			  $("#notifymsgnew"+fid).html("");
		  }
		  
	  });
}
$(document).ready(function() {
	$("#srctxt").keyup(function(){
		var txt=$("#srctxt").val();
		$("#loading").show();
		$.ajax({
			type:"post",
			url:"<?php echo base_url(); ?>Report_Controller/searchuser",
			data:{txt:txt},
			success:function(msg){
				$('.chat-list').html(msg);
				$("#loading").hide();
			}
		});
	});
	
});
function showstatus(id){
	 $.ajax({
		  type:"post",
		  url:"<?php echo base_url(); ?>Report_Controller/changestatus",
		  data:{id:id},
		  success:function(msg){
			  $("#status_menu").hide();
			  var div1Class = $('#online-ic').attr('class');
			 
			  if(id==1){
				  $("#online-ic").removeClass(div1Class);
			   $("#online-ic").addClass("fa fa-check-circle-o mul-ico");
			  }
			  if(id==3){
				   $("#online-ic").removeClass(div1Class);
				   $("#online-ic").addClass("fa fa-minus-circle mul-ico");
			  }
			  if(id==2){
				   $("#online-ic").removeClass(div1Class);
				   $("#online-ic").addClass("fa fa-clock-o mul-ico");
			  }
			  if(id==0){
				   $("#online-ic").removeClass(div1Class);
				   $("#online-ic").addClass("fa fa-circle-thin mul-ico");
			  }
			  
		  }
		 
	 });
}
</script>
<script type="text/javascript">

var fr_id=<?php if($this->session->userdata('friend_id')!=""){ echo $this->session->userdata('friend_id'); }else{ echo "0"; } ?>;
var fr_id1=<?php if($this->session->userdata('friend_id1')!=""){ echo $this->session->userdata('friend_id1'); }else{ echo "0"; } ?>;
var fr_id2=<?php if($this->session->userdata('friend_id2')!=""){ echo $this->session->userdata('friend_id2'); }else{ echo "0"; } ?>;
var my_id=<?php echo $this->session->userdata('id');?>;

if(fr_id!=0){
	$.ajax({
		type:"post",
		url:"<?php echo base_url();?>Report_Controller/gethistory",
		data:{mid:my_id,fid:fr_id},
		success:function(rsp){
			rs=rsp.split('+');
			//alert(rs[0]);
			if(rs[0]!=""){
			$('#cstream').append(rs[0]);
			}
			$('#chat0').slideToggle(300, 'swing');
			$("#fid").val(rs[2]);
			$('#uname').html(rs[1]);
			$('#live-chat').show();
			if($("#live-chat2").is(":visible")){
				$("#live-chat2").css('right','470px');
			}
			/*var curcnt=$('#cht_cnt').html();
			$('#cht_cnt').html(parseInt(curcnt)+1);*/
			$('.chat-history').animate({ scrollTop: $(document).height() }, 'fast');
			
		}
	});
	
}

</script>
<!--scripts-->


        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->

</html>