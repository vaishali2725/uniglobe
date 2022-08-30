angular.module('crmUserApp').controller('AddReminderController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
       
	    getAllleads();
		
		
		
    var d = new Date();
    var n = d.toTimeString();
    $scope.ctime = angular.copy(n);
	// console.log($scope.ctime);
	
		
	function getAllleads(){  
     $http.post("getAllleads").success(function(allleads){
       $scope.allleads = allleads;
      });
	   
  }; 
  
 
  
   $scope.addReminder=function(ctime){
	   $scope.today=new Date();
	   $scope.r_date = $scope.reminder.reminderDate;
	   $http.post("addReminder?reminder="+JSON.stringify($scope.reminder)+"&ctime="+$scope.ctime).success(function(message){
		 console.log(message);
			   $("#myModal").modal('show');
		          document.reminderForm.reset();
     });
   }
   
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});