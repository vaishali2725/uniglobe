angular.module('crmApp').controller('ViewLeadsController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        getLeads();
	function getLeads(){  
  $http.post("getLeads").success(function(leads){
  $scope.leads = leads;
      });
	   
  };


   $scope.deleteLead = function (id){
    if(confirm("Are you sure to delete this lead?")){
    $http.post("deleteLead?id="+id).success(function(){
       getLeads();
      });
    }
  };
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});