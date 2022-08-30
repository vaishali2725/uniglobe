angular.module('crmUserApp').controller('MyLeadsController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        getMyLeads();
	function getMyLeads(){  
  $http.post("getMyLeads").success(function(myLeads){
  $scope.myLeads = myLeads;
      });
	   
  };
  
   $scope.viewLead = function (leadid){
   $http.post("getLeadById?leadid="+leadid).success(function(leadDetails){
         getMyLeads();
		 $scope.leadDetails = leadDetails;
      });
    
  };
  
});

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});