'use strict';

angular.module('crmApp').controller('ViewReportController', function($rootScope, $scope, $http, $timeout,$window) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();


	$scope.isDirectiveLoaded=true;
	getalleads();
	
//old report functions
		getallusers();
		getleads();
		get_completed_leads();
		get_callbklead_count();
		
		
function getallusers(){
			$http.post("Main_Controller/getUsers").success(function(user_data){
				$scope.user_data=user_data;
				$scope.myData=user_data;
	});
		
}

$scope.getall_leads=function(){
	getalleads();
}

	
		

		 $scope.filterOptions = {
            filterText: ''
        };
		
         $scope.gridOptions ={data:'myData',
			                showGroupPanel: true,
				
			                columnDefs: [
                            {field: 'firstName', displayName:'firstName' },
                            {field:'lastName', displayName:'lastName' },
							{field:'registerdate', displayName:'Reg.Date',cellFilter: "date:'yyyy-MM-dd'"  },],
                            filterOptions: $scope.filterOptions
		      };
	
		
	
		
	function getleads(){
			$http.post("Main_Controller/getLeads").success(function(data){
				$scope.data = data;
				$scope.total_leads = $scope.data.length;
				$scope.myData = data;
			
			});
		}
		
		function get_completed_leads(){
			$http.post("Report_Controller/get_ComLeads").success(function(data1){
				$scope.data1 = data1;
				$scope.completed_leads = $scope.data1.length;
				
			});
		}
		
		function get_callbklead_count(){
			$http.post("Report_Controller/get_callbkLeads").success(function(data2){
				$scope.data2 = data2;
				$scope.callbk_lead_count = $scope.data2.length;
				
			});
		}
		
	
	 
	 $scope.get_firstcall_leads=function(selected_user){
		
	    $http.post("Report_Controller/get_firstcall_leads?u_id="+selected_user.userid).success(function(firstcall_leads){
				$scope.firstcall_leads=firstcall_leads;
				console.log($scope.firstcall_leads);
				 $scope.all_leads=true;
		         $scope.firstcall_leads_show=true;
				 $scope.followup_leads_show=false; 
			});
     }
	 
	 
	 $scope.get_followup_leads=function(selected_user){
		console.log(selected_user.userid);
	    $http.post("Report_Controller/get_followup_leads?u_id="+selected_user.userid).success(function(followup_leads){
				$scope.followup_leads=followup_leads;
				 console.log($scope.followup_leads);
				 $scope.all_leads=true;
		         $scope.followup_leads_show=false; 
			});
     }
	 
	 $scope.get_all_leads=function(selected_user){
		$scope.changedValue(selected_user);
			  $scope.all_leads=false;
		     $scope.firstcall_leads_show=false;
		     $scope.followup_leads_show=false; 
		
	 }
	 
     $scope.changedValue=function(selected_user){
      
	    $http.post("Report_Controller/get_firstcall_leads?u_id="+selected_user.userid).success(function(firstcall_leads1){
		   $scope.firstcall_leads1=firstcall_leads1;
		   $scope.firstcall_leads_count = $scope.firstcall_leads1.length;
		    
	   });
	   
	    $http.post("Report_Controller/get_followup_leads?u_id="+selected_user.userid).success(function(followup_leads1){
		   $scope.followup_leads1=followup_leads1;
		   $scope.followup_leads_count = $scope.followup_leads1.length;
		     
	   });
	       
	   $http.post("Report_Controller/get_selecteduser_leads?u_id="+selected_user.userid).success(function(selected_user_leads){
		   $scope.selected_user_all_leads=selected_user_leads;
		   $scope.alllead_count = $scope.selected_user_all_leads.length;
		     $scope.all_leads=false;
		     $scope.firstcall_leads_show=false;
		     $scope.followup_leads_show=false;  
	   });
	     
		  
	  
	   
    }    
	
//End old report Functions

$scope.uncheck = function (event) {
    if ($scope.checked == event.target.value)
        $scope.checked = false
}

 $scope.filter_data=function(sel_user){
		  $http.post("Report_Controller/get_selecteduser_data?u_id="+sel_user.userid).success(function(selected_user_data){
			  console.log(selected_user_data);
		     $scope.grid_data=selected_user_data;
			 
	 });
		
}
		
//start new report functions
 $scope.filterby_status=function(){
	 console.log($scope.sel_status);
	 $http.post("Report_Controller/getleadsby_status?user="+$scope.sel_user.userid+"&status="+$scope.sel_status).success(function(data){
		 console.log(data);
		 $scope.grid_data=data;
	 });
 }
 
function getalleads(){
	$http.post("Report_Controller/getallleads").success(function(user_lead_data){
				$scope.user_lead_data=user_lead_data;
				$scope.grid_data=user_lead_data;
				console.log($scope.grid_data);
	});
		
}

 $scope.submitAnswer=function(user){
    
    alert(user.answer);
    
  }
	
   $scope.get_monthly_leads=function(sel_user,sel_status){
	  
	   $http.post("Report_Controller/get_last_month_leads?u_id="+sel_user.userid+"&status="+sel_status).success(function(lastmonth_leads){
			$scope.lastmonth_leads=lastmonth_leads;
			$scope.grid_data=lastmonth_leads;
		});
   }
   
   
    $scope.get_weekly_leads=function(sel_user,sel_status){
	  
	   $http.post("Report_Controller/get_last_week_leads?u_id="+sel_user.userid+"&status="+sel_status).success(function(lastweek_leads){
			$scope.lastweek_leads=lastweek_leads;
			$scope.grid_data=lastweek_leads;
			//console.log($scope.lastweek_leads);
		});
   }
   
   
  
   $scope.get_daily_leads=function(sel_user,sel_status){
	 
	  $document.getElementById('example1').show();
	  
   }
	
	$scope.filter_daily_data=function(sel_user,sel_status,sel_date){
		//console.log(sel_status,sel_date);
		$http.post("Report_Controller/get_leads_bydate?u_id="+sel_user.userid+"&status="+sel_status+"&sel_date="+sel_date).success(function(filterd_leads_bydate){
			$scope.filterd_leads_bydate=filterd_leads_bydate;
			//console.log($scope.filterd_leads_bydate);
			$scope.grid_data=filterd_leads_bydate;
		});
	}
	
	$scope.filterby_daterange=function(sel_user,sel_status,sel_date1,sel_date2){
		
		$http.post("Report_Controller/get_leads?u_id="+sel_user.userid+"&status="+sel_status+"&sel_date1="+sel_date1+"&sel_date2="+sel_date2).success(function(filterd_leads){
			$scope.filterd_leads=filterd_leads;
			//console.log($scope.filterd_leads);
			$scope.grid_data=filterd_leads;
		});
	}
	
	$scope.grid_report ={data:'grid_data',
	  //showGroupPanel: true,
	  columnDefs: [
         {field: 'clientName', displayName:'clientName' },
         {field:'email', displayName:'email' },
		 {field:'status', displayName:'status'},
		 {field:'clientType', displayName:'clientType'},
		 {displayName: 'View', cellTemplate: 
             '<div class="grid-action-cell">'+
             '<a class="btn default-btn btn-success" ng-click="$event.stopPropagation(); view_lead(row.entity);" href="#">View</a></div>'},
		 ],
		 
	 // plugins: [new ngGridCsvExportPlugin()],
     
   
  };
  
   $scope.view_lead=function(e){
				   $window.location.href = '#/Show_Lead/'+e.leadid;
			  }
  
  
	$scope.JSONToCSVConvertor=function(grid_data,sel_user,sel_status,user){
		
		
		if(user==2){
			var duration = 'Monthly Report';
		}else if(user==1){
			var duration = 'Weekly Report';
		}else if(user==3){
			var duration = 'Date';
		}else if(user==4){
			var duration = 'Report Between Dates';
		}
		
		 var arrData = typeof grid_data != 'object' ? JSON.parse(grid_data) : grid_data;
		 
		 console.log(arrData);
		 
		/*  $arrData = $arrData.clone();
        $arrData.find("td:nth-child(2)").remove();
		  */
		 
    
      var CSV = ''; 

    if($("#suser").val() != "" && $("#sstatus").val() != ""){
		
 	  if(user==3){
		  CSV += '\r'+duration+':'+$scope.sel_date+'\r\n';
	   }else if(user==4){
		  CSV += '\r'+duration+':'+$scope.sel_date1+','+$scope.sel_date2+ '\r\n';
	  }else{
		 CSV += '\r'+duration+'\r\n';
	  }
	 CSV += 'user : '+sel_user.firstName + 'status :'+sel_status+'\r\n\n'
   }
   else{
	   CSV +='All Leads\r\n\n';
   }
  
        var row = "";
        for (var index in arrData[0]) {
	        if(index=='userid'){
				
			}else{
				 row += index + ',';
			}
           console.log(row);
        }
        row = row.slice(0, -1);
        CSV += row + '\r\n';

    for (var i = 0; i < arrData.length; i++) {
        var row = "";
         for (var index in arrData[i]) {
			 if(index=='userid'){
				 
			 }else{
				  row += '"' + arrData[i][index] + '",';
			 console.log(row);
			 }
           
        }

        row.slice(0, row.length - 1);
        
        //add a line break after each row
        CSV += row + '\r\n';
    }
   
    if (grid_data == '') {        
        alert("Invalid data");
        return;
    }   
    
    var fileName = "MyReport";
	
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    
    var link = document.createElement("a");    
    link.href = uri;
    
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
	}
	
	
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});