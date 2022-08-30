angular.module('crmApp').controller('ViewUserController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() { 

	// initialize core components
        App.initAjax();
        getUser();
	  function getUser(){  
        $http.post("getUsers").success(function(user){
	   
       $scope.user = user; 
	   $scope.data1 = user;
       $scope.viewby = 10;
       $scope.totalItems = $scope.data1.length;
       $scope.currentPage = 1;
       $scope.itemsPerPage = $scope.viewby;
       $scope.maxSize = 5;
      });
	   
  };
  
   $scope.setPage = function (pageNo) {
    $scope.currentPage = pageNo;
	
  };

  $scope.pageChanged = function() {
    console.log('Page changed to: ' + $scope.currentPage);
  };

 $scope.setItemsPerPage = function(num) {	
  $scope.itemsPerPage = num;
  $scope.currentPage = 1; //reset to first paghe
}
  
 
  $scope.EditUser=function(id){
	  $http.post("Main_Controller/get_userinfo?id="+id).success(function(userdata){
		  $scope.userdata = userdata;
          $scope.uid = angular.copy(id);		  
		  console.log(userdata);
	  });
	  $scope.edituserform=true;
	  $scope.showallusers=true;
  }
  
  $scope.Update_User=function(edituser,uid){
	 $http.post("Main_Controller/Update_User?id="+uid+"&u_data="+JSON.stringify(edituser)).success(function(data){
	  	$("#editModal").modal('show');
		getUser();
		 $scope.edituserform=false;
	  $scope.showallusers=false;
	 });
  }

   $scope.deleteUser = function (id){
    if(confirm("Are you sure to delete this User?")){
    $http.post("deleteUser?id="+id).success(function(){
        getUser();
		
      });
    }
  };
  
  
  $scope.deactive_User = function (id){

    $http.post("Main_Controller/deactivate_User?id="+id).success(function(){
       getUser();
      });
    
  };
  
  $scope.activate_User = function (id){
   
    $http.post("Main_Controller/activate_User?id="+id).success(function(){
          getUser();
      });
    
  };
  
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});