angular.module('crmApp').service('ToDoService', function() {
	this.getValue = getValue;
	
	function getValue(){
		var a ="service value"; 
		return a;
	}
});