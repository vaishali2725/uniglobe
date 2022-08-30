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

  $scope.addAction = function() {  
    $scope.action.leadid;
    console.log($scope.action);
    $http.post("addAction?action="+JSON.stringify($scope.action)).success(function(data){
    $scope.viewLead($scope.action.leadid);
    getMyLeads();
    $scope.data = data;
    $scope.show_lead_info=true;
    $scope.hide_leads=true;
      });
    
  };

  
  $scope.viewLead = function (leadid){
   $http.post("getLeadById?leadid="+leadid).success(function(data){
      getMyLeads();
      $scope.data = data;
		  $scope.show_lead_info=true;
		  $scope.hide_leads=true;
   });
    
  };
  
   $scope.showleads = function (){
     getMyLeads();
		 $scope.show_lead_info=false;
		 $scope.hide_leads=false;
   }
    

  
  
});

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});