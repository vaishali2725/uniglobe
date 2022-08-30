

var crmApp = angular.module("crmApp", [
    "ui.router", 
    "ui.bootstrap", 
    "oc.lazyLoad",  
    "ngSanitize",
	"ngGrid"
	
]); 

crmApp.factory('settings', ['$rootScope', function($rootScope) {
    // supported languages
    var settings = {
        layout: {
            pageSidebarClosed: false, 
            pageContentWhite: true, 
            pageBodySolid: false, 
            pageAutoScrollOnLoad: 1000
        },
        assetsPath: 'assets',
        globalPath: 'assets/global',
        layoutPath: 'assets/layouts/layout',
    };
	
	
	

    $rootScope.settings = settings;

    return settings;
}]);


/***
Layout Partials.
By default the partials are loaded through AngularJS ng-include directive. In case they loaded in server side(e.g: PHP include function) then below partial 
initialization can be disabled and Layout.init() should be called on page load complete as explained above.
***/

/* Setup Layout Part - Header */
crmApp.controller('HeaderController', ['$scope','$http', function($scope,$http) {
    $scope.$on('$includeContentLoaded', function() {
       
        Layout.initHeader(); // init header
		
		
		$scope.logout = function () {
			 
			 $http.post("UserLogout").success(function(){
				 
			
				window.location = '';

			});
            };
			
			
					   getMyProfileInfo();
	function getMyProfileInfo(){  
  $http.post("getMyProfileInfo").success(function(myProfile){
  $scope.myProfile = myProfile;
      });
	   
  };
		
       });
}]);

/* Setup Layout Part - Sidebar */
crmApp.controller('SidebarController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
        Layout.initSidebar(); // init sidebar
    });
}]);

/* Setup Layout Part - Quick Sidebar */
crmApp.controller('QuickSidebarController', ['$scope', function($scope) {    
    $scope.$on('$includeContentLoaded', function() {
       setTimeout(function(){
            QuickSidebar.init(); // init quick sidebar        
        }, 2000)
    });
}]);

/* Setup Layout Part - Theme Panel */
crmApp.controller('ThemePanelController', ['$scope', function($scope) {    
    $scope.$on('$includeContentLoaded', function() {
        Demo.init(); // init theme panel
    });
}]);

/* Setup Layout Part - Footer */
crmApp.controller('FooterController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
        Layout.initFooter(); // init footer
    });
}]);

/* Setup Rounting For All Pages */
crmApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
    // Redirect any unmatched url
  $urlRouterProvider.otherwise("/dashboard");  
    
    $stateProvider

        // Dashboard
        .state('dashboard', {
            url: "/dashboard",
            templateUrl: "views/dashboard.html",            
            data: {pageTitle: 'Admin Dashboard Template'},
            controller: "DashboardController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                            'assets/global/plugins/morris/morris.css',                            
                            'assets/global/plugins/morris/morris.min.js',
                            'assets/global/plugins/morris/raphael-min.js',                            
                            'assets/global/plugins/jquery.sparkline.min.js',
                            'assets/pages/scripts/dashboard.min.js',
                            'js/controllers/DashboardController.js',
                        ] 
                    });
                }]
            }
        })
		
	.state('todo', {
            url: "/todo",
            templateUrl: "views/todo.html",            
            data: {pageTitle: 'Task To Do'},
            controller: "ToDoController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/apps/css/todo-2.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/ToDoController.js'  
                        ] 
                    });
                }]
            }
        })
        
        .state('Add_User', {
            url: "/Add_User",
            templateUrl: "views/Add_User.html",            
            data: {pageTitle: 'Task To Do'},
            controller: "AddUserController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/apps/css/todo-2.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/AddUserController.js'  
                        ] 
                    });
                }]
            }
        })
        
          .state('All_User', {
            url: "/All_User",
            templateUrl: "views/All_User.html",            
            data: {pageTitle: 'All User'},
            controller: "ViewUserController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/datatables/datatables.min.css',
                           'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/scripts/datatable.js',
                           'assets/global/plugins/datatables/datatables.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/ViewUserController.js'  
                        ] 
                    });
                }]
            }
        })
		
		 .state('Show_Lead', {
            url: "/Show_Lead/:leadid",
            templateUrl: "views/show_lead.html",            
            data: {pageTitle: 'Task To Do'},
            controller: "Show_LeadController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/apps/css/todo-2.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                            'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/Show_LeadController.js'  
                        ] 
                    });
                }]
            }
        })
		
        
        .state('Create_Lead', {
            url: "/Create_Lead",
            templateUrl: "views/Create_Lead.html",            
            data: {pageTitle: 'Task To Do'},
            controller: "AddLeadController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/apps/css/todo-2.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                            'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/AddLeadController.js'  
                        ] 
                    });
                }]
            }
        })
		
		
		 .state('All_Leads', {
            url: "/All_Leads",
            templateUrl: "views/All_Leads.html",            
            data: {pageTitle: 'All Leads'},
            controller: "ViewLeadsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/datatables/datatables.min.css',
                           'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/scripts/datatable.js',
                           'assets/global/plugins/datatables/datatables.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/ViewLeadsController.js'  
                        ] 
                    });
                }]
            }
        })
		
		.state('view_report', {
            url: "/view_report",
            templateUrl: "views/new_report.html",            
            data: {pageTitle: 'Report'},
            controller: "ViewReportController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/datatables/datatables.min.css',
                           'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/scripts/datatable.js',
                           'assets/global/plugins/datatables/datatables.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/ViewReportController.js'  
                        ] 
                    });
                }]
            }
        })
		
		
	.state('upload_csv', {
            url: "/upload_csv",
            templateUrl: "views/upload_csv.html",            
            data: {pageTitle: 'CSV Upload'},
            controller: "uploadcsvController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/datatables/datatables.min.css',
                           'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/scripts/datatable.js',
                           'assets/global/plugins/datatables/datatables.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/uploadcsvController.js'  
                        ] 
                    });
                }]
            }
        })
		
		
		.state('set_target', {
            url: "/set_target",
            templateUrl: "views/set_target.html",            
            data: {pageTitle: 'Set Target'},
            controller: "SetTargetController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/datatables/datatables.min.css',
                           'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/scripts/datatable.js',
                           'assets/global/plugins/datatables/datatables.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/controllers/SetTargetController.js'  
                        ] 
                    });
                }]
            }
        })
		
			

       
}]);

/* Init global settings and run the app */
crmApp.run(["$rootScope", "settings", "$state", function($rootScope, settings, $state) {
    $rootScope.$state = $state; // state to be accessed from view
    $rootScope.$settings = settings; // state to be accessed from view
}]);



