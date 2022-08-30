angular.module('crmApp').controller('uploadcsvController', function($rootScope,$scope, $http, $timeout) {
    $scope.$on('$viewContentLoaded', function() {   
        // initialize core components
        App.initAjax();
		
	
	  
	  $scope.upload_csvdata1=function(){
		  var leadfield=["clientName","email","altemail","phone","altphone","city","country","status","source","accountNumber","accountNumber"];
		 
		 //$scope.userid=$scope.csvcolumn1;
		 $scope.clientName=$scope.csvcolumn2;
		 $scope.email=$scope.csvcolumn3;
		 $scope.altemail=$scope.csvcolumn4;
		 $scope.phone=$scope.csvcolumn5;
		 $scope.altphone=$scope.csvcolumn6;
		 $scope.city=$scope.csvcolumn7;
		 $scope.country=$scope.csvcolumn8;
		 $scope.status1=$scope.csvcolumn9;
		 $scope.source=$scope.csvcolumn10;
		 $scope.accountNumber=$scope.csvcolumn11;
		 $scope.clientType=$scope.csvcolumn12;
		 
		// var c_userid = [];
		 var c_clientName = [];
		 var c_email = [];
		 var c_altemail = [];
		 var c_phone = [];
	     var c_altphone = [];
		 var c_city = [];
	     var c_country = [];
		 var c_status1 = [];
		 var c_source = [];
		 var c_accountNumber = [];
		 var c_clientType = [];
		 
		/*  for(var i=0;i<$scope.result.length-1;i++){

		   /* $http.post("Main_Controller/get_userid?name="+$scope.result[i][$scope.userid]).success(function){
			   
		   }); 
			   c_userid.push($scope.result[i][$scope.userid]);
		 }  */
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_clientName.push($scope.result[i][$scope.clientName]);
		 }
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_email.push($scope.result[i][$scope.email]);
		 }
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_altemail.push($scope.result[i][$scope.altemail]);
		 }
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_phone.push($scope.result[i][$scope.phone]);
		 }
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_altphone.push($scope.result[i][$scope.altphone]);
		 }
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_city.push($scope.result[i][$scope.city]);
		 }
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_country.push($scope.result[i][$scope.country]);
		 }
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_status1.push($scope.result[i][$scope.status1]);
		 }
		 
		 for(var i=0;i<$scope.result.length-1;i++){
			 c_source.push($scope.result[i][$scope.source]);
		 }
		  
		  for(var i=0;i<$scope.result.length-1;i++){
			 c_accountNumber.push($scope.result[i][$scope.accountNumber]);
		 }
		  
		  for(var i=0;i<$scope.result.length-1;i++){
			 c_clientType.push($scope.result[i][$scope.clientType]);
		 }
		 
		 
		 var myColumnDefs = new Array();
   
         for (var i = 0; i <$scope.result.length-1; i++) {
             myColumnDefs.push({ //userid:c_userid[i],
			                    clientName:c_clientName[i],
								email:c_email[i],
								altemail:c_altemail[i],
								phone:c_phone[i],
								altphone:c_altphone[i],
								city:c_city[i],
								country:c_country[i],
								status:c_status1[i],
								source:c_source[i],
								accountNumber:c_accountNumber[i],
								clientType:c_clientType[i]
							});
         }
		 		// console.log(myColumnDefs);
         uplaod_data(myColumnDefs); 		 

	  }
	  
	  function uplaod_data(myColumnDefs){
		//console.log(myColumnDefs);
        $http.post("Main_Controller/insert_csv_data?newdata="+JSON.stringify(myColumnDefs)).success(function(data){
			//console.log(data);
            if(data>0){
				alert(data+" "+"records already existed");
			}else{
				alert("data uploaded succcessfully");
			}
		   document.csvuploadform1.reset();
	      });
	  }
	 
});

    $rootScope.settings.layout.pageContentWhite = true;
    $rootScope.settings.layout.pageBodySolid = false;
    $rootScope.settings.layout.pageSidebarClosed = false;
});


crmApp.directive('fileReader', function($http,$rootScope) {

 return {

    scope: {
      fileReader:"="
	 
    },
	
    link: function(scope, element) {
      $(element).on('change', function(changeEvent) {
        var files = changeEvent.target.files;
        if (files.length) {
          var r = new FileReader();
          r.onload = function(e) {
              var contents = e.target.result;
              scope.$apply(function(){
				   scope.fileReader = contents;
				   //console.log(scope.fileReader);
				   csvJSON(scope.fileReader);
			  });
			 
          };
          
        r.readAsText(files[0]);
        }
      });
    }
  };
  
  
  function csvJSON(csv){

  var lines=csv.split("\n");

  var result = [];

  var headers=lines[0].split(",");
  
  $rootScope.cvsHeaders=headers;
 
  for(var i=1;i<lines.length;i++){

	  var obj = {};
	  var currentline=lines[i].split(",");

	  for(var j=0;j<headers.length;j++){
		  obj[headers[j]] = currentline[j];
		  
	  }

	  result.push(obj);
   
  }
    $rootScope.result=result;
	
 //console.log($rootScope.result);
  /*  $http.post("Main_Controller/insert_csv_data?data="+JSON.stringify(result)).then(function(){
	// alert('success');
  });  */
  return JSON.stringify(result);
}  
  
});


