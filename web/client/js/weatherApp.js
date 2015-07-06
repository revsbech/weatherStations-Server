var app = angular.module('weatherApp', []);
app.controller('weatherController', function($scope, $http) {
    $scope.weather = {'temperature': {'inside': 0.00}};

		// Fetch data from extenal datasource
	//$http.get("http://weather.dev/data.json").success(function(response) {
	$http.get("/api/latest").success(function(response) {
		$scope.currentTime = '4. july 2016 10:06';
		$scope.weather = response.selectedStation;
		$scope.availableStations = response.availableStations;
	});

});