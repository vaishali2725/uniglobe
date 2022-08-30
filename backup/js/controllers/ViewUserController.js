angular.module('crmApp').controller('ViewUserController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        getUser();
	function getUser(){  
  $http.post("getUsers").success(function(user){
  $scope.user = user;
      });
	   
  };


   $scope.deleteUser = function (id){
    if(confirm("Are you sure to delete this User?")){
    $http.post("deleteUser?id="+id).success(function(){
        getUser();
      });
    }
  };
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});