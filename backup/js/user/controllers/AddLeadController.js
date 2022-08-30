angular.module('crmUserApp').controller('AddLeadController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        if ($scope.leadForm.$valid) {
        $scope.addLeadsToMyList = function () {
        $http.post("addLeadToMyList?leads="+JSON.stringify($scope.lead)).success(function(message){
          $scope.message = message;
        });
  };
  }
   
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});