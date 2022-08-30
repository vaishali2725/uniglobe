angular.module('crmUserApp').controller('ViewReminderController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        
		  getreminders();
	function getreminders(){  
  $http.post("getreminders").success(function(reminders){
    $scope.reminders = reminders;
      });
	   
    };
	
	$scope.deleteReminder=function(id){
		if(confirm('are you sure to delete')){
			$http.post("deletereminder?rid="+id).success(function(){
				getreminders();
			});
			
		}
	}
   
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});