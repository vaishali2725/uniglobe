angular.module('crmUserApp').controller('MyProfileController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
       
        App.initAjax();
        getMyProfileInfo();
	function getMyProfileInfo(){  
  $http.post("getMyProfileInfo").success(function(myProfile){
  $scope.myProfile = myProfile;
  
      });
	   
  };
  $scope.updateInfo = function () {
	  
    $http.post("updateUser?user="+JSON.stringify($scope.user)).success(function(){
		   	getMyProfileInfo();
       });
  };
            
  
  
  
});

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});