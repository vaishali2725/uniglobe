angular.module('crmUserApp').controller('DashboardUserController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
	    total_leads();
		completed_leads();
		pending_leads();
		upCommingReminders();
		get_users();
		get_leadcount_per_user();
		get_my_leads();
		//get_user_target();
		
		
		
	
		
	function total_leads(){  
          $http.post("total_leads").success(function(mytotalleads){
          $scope.mytotalleads = mytotalleads;
      });
	};
	
	function upCommingReminders(){  
	  $http.post("getUpcomingReminders").success(function(upcomming){
		 
		  $scope.upcomming = upcomming;	 
      });
	};
	
	function completed_leads(){  
          $http.post("completed_leads").success(function(mycompletedleads){
          $scope.mycompletedleads = mycompletedleads;
      });
	};
	
	function pending_leads(){  
          $http.post("pending_leads").success(function(mypendingleads){
          $scope.mypendingleads = mypendingleads;
      });
	};
	
	function getLeaderBoard(){  
          $http.post("getLeaderBoard").success(function(mypendingleads){
          $scope.leaderBoard = leaderBoard;
      });
	};

	
		function getLeaderBoard(){  
          $http.post("getLeaderBoard").success(function(mypendingleads){
          $scope.leaderBoard = leaderBoard;
      });
	};

		function getPendingLeads(){  
          $http.post("getPendingLeads").success(function(pendingleads){
          $scope.pendingleads = pendingleads;
      });
	};
	
	/* function get_user_target(){
	$http.post("Main_Controller/get_user_target").success(function(user_target){
          $scope.user_target = user_target;
		  $scope.target = $scope.user_target[0]['target'];

      });
	}; */
  



    $scope.getleadinfo=function(lid){
	   window.location = '#/view_leads/'+lid;
    }

   function get_users(){
	    $http.post("Main_Controller/get_all_users").success(function(users){
			$scope.users = users;

		});
	
    }
	
	function get_leadcount_per_user(){
		$http.post("Main_Controller/get_leadcounts_per_user").success(function(count){
			  $scope.count = count;
			  
		});
	}
	
	function get_my_leads(){
		$http.post("Main_Controller/get_myleads").success(function(myleads){
			$scope.myleads=myleads;
		});
	}
	
 });
  

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
    
});