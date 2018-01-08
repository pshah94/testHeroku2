angular.module("myApp", []).controller("myCtrl", function($scope, $http) {

    $scope.enableShowPast = false;
    $scope.showForm = true;
    $scope.showPastRecords = false;
    $scope.showAdminForm = false;
    $scope.showAdminRecords = false;
    $scope.pastrecords;
    $scope.adminRecords = {};

    $scope.inquiry = {
        'MobileNumber': "",
        'BookName': "",
        'AutherName': "",
        'Date': "",
        'message': ""
    }
    var resetFields = $scope.inquiry;

    $scope.submit = function() {

        if (($scope.inquiry.MobileNumber + "").length == 10 && $scope.inquiry.BookName.trim() != "") {
            $http.post("/slim/api/bookstore_placeInquiry", $scope.inquiry).then(function(data) {
                    alert(data.data);
                },
                function(err) {
                    alert("Error : " + JSON.stringify(err));
                });
        } else {
            alert("Mobile Number and BookName required");
        }


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
                    for (var i = 0; i < $scope.pastrecords.length; i++) {
                        $scope.pastrecords[i].formatedDate = $scope.pastrecords[i].requesteddate.length > 0 ? new Date($scope.pastrecords[i].requesteddate) : "";
                    }
                    console.log("response" + JSON.stringify(data.data));
                },
                function(err) {
                    console.log(err);
                    alert("error" + JSON.stringify(err));
                });
    }

    $scope.login = function() {
        var username = 'admin',
            pwd = 'admin123';
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
                    $scope.adminRecordsList = data.data;

                    $scope.noRecordsFound = !$scope.adminRecordsList.length > 0;
                    console.log("response" + JSON.stringify(data.data));

                    for (var i = 0; i < $scope.adminRecordsList.length; i++) {
                        var id = $scope.adminRecordsList[i].id;
                        $scope.adminRecords[id] = $scope.adminRecordsList[i];
                        $scope.adminRecords[id].formatedDate = $scope.adminRecordsList[i].requesteddate.length > 0 ? new Date($scope.adminRecordsList[i].requesteddate) : "";
                        $scope.adminRecords[id].allowResponse = $scope.adminRecordsList[i].response == null;
                    }
                },
                function(err) {
                    console.log(err);
                    alert("error" + JSON.stringify(err));
                });
    }

    $scope.sendResponse = function(id) {
        console.log($scope.adminRecords[id]);
        if ($scope.adminRecords[id].allowResponse) {
            var data = { 'id': "", 'response': "" };
            data.id = id;
            data.response = $scope.adminRecords[id].response;
            $http.post("/slim/api/bookstore_inquiryResponse", data).then(function(data) {
                    alert(data.data);
                    console.log(data.data);
                    $scope.adminRecords[id].allowResponse = false;
                },
                function(err) {
                    alert("Error : " + JSON.stringify(err));
                });


        }

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