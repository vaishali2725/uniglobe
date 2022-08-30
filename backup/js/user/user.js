
var crmUserApp = angular.module("crmUserApp", [
    "ui.router", 
    "ui.bootstrap", 
    "oc.lazyLoad",  
    "ngSanitize"
]); 

crmUserApp.factory('settings', ['$rootScope', function($rootScope) {
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
crmUserApp.controller('HeaderController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
       
        Layout.initHeader(); // init header
	});
}]);

/* Setup Layout Part - Sidebar */
crmUserApp.controller('SidebarController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
        Layout.initSidebar(); // init sidebar
    });
}]);

/* Setup Layout Part - Quick Sidebar */
crmUserApp.controller('QuickSidebarController', ['$scope', function($scope) {    
    $scope.$on('$includeContentLoaded', function() {
       setTimeout(function(){
            QuickSidebar.init(); // init quick sidebar        
        }, 2000)
    });
}]);

/* Setup Layout Part - Theme Panel */
crmUserApp.controller('ThemePanelController', ['$scope', function($scope) {    
    $scope.$on('$includeContentLoaded', function() {
        Demo.init(); // init theme panel
    });
}]);

/* Setup Layout Part - Footer */
crmUserApp.controller('FooterController', ['$scope', function($scope) {
    $scope.$on('$includeContentLoaded', function() {
        Layout.initFooter(); // init footer
    });
}]);

/* Setup Rounting For All Pages */
crmUserApp.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
    // Redirect any unmatched url
  
    
    $stateProvider

        // Dashboard
        .state('dashboard', {
            url: "/dashboard",
            templateUrl: "views/user/dashboard.html",            
            data: {pageTitle: 'Admin Dashboard Template'},
            controller: "DashboardUserController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmUserApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                            'assets/global/plugins/morris/morris.css',                            
                            'assets/global/plugins/morris/morris.min.js',
                            'assets/global/plugins/morris/raphael-min.js',                            
                            'assets/global/plugins/jquery.sparkline.min.js',
                            'assets/pages/scripts/dashboard.min.js',
                            'js/user/controllers/DashboardUserController.js',
                        ] 
                    });
                }]
            }
        })
		
	
		.state('My_Leads', {
            url: "/My_Leads",
            templateUrl: "views/user/newMy_Leads.html",            
            data: {pageTitle: 'User Leads'},
            controller: "MyLeadsController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmUserApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/apps/css/todo-2.css',
                           'assets/css/jquery.timepicker.css',
                           '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/user/controllers/MyLeadsController.js', 
                           '//code.jquery.com/ui/1.11.4/jquery-ui.js',
                           'assets/js/jquery.timepicker.min'   

                        ] 
                    });
                }]
            }
        })

.state('Add_Leads', {
            url: "/Add_Leads",
            templateUrl: "views/user/Add_Leads.html",            
            data: {pageTitle: 'Add Leads'},
            controller: "AddLeadController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmUserApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/apps/css/todo-2.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/user/controllers/AddLeadController.js'  
                        ] 
                    });
                }]
            }
        })

.state('Add_Reminder', {
            url: "/Add_Reminder",
            templateUrl: "views/user/Add_Reminder.html",            
            data: {pageTitle: 'Add Reminder'},
            controller: "AddReminderController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmUserApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/apps/css/todo-2.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'js/user/controllers/AddReminderController.js'  
                        ] 
                    });
                }]
            }
        })

.state('View_Reminder', {
            url: "/View_Reminder",
            templateUrl: "views/user/View_Reminder.html",            
            data: {pageTitle: 'View Reminder'},
            controller: "ViewReminderController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmUserApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/apps/css/todo-2.css',
                           'assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                           'assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                           'assets/global/plugins/clockface/css/clockface.css',
                           'assets/global/plugins/moment.min.js',
                           'assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                           'assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
                           'assets/global/plugins/clockface/js/clockface.js',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                           'assets/apps/scripts/todo-2.min.js',
                           'assets/pages/scripts/components-date-time-pickers.min.js',
                           'js/user/controllers/ViewReminderController.js'  
                        ] 
                    });
                }]
            }
        })



.state('My_Profile', {
            url: "/My_Profile",
            templateUrl: "views/user/User_Profile.html",            
            data: {pageTitle: 'My Profile'},
            controller: "MyProfileController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmUserApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
                           'assets/pages/css/profile.min.css',
                           'assets/global/plugins/select2/css/select2.min.css',
                           'assets/global/plugins/select2/css/select2-bootstrap.min.css',
                           'assets/global/plugins/select2/js/select2.full.min.js',
                           'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
                           'assets/pages/scripts/profile.min.js',
                           'assets/global/scripts/app.min.js',
                           'js/user/controllers/MyProfileController.js'  
                        ] 
                    });
                }]
            }
        })
        
       
        
        
		
		
		
		
		

       
}]);

/* Init global settings and run the app */
crmUserApp.run(["$rootScope", "settings", "$state", function($rootScope, settings, $state) {
    $rootScope.$state = $state; // state to be accessed from view
    $rootScope.$settings = settings; // state to be accessed from view
}]);