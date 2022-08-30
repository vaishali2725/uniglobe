angular.module('crmUserApp').controller('My_Calender', function($rootScope, $scope, $http, $timeout,$compile,uiCalendarConfig) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
      
	   
	    var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
		
		
	
	get_reminders();
	
  /*  $scope.events = [
        {
            title: 'Event1',
            start: '2016-05-19',
			description:'email'
			
        },
        {
            title: 'Event2',
            start: '2016-05-20',
			description:'call'
			
        }
    ];  */
        $scope.events = [
          
	  ]; 

		function get_reminders(callback){
			$http.post("Main_Controller/getreminders").success(function(eventSource){
		    for(var i=0;i<eventSource.length;i++){
			// //eventSource[i].reminderDate = ($scope.eventSource[i].reminderDate, "Y-m-d");
           var leadid=eventSource[i].leadid;
		   $scope.events.push({
				
                 title: eventSource[i].client_name,
				 start: new Date(eventSource[i].reminderDate),
				 url:'index.php#/view_leads/'+leadid,
                });
	       }
		   
		   $scope.eventSources = [];
		  $scope.eventSources = [$scope.events];


		});
			
		}
		
		
		
	
   
		 
     /* event source that calls a function on every view switch */
     $scope.eventsF = function (start, end, timezone, callback) {
      var s = new Date(start).getTime() / 1000;
      var e = new Date(end).getTime() / 1000;
      var m = new Date(start).getMonth();
      var events = [{title: 'Feed Me ' + m,start: s + (50000),end: s + (100000),allDay: false,className: ['customFeed']}];
      callback(events);
    }; 

	
  
	
    /* alert on eventClick */
    $scope.alertOnEventClick = function( date, jsEvent, view){
        $scope.alertMessage = (date.title + ' was clicked ');
    };
	
	
    /* alert on Drop */
     $scope.alertOnDrop = function(event, delta, revertFunc, jsEvent, ui, view){
       $scope.alertMessage = ('Event Droped to make dayDelta ' + delta);
    };
	
	
    /* alert on Resize */
    $scope.alertOnResize = function(event, delta, revertFunc, jsEvent, ui, view ){
       $scope.alertMessage = ('Event Resized to make dayDelta ' + delta);
    };
	
	
    /* add and removes an event source of choice */
    $scope.addRemoveEventSource = function(sources,source) {
      var canAdd = 0;
      angular.forEach(sources,function(value, key){
        if(sources[key] === source){
          sources.splice(key,1);
          canAdd = 1;
        }
      });
      if(canAdd === 0){
        sources.push(source);
      }
    };
	
	
    /* add custom event*/
    $scope.addEvent = function() {
		
      $scope.events.push({
        title: 'Open Sesame',
        start: new Date(y, m, 28),
        end: new Date(y, m, 29),
        className: ['openSesame']
      });
    };
	
	
    /* remove event */
    $scope.remove = function(index) {
      $scope.events.splice(index,1);
    };
	
	
    /* Change View */
    $scope.changeView = function(view,calendar) {
      uiCalendarConfig.calendars[calendar].fullCalendar('changeView',view);
    };
	
	
    /* Change View */
    $scope.renderCalender = function(calendar) {
      if(uiCalendarConfig.calendars[calendar]){
        uiCalendarConfig.calendars[calendar].fullCalendar('render');
      }
    };
	
	
     /* Render Tooltip */
    $scope.eventRender = function( event, element, view ) { 
	   
        element.attr({'tooltip': event.title,
                     'tooltip-append-to-body': true});
					 
		

    };
    /* config object */
    $scope.uiConfig = {
      calendar:{
        height: 450,
        editable: true,
        header:{
          left: 'title',
          center: '',
          right: 'today prev,next'
        },
		defaultView: 'basicWeek',
		/* selectable: true,
		selectHelper: true,
		
		 dayClick: function(date, jsEvent, view) { 
              var eventdate = date.format();  
                
				var title = prompt('Enter Client Name:');
				var eventData;
				 var now = new moment();
                 var ctime = now.format("HH:mm:ss")
				if (title) {
					eventData = {
						title: title,
						start: eventdate,
						time :ctime
					};
					$http.post("new_Controller/add_reminder?title="+title+"&s_date="+eventdate+"&ctime="+ctime);
					$('.calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('.calendar').fullCalendar('unselect');
				

			 },*/
			editable: true,
			eventLimit: true, 
        eventClick: $scope.alertOnEventClick,
        eventDrop: $scope.alertOnDrop,
        eventResize: $scope.alertOnResize,
        eventRender: $scope.eventRender
      }
    };

    $scope.changeLang = function() {
      if($scope.changeTo === 'Hungarian'){
        $scope.uiConfig.calendar.dayNames = ["Vasárnap", "Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat"];
        $scope.uiConfig.calendar.dayNamesShort = ["Vas", "Hét", "Kedd", "Sze", "Csüt", "Pén", "Szo"];
        $scope.changeTo= 'English';
      } else {
        $scope.uiConfig.calendar.dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        $scope.uiConfig.calendar.dayNamesShort = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        $scope.changeTo = 'Hungarian';
      }
    };
    /* event sources array*/
  
	     
    

   
  
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});
