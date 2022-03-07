require('./bootstrap');

if (ngAppWrapper) {
    ngAppWrapper.controller('ngAuthController', ["$scope", "$http", "AppGlobalData", "toaster", function ($scope, $http, AppGlobalData, toaster) {
        $scope.authData = {
            name: "",
            username: "",
            email: "",
            password: "",
            password_confirmation: "",
            remember: false,
            token: AppGlobalData.token
        };

        $scope.loading = false;

        $scope.authErrors = {
            name: false,
            username: false,
            email: false,
            password: false
        };

        $scope.authFunc = {
            changeInput: (field) => {
                $scope.authErrors[field] = false;
            },
            login: () => {
                $scope.loading = true;
                $http({
                    method: "POST",
                    url: AppGlobalData.API_URL+"/api/v1/login",
                    data: $scope.authData,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(function(response) {
                    if(response.data && (response.data.errors || response.data.code === 500)) {
                        for (const [key, value] of Object.entries(response.data.errors)) {
                            $scope.authErrors[key] = Array.isArray(value) && value.length ? value.shift() : value;
                        }
                    }
                    if(response.data && response.data.code === 200) {
                        localStorage.setItem('_access_token', response.data.token)
                        toaster('', response.data.message, 'success', {
                            afterHidden: () => {
                                window.location.href = response.data.redirect;
                            }
                        });
                    }
                    $scope.loading = false;
                }, function(response) {
                    console.log(response);
                    $scope.loading = false;
                });
            },
            register: () => {
                $scope.loading = true;
                $http({
                    method: "post",
                    url: AppGlobalData.API_URL+"/api/v1/register",
                    data: $scope.authData
                }).then(function(response) {
                    if(response.data && (response.data.errors || response.data.code === 500)) {
                        for (const [key, value] of Object.entries(response.data.errors)) {
                            $scope.authErrors[key] = Array.isArray(value) && value.length ? value.shift() : value;
                        }
                    }
                    if(response.data && response.data.code === 200) {
                        toaster('', response.data.message, 'success', {
                            afterHidden: () => {
                                window.location.href = response.data.redirect;
                            }
                        });
                    }
                    $scope.loading = false;
                }, function(response) {
                    console.log(response);
                    $scope.loading = false;
                });
            },
            forgotPassword: () => {
                console.log($scope.authData)
            },
            resetPassword: () => {
                console.log($scope.authData)
                console.log($scope.authData)
            }
        }
    }]);
}
