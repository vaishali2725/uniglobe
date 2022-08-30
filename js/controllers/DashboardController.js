angular.module('crmApp').controller('DashboardController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
		alluserstatus();
        leadboarddata();
		gettargets();
		get_leadcounts_by_status();
		
});


function leadboarddata()
{
	  $http.post("Report_Controller/leaderBoard").success(function(leaderboard){
	   $scope.leaderboard = leaderboard;	  
		});
}

function alluserstatus()
{
	  $http.post("Main_Controller/userstatus").success(function(ustatus){
	   $scope.ustatus = ustatus;	  
		});
}

function gettargets()
{
	$http.post("Main_Controller/disTargets").success(function(targets){
	$scope.targets=targets;

	});
}

function get_leadcounts_by_status(){
	$http.post("Main_Controller/get_leadcounts_by_status").success(function(data){
		$scope.data=data;
	});
}



    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
    
});