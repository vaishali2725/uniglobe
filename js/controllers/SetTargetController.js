'use strict';

angular.module('crmApp').controller('SetTargetController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();


	getallusers();
		
		
		
function getallusers(){
			$http.post("Main_Controller/getUsers").success(function(user_data){
				$scope.user_data=user_data;

	});
		
}


	
$scope.get_selected_user_leads=function(userid){

	$http.post("Main_Controller/get_selected_user_leads?u_id="+userid).success(function(count){
		$scope.lead_count=count;
		$scope.showleads=true;
	});
}	

$scope.setTarget=function(){
	 $http.post("Main_Controller/set_target?t="+JSON.stringify($scope.user)).success(function(data){
		 console.log(data);
		 if(data)
		 {
		 $("#targeterror").modal('show');
		 document.userForm.reset(); 
		 }
		 else 
		 {
			$("#targetModal").modal('show');
		    document.userForm.reset(); 
		 }
	 });
}
	
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});