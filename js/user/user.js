
var crmUserApp = angular.module("crmUserApp", [
    "ui.router", 
    "ui.bootstrap", 
    "oc.lazyLoad",  
    "ngSanitize",
	'ui.calendar',
	'ngIdle',
	'angular-web-notification'
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

crmUserApp.config(["KeepaliveProvider", "IdleProvider",
    function (KeepaliveProvider, IdleProvider) {
        IdleProvider.idle(840);
        IdleProvider.timeout(900);
        //KeepaliveProvider.interval(60);
    }]);
	
crmUserApp.run(['Idle','$rootScope','$http', function (Idle,$rootScope,$http) {
        Idle.watch();
		$rootScope.$on('IdleStart', function() { alert('your session will expire in 1 minutes...plz do something to keep session alive'); });
  $rootScope.$on('IdleTimeout', function() {
   
   $http.post("Main_Controller/userLogout").success(function(){
	   alert('your session has expired');
	   window.location = '';
   });
  
  });
		
    }]);



/* Setup Layout Part - Header */
crmUserApp.controller('HeaderController', ['$scope','$http','$location','$interval', function($scope,$http,$location,$interval) {
    $scope.$on('$includeContentLoaded', function() {
       
        Layout.initHeader();
		$scope.logout = function () {
		    $http.post("UserLogout").success(function(){
				window.location = '';
			});
        };
			
		$scope.change_password = function(pwd){
			$http.post("Main_Controller/change_password?pwd="+pwd).success(function(res){
				$('#pwdModal').modal('hide');
				$('#scModal').modal('show');
			});
		}	
			
		getMyProfileInfo();
		function getMyProfileInfo(){  
		    $http.post("getMyProfileInfo").success(function(myProfile){
		       $scope.myProfile = myProfile;
		    });
		};
		
		   
   $interval(function () { 
      var today = new Date();
	  var time = today.getHours() + ":" + today.getMinutes();
      $http.post("Main_Controller/get_todays_reminders").success(function(data){
		  if(data.length > 0){
			for(var i=0;i<data.length;i++){
				var rdate = new Date(data[i].rdate);
				console.log(time);
				console.log(data[i].rtime);
				if(time == data[i].rtime){
					show_notification(data);
				}
		    }
		  }
      });
   },4000);
   
    function show_notification(data){
		webNotification.showNotification(data.reminderTitle, {
                body: 'Client Name :'+data.client_name+'<br/>description :'+data.description,
                icon: 'my-icon.ico',
                onClick: function onNotificationClicked() {
                    console.log('Notification clicked.');
                },
                autoClose: 4000 //auto close the notification after 4 seconds (you can manually close it via hide function)
            }, function onShow(error, hide) {
                if (error) {
                    window.alert('Unable to show notification: ' + error.message);
                } else {
                    console.log('Notification Shown.');

                    setTimeout(function hideNotification() {
                        console.log('Hiding notification....');
                        hide(); //manually close the notification (you can skip this if you use the autoClose option)
                    }, 5000);
                }
            });
		
	}
		 
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
  
     $urlRouterProvider.otherwise("/dashboard");  
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
		
		.state('/view_leads', {
            url: "/view_leads/:leadid",
            templateUrl: "views/user/viewlead.html",            
            data: {pageTitle: 'User Leads'},
            controller: "viewleadcontroller",
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
                           'js/user/controllers/viewleadcontroller.js', 
                           '//code.jquery.com/ui/1.11.4/jquery-ui.js',
                           'assets/js/jquery.timepicker.min'   

                        ] 
                    });
                }]
            }
        })
		
		.state('/close_leads', {
            url: "/close_leads/:leadid",
            templateUrl: "views/user/closelead.html",            
            data: {pageTitle: 'user Leads'},
            controller: "viewleadcontroller",
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
                           'js/user/controllers/viewleadcontroller.js', 
                           '//code.jquery.com/ui/1.11.4/jquery-ui.js',
                           'assets/js/jquery.timepicker.min'   

                        ] 
                    });
                }]
            }
        })


.state('Add_Leads', {
            url: "/Add_Leads",
            templateUrl: "views/user/Add_leads.html",            
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
		
		.state('My_Calender', {
            url: "/My_Calender",
            templateUrl: "views/user/My_Calender.html",            
            data: {pageTitle: 'View Calender'},
            controller: "My_Calender",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'crmUserApp',
                        insertBefore: '#ng_load_plugins_before', 
                        files: [
                           'assets/ui-calendar-master/fullcalendar/fullcalendar.min.css',
						   'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
						   'assets/global/css/components.min.css',
						   'assets/global/css/plugins.min.css',
						   'assets/ui-calendar-master/demo/calendarDemo.css',
						   'assets/global/plugins/moment.min.js',
                           'assets/ui-calendar-master/fullcalendar/fullcalendar.min.js',
						   'assets/ui-calendar-master/fullcalendar/gcal.js',
                           'assets/global/plugins/jquery-ui/jquery-ui.min.js',
						   'assets/global/plugins/moment.min.js',
                           'assets/ui-calendar-master/src/calendar.js',
						   'assets/ui-calendar-master/demo/calendarDemo.js',
					
						   'assets/global/plugins/jquery-ui/jquery-ui.min.js',
						   'assets/global/scripts/app.min.js',
                           'js/user/controllers/My_Calender.js'  
                          
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
        
		.state('email', {
            url: "/email",
            templateUrl: "views/user/email.html",            
            data: {pageTitle: 'User Leads'},
            controller: "emailController",
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
                           'js/user/controllers/emailController.js', 
                           '//code.jquery.com/ui/1.11.4/jquery-ui.js',
                           'assets/js/jquery.timepicker.min'   

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

'use strict';
/* Directives */
crmUserApp.directive('pwCheck', [function () {
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
