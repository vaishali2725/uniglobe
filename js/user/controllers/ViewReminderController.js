angular.module('crmUserApp').controller('ViewReminderController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        
		  getreminders();
	function getreminders(){  
  $http.post("getreminders").success(function(reminders){
    $scope.reminders = reminders;
	   $scope.data1 = reminders;
      console.log(reminders);
       $scope.viewby = 10;
       $scope.totalItems = $scope.data1.length;
       $scope.currentPage = 1;
       $scope.itemsPerPage = $scope.viewby;
       $scope.maxSize = 5;
	
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
	
	$scope.get_upcoming_reminders=function(){
		
		$http.post("Main_Controller/get_upcoming_reminders").success(function(upcoming_reminders){
    $scope.upcoming_reminders = upcoming_reminders;
	   $scope.data1 = upcoming_reminders;
console.log(upcoming_reminders);
       $scope.viewby = 10;
       $scope.totalItems = $scope.data1.length;
       $scope.currentPage = 1;
       $scope.itemsPerPage = $scope.viewby;
       $scope.maxSize = 5;
	
      });
		
	}
	
	
	$scope.get_past_reminders=function(){
		
		$http.post("Main_Controller/get_past_reminders").success(function(past_reminders){
    $scope.past_reminders = past_reminders;
	   $scope.data1 = past_reminders;
       console.log(past_reminders);
       $scope.viewby = 10;
       $scope.totalItems = $scope.data1.length;
       $scope.currentPage = 1;
       $scope.itemsPerPage = $scope.viewby;
       $scope.maxSize = 5;
	
      });
		
	}
	
	
	$scope.editform=false;
	$scope.edit_reminder = function(id){
		$http.post("Main_Controller/get_data_to_edit?rid="+id).success(function(data){
			$scope.editform=true;
			$scope.data=data;
		});
	}
	
	$scope.deleteReminder=function(id){
		if(confirm('are you sure to delete')){
			$http.post("deletereminder?rid="+id).success(function(){
				getreminders();
				$scope.message="reminder deleted successfully";
			});
			
		}
	}
   
   $scope.update_reminder = function(id,update_rmd){
	    $scope.r_data=angular.copy(update_rmd);
	   $http.post('Main_Controller/update_remind?r_data='+JSON.stringify($scope.r_data)+'&rid='+id).success(function(){
			 $("#myModal").modal('show');
			getreminders();	
			$scope.editform=false;
			//$scope.message="reminder updated successfully";
			
		    
	 });
   }
  
  });

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});

