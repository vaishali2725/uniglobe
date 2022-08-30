angular.module('crmApp').controller('ToDoController', function($rootScope, $scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
        getUserTask();
  $scope.task={};
  function getUserTask(){  
  $http.post("getUserTask").success(function(tasks){
  $scope.tasks = tasks;
       });
  };

   $scope.deleteTask = function (taskid){
    if(confirm("Are you sure to delete this task?")){
    $http.post("deleteTask?taskid="+taskid).success(function(){
        getUserTask();
      });
    }
  };
  
    $scope.addTask = function () {
        
    $http.post("addTask?task="+JSON.stringify($scope.task)).success(function(){
        getUserTask();
        $scope.task.taskName = "";
        $scope.task.Details = "";
    });
  };
  
});

    // set sidebar closed and body solid layout mode
    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});