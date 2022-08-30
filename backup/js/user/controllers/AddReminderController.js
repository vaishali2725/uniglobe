angular.module('crmUserApp').controller('AddReminderController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
       
	    getMyLeads();
	function getMyLeads(){  
  $http.post("getMyLeads").success(function(myLeads){
       $scope.myLeads = myLeads;
      });
	   
  };
  
   $scope.addReminder=function(){
	   
	   $http.post("addReminder?reminder="+JSON.stringify($scope.reminder)).success(function(message){
        console.log($scope.message);
		$scope.message=message;
 });
   }
   
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});