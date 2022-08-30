angular.module('crmApp').controller('AddUserController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
		
        if ($scope.userForm.$valid) {
        $scope.addUser = function () {
        $http.post("addUser?user="+JSON.stringify($scope.user)).success(function(){
		});
  };
            }
   
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});