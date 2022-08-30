<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="app.js"></script>
</head>
	<body ng-app="myApp" ng-controller="myCtrl">
    <div class="file-upload">
        <input type="text" ng-model="name">
        <input type="file" file-model="myFile"/>
        <button ng-click="uploadFile()">upload me</button>
    </div>
</body>
</html>