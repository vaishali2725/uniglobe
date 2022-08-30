angular.module('crmUserApp').controller('MyProfileController', function($rootScope, $scope, $http, $timeout,fileUpload) {
    $scope.$on('$viewContentLoaded', function() {   

	   
        App.initAjax();
		
		
		$scope.changepic=function(){
			$scope.updateprofile=true;
			$scope.profileinfo=true;
		}
		
		$scope.uploadFile = function(){
        var file = $scope.myFile;
        console.log('file is ' );
        console.dir(file);

        var uploadUrl = "Main_Controller/upload_file";
        var text = $scope.name;
        fileUpload.uploadFileToUrl(file, uploadUrl, text);
   };
		
		
        getMyProfileInfo();
	function getMyProfileInfo(){  
  $http.post("getMyProfileInfo").success(function(myProfile){
  $scope.myProfile = myProfile;
  console.log(myProfile)
      });
	   
  };
  
 
  
  $scope.updateInfo = function (user) {
	  $scope.userdata=angular.copy(user);
	  console.log($scope.userdata);
    $http.post("updateUser?user="+JSON.stringify($scope.userdata)).success(function(){
		   	getMyProfileInfo();
			//$scope.message="profile updated successfully";
			 $("#myModal").modal('show');
		     
       });
  };
           
  
  
  
   function check_current_pwd($c_pwd){
	var s = $http.post("Main_Controller/get_pwd?c_pwd="+$c_pwd);
	 
  }
		   
 $scope.changePassword=function(){
	//check_current_pwd($scope.user.currentPassword);
	  $http.post("changePassword?newpwd="+$scope.newPassword).success(function(){
		 	getMyProfileInfo();
		// $scope.message="password changed successfully";
		  $("#pmodel").modal('show');
       });
  }
  
  
  
  
  
  
  
});



    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});


crmUserApp.directive('fileModel', ['$parse', function ($parse) {
    return {
    restrict: 'A',
    link: function(scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
        });
    }
   };
}]);
	
crmUserApp.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl, name){
         var fd = new FormData();
         fd.append('file', file);
         fd.append('name', name);
         $http.post(uploadUrl, fd, {
             transformRequest: angular.identity,
             headers: {'Content-Type': undefined,'Process-Data': false}
         })
         .success(function(){
			 alert("successfully changed profile picture");
			 getMyProfileInfo();
         })
         .error(function(){
            
         });
     }
 }]);	
		 
		 



'use strict';
/* Directives */
angular.module('crmUserApp.directives', [])
    .directive('pwCheck', [function () {
    return {
        require: 'ngModel',
        link: function (scope, elem, attrs, ctrl) {
            var firstPassword = '#' + attrs.pwCheck;
            elem.add(firstPassword).on('keyup', function () {
                scope.$apply(function () {
                    // console.info(elem.val() === $(firstPassword).val());
                    ctrl.$setValidity('pwmatch', elem.val() === $(firstPassword).val());
                });
            });
        }
    }
}]);



		 
      