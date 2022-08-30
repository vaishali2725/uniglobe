angular.module('crmUserApp').controller('DashboardUserController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
	    total_leads();
		completed_leads();
		pending_leads();
	function total_leads(){  
          $http.post("total_leads").success(function(mytotalleads){
          $scope.mytotalleads = mytotalleads;
      });
	};
	
	function completed_leads(){  
          $http.post("completed_leads").success(function(mycompletedleads){
          $scope.mycompletedleads = mycompletedleads;
      });
	};
	
	function pending_leads(){  
          $http.post("pending_leads").success(function(mypendingleads){
          $scope.mypendingleads = mypendingleads;
      });
	};


  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
    
});