angular.module('crmApp').service('DashboardService', function() {
	this.getValue = getValue;
	
	function getValue(){
		var a ="service value"; 
		return a;
	}
});