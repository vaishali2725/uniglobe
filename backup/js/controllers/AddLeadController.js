angular.module('crmApp').controller('AddLeadController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        getUser();
    function getUser(){  
  $http.post("getUsers").success(function(user){
  $scope.user = user;
      });
       
  };
   
        if ($scope.leadForm.$valid) {
        $scope.addLeads = function () {
        $http.post("addLeads?leads="+JSON.stringify($scope.lead)).success(function(){
        
    });
  };
  }
   
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});