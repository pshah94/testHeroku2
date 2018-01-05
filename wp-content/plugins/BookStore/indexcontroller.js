angular.module("myApp", []).controller("myCtrl", function($scope, $http) {

    $scope.enableShowPast = false;
    $scope.showForm = true;
    $scope.showPastRecords = false;
    $scope.showAdminForm = false;
    $scope.showAdminRecords = false;
    $scope.pastrecords;

    $scope.submit = function() {
        $http.post("/slim/api/bookstore_placeInquiry", $scope.inquiry).then(function(data) {
                alert(JSON.stringify(data.data));
            },
            function(err) {
                alert(JSON.stringify(err));
            });
    }

    $scope.checkMobile = function() {
        console.log($scope.enableShowPast);
        var mobileno = $scope.inquiry.MobileNumber + "";
        console.log(mobileno.length);
        if (mobileno != "" && mobileno.length == 10) {
            $scope.enableShowPast = true;
        } else {
            $scope.enableShowPast = false;
        }
        console.log($scope.enableShowPast);
    }
    $scope.history = function() {
        if (!$scope.enableShowPast) return;
        $scope.showPastRecords = true;
        $scope.showForm = !$scope.showPastRecords;
        $http.post("/slim/api/bookstore_getInquiry", $scope.inquiry.MobileNumber)
            .then(function(data) {
                    $scope.pastrecords = data.data;
                    $scope.noRecordsFound = !$scope.pastrecords.length > 0;
                    console.log("response" + JSON.stringify(data.data));
                },
                function(err) {
                    console.log(err);
                    alert("error" + JSON.stringify(err));
                });
    }

    $scope.login = function() {
        var username = 'admin',
            pwd = 'admin';
        if ($scope.uname == username && $scope.psw == pwd) {
            $scope.showAdminRecords = true;
            $scope.showAdminForm = !$scope.showAdminRecords;
            fetchRecordsForAdmin();
        } else {
            alert("Enter username and password again!!!!");
            $scope.uname = "";
            $scope.psw = "";
        }
    }
    fetchRecordsForAdmin = function() {
        $http.post("/slim/api/bookstore_getInquiry", '0')
            .then(function(data) {
                    $scope.adminRecords = data.data;
                    $scope.noRecordsFound = !$scope.adminRecords.length > 0;
                    console.log("response" + JSON.stringify(data.data));
                },
                function(err) {
                    console.log(err);
                    alert("error" + JSON.stringify(err));
                });
    }
    $scope.showFormAgain = function() {
        $scope.showPastRecords = false;
        $scope.showForm = !$scope.showPast;
    }

    $scope.viewAdimForm = function() {
        $scope.showAdminForm = true;
        $scope.showForm = !$scope.showAdminForm;
    }
    $scope.viewInquiryForm = function() {
        $scope.showAdminForm = false;
        $scope.showForm = !$scope.showAdminForm;
    }


    $scope.showAdminFormAgain = function() {
        $scope.showAdminForm = true;
        $scope.showAdminRecords = !$scope.showAdminForm;
    }

});