angular.module('crmApp').controller('Show_LeadController', function($rootScope, $scope, $http, $timeout, $stateParams,$window) {
    $scope.$on('$viewContentLoaded', function() {   
       
	  $scope.leadid=$stateParams.leadid;

		  $http.post("getLeadById?leadid="+$scope.leadid).success(function(data){
	        $scope.data=data;

          });
		  
		  $http.post("Main_Controller/getLeadActionsById?leadid="+$scope.leadid).success(function(actions){
	        $scope.actions=actions;

          });
	   
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});