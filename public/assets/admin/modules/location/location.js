if (ngAppWrapper) {
    ngAppWrapper.controller('appLocationController', ["$uibModal", "$scope", "$http", "AppGlobalData", "toaster", "genSlug", function ($uibModal, $scope, $http, AppGlobalData, toaster, genSlug) {
        $scope.location = {
            province: false,
            provinces: [],
            district: false,
            districts: [],
            districtsLoader: false,
            ward: false,
            wards: [],
            wardsLoader: false
        }

        let initLocation = () => {
            $scope.location.provinces = JSON.parse(provinces)
        }
        initLocation();

        $scope.locationModel = {
            parent_id: null,
            type: null
        }

        $scope.locationChecked = (event, child_type, model = '') => {
            $scope.location[model + "Loader"] = true;

            let par = 'province';
            switch (child_type) {
                case 'ward':
                    par = 'district'
                    break;
                case 'district':
                    $scope.location.district = false;
                    break;
                default:
            }

            $http({
                method: 'POST',
                url: AppGlobalData.API_URL + '/api/v1/location/get_locations',
                data: {
                    'parent_id': $scope.location[par],
                    'type': child_type
                },
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': AppGlobalData.token
                }
            }).then(function (response) {
                if (response?.data && response?.data?.code === 200) {
                    if (model !== '')
                        $scope.location[model] = response?.data?.data?.locations
                }
                $scope.location[model + "Loader"] = false;
            }, function (error) {
                console.error("Error!!");
                $scope.location[model + "Loader"] = false;
            });
        }

        $scope.deleteLocationConfirmed = (location_type = '', action = 'delete', key = false) => {
            $scope.openLocationModal(location_type, action, key);
        }

        $scope.openLocationModal = (location_type = '', action = 'create', key = false) => {
            if(action === 'delete') {
                $http({
                    method: 'POST',
                    url: AppGlobalData.API_URL + '/api/v1/location/store_location',
                    data: {
                        'location': Object.assign({
                            id: key && key.split("_").length > 0 ? key.split("_")[0] : false
                        }, $scope.locationModel),
                        'action': action
                    },
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': AppGlobalData.token
                    }
                }).then(function (response) {
                    if (response?.data && response?.data?.code === 200) {
                        $scope.location[location_type + 's'] = $scope.location[location_type + 's'].filter(locate => locate.key !== key)
                        toaster('', response.data.message, 'success', {});
                    }
                }, function (error) {
                    console.error("Error!!");
                });
                return;
            }

            if (location_type !== '') $scope.locationModel.type = location_type;
            if (location_type === 'district') $scope.locationModel.parent_id = $scope.location.province;
            if (location_type === 'ward') $scope.locationModel.parent_id = $scope.location.district;

            if (action === 'update' && key) {
                if (location_type === '') location_type = 'province';
                $scope.locationModel = $scope.location[location_type + "s"].filter(locate => locate.key === key)[0];
            }

            const modalInstance = $uibModal.open({
                animation: true,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                windowClass: 'show',
                backdropClass: 'show',
                template: `<div class="modal-header">
                        <h5 class="modal-title">Location Model</h5>
                        <button ng-click="$ctrl.modalCancel()" style="-webkit-transform: rotate(45deg);transform: rotate(45deg);" class="btn btn-icon close" type="button">
                            <i aria-hidden="true" class="ik ik-plus"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden">
                        <div class="form-group" ng-model="$ctrl.locationModel.id">
                            <label for="locationModelName">Location Name</label>
                            <input type="text" class="form-control" ng-model="$ctrl.locationModel.name" id="locationModelName" ng-change="$ctrl.generateCodename()" placeholder="Name">
                        </div>
                        <div class="form-group" ng-disabled="$ctrl.action === 'update'">
                            <label for="locationModelCode">Location Code</label>
                            <input ng-disabled="$ctrl.action === 'update'" type="number" min="1" max="9999999" ng-model="$ctrl.locationModel.code" class="form-control" id="locationModelCode" placeholder="Code">
                        </div>
                        <div class="form-group">
                            <label for="locationModelCodename">Location Codename</label>
                            <input type="text" class="form-control" ng-model="$ctrl.locationModel.codename" id="locationModelCodename" placeholder="Codename">
                        </div>
                        <div class="form-group">
                            <label for="locationModelDivisionType">Location Division Type</label>
                            <input type="text" ng-model="$ctrl.locationModel.division_type" class="form-control" id="locationModelDivisionType" placeholder="Division Type">
                        </div>
                        <div class="form-group">
                            <label for="locationModelCoordinate">Location Coordinate</label>
                            <div class="form-row row">
                                <div class="col-sm-6">
                                    <input type="text" ng-model="$ctrl.locationModel.latitude" class="form-control" id="locationModelLatitude" placeholder="Latitude">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" ng-model="$ctrl.locationModel.longitude" class="form-control" id="locationModelLongitude" placeholder="Longitude">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="locationModelZipcode">Location Zipcode</label>
                            <input type="text" ng-model="$ctrl.locationModel.zipcode" class="form-control" id="locationModelZipcode" placeholder="Zipcode">
                        </div>
                        <div class="form-group">
                            <label for="locationModelPhoneCode">Location Phone Code</label>
                            <input type="text" ng-model="$ctrl.locationModel.phone_code" class="form-control" id="locationModelPhoneCode" placeholder="Phone Code">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" ng-click="$ctrl.modalCancel()">Close</button>
                        <button type="button" class="btn btn-primary" ng-click="$ctrl.modalSave()">
                            <i class="ik ik-loader fa-spin" ng-if="$ctrl.loading"></i>
                            <% $ctrl.action == 'create' ? 'Create new' : 'Update' %>
                        </button>
                    </div>`,
                controller: function ($uibModalInstance, $http) {
                    let $ctrl = this;

                    $ctrl.action = action;
                    $ctrl.loading = false;
                    $ctrl.locationModel = Object.assign({
                        id: null,
                        name: null,
                        code: null,
                        codename: null,
                        division_type: null,
                        longitude: null,
                        latitude: null,
                        zipcode: null,
                        phone_code: null
                    }, $scope.locationModel);

                    $ctrl.modalCancel = function () {
                        $uibModalInstance.dismiss('cancel');
                    };

                    $ctrl.modalSave = function () {
                        $http({
                            method: 'POST',
                            url: AppGlobalData.API_URL + '/api/v1/location/store_location',
                            data: {
                                'location': $ctrl.locationModel,
                                'action': $ctrl.action
                            },
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': AppGlobalData.token
                            }
                        }).then(function (response) {
                            if (response?.data && response?.data?.code === 200) {
                                let type = response?.data?.data?.location?.type
                                let key = response?.data?.data?.location?.key
                                if (type) {
                                    if ($scope.location[type + 's'].filter(locate => locate.key === key).length <= 0)
                                        $scope.location[type + 's'].unshift(response?.data?.data?.location)
                                    else {
                                        let index = $scope.location[type + 's'].findIndex(locate => locate.key === key);
                                        if(index !== false && index !== undefined) {
                                            $scope.location[type + 's'][index] = response?.data?.data?.location
                                        }
                                    }
                                }
                                toaster('', response.data.message, 'success', {
                                    afterHidden: () => {
                                        $uibModalInstance.dismiss('cancel');
                                    }
                                });
                            }
                        }, function (error) {
                            console.error("Error!!");
                        });
                    };

                    $ctrl.generateCodename = function () {
                        $ctrl.locationModel.codename = genSlug($ctrl.locationModel.name, "_")
                    }
                },
                controllerAs: '$ctrl',
                size: 'lg'
            }).result.catch(function (resp) {
                if (['cancel', 'backdrop click', 'escape key press'].indexOf(resp) === -1) throw resp;
            });
        }
    }]);
}
