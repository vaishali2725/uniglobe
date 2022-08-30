'use strict';

angular.module('crmUserApp').controller('viewleadcontroller',function($rootScope, $scope, $http,$stateParams, $timeout) {
  
        App.initAjax();
		$scope.datepicker=true;
		$scope.next_action=true;
		

	    $scope.first_action=function(action)
		{
			console.log(action);
			
			if(action!="Other")
			{
				$scope.datepicker=true;
				$scope.next_action=true;
			}
			else
			{
				$scope.datepicker=false;
				$scope.next_action=false;
			}
		}
		
        $scope.leadid = $stateParams.leadid;
		
		get_leads();
		get_mail_history($scope.leadid);
		get_inboxmsg($scope.leadid);
		
		$scope.sentboxview=true;
	    $scope.inboxview=true;
		$scope.mail_body=false;
		
		
	
		function get_leads(){
			$http.post("getMyLeads").success(function(my_leads){
				$scope.myleads = my_leads
				$scope.inboxview=true;
				$scope.outboxview=false;
			});
		}
		
	
  $http.post("getLeadById?leadid="+$scope.leadid).success(function(data){
	  $scope.data=data;
  });
  
   $scope.addAction = function(action) { 
   
   if(action.first_action=="Other")
   {
	  // alert('hello');
	  action.next_action="";
	  action.appointmentDate="";
	   console.log(action)
   }
   
   if(action.first_action == '' || action.nextaction == '' || action.action_dec || action.appointmentDate == ''){
	   alert('please select all fields');
   }else{
	   $http.post("addAction?action="+JSON.stringify(action)).success(function(data){
		document.actionForm.reset();
       $scope.data = data;
	   $scope.viewLead($scope.action.leadid);
	   //$scope.viewlead_action($scope.action.leadid);
      });
   }
   
  };
  
  
  $scope.viewLead = function (leadid){
   $http.post("getLeadById?leadid="+leadid).success(function(data){
     // getMyLeads();
      $scope.data = data;
		 
   });
    
  };
  
  	 //pagination
  $scope.setPage = function (pageNo) {
    $scope.currentPage = pageNo;
	
  };

  $scope.pageChanged = function() {
    console.log('Page changed to: ' + $scope.currentPage);
  };

 $scope.setItemsPerPage = function(num) {	
  $scope.itemsPerPage = num;
  $scope.currentPage = 1; //reset to first paghe
}
  //complete pagination
	
  
  
    function get_inboxmsg(lid){
       
	    $http.post("Report_Controller/getleadmail?leadid="+lid).success(function(leaddata){
			//console.log(leaddata);
			getmail(leaddata);
		});
			 
   }
  
  function getmail(leaddata){
	  $http.post("Report_Controller/get_user_inbox?leaddata="+JSON.stringify(leaddata)).success(function(data){
		        $scope.inboxdata = data;
                $scope.data1 = data;
				
		      $scope.viewby = 5;
       $scope.totalItems = $scope.data1.length;
       $scope.currentPage = 1;
       $scope.itemsPerPage = $scope.viewby;
       $scope.maxSize = 5;
	   });
  }
  function get_mail_history(lid){
		  $http.post("Report_Controller/get_mail_history?leadid="+lid).success(function(mail_history){
				$scope.mail_history=mail_history;
				//console.log($scope.mail_history);
			});
		}
  
  $scope.sendmail=function(){
	 // console.log($scope.cemail);
			$http.post("Report_Controller/sendmail?data="+JSON.stringify($scope.cemail)).success(function(data){
				$("#emailModal").modal('hide');
		        document.emailForm.reset();
				$("#emailsuccessModal").modal('show');
		       get_mail_history();
			});
		}
		
  $scope.showInbox=function(){ 
	    $scope.sentboxview=true;
	    $scope.inboxview=true;
		$scope.mail_body=false;
		$scope.sentmail_body = false;
		
		
  }	
  $scope.showreply_box=function(){
	 $scope.showreplybx=true;
	   $scope.mail_body = true;
	  $scope.sentboxview=true;
	  $scope.inboxview=false;
	  $scope.sentmail_body = false;
  }
  
 $scope.showsentbox=function(){
	  $scope.sentboxview=false;
	  $scope.inboxview=false;
	  $scope.mail_body=false;
	   $scope.sentmail_body = false;
  }	  
  
  $scope.showmailbody=function(I){
	 // console.log(I);
	 $scope.fullmessagebody=angular.copy(I);
	// console.log($scope.toaddress);
	 //console.log($scope.fullmessagebody);
	  $scope.mail_body = true;
	  $scope.sentboxview=true;
	  $scope.inboxview=false;
	  $scope.sentmail_body = false;
  }
  
  $scope.showsentmailbody=function(m){
	 $scope.sentmailbody = angular.copy(m);
	 $scope.sentmail_body = true;
	 $scope.mail_body = false;
	  $scope.sentboxview=true;
	  $scope.inboxview=false;
  }
  
  $scope.sendreply=function(msg,from1,to)
  {
	//console.log(msg,from1,to);
	$http.post("Report_Controller/sendreply?msg="+msg+"&from1="+from1+"&to="+to).success(function(data){
		console.log(data);
	});
  }
    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});
