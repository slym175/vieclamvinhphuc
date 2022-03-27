@extends('admin.layouts.app')
@section('title', 'Location')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-header-title">
                        <i class="ik ik-layers bg-blue"></i>
                        <div class="d-inline">
                            <h5>Location</h5>
                            <span>{{ Breadcrumbs::render('admin.location') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <app-location-selector></app-location-selector>
        </div>
        <div class="row clearfix" ng-controller="appLocationController">
            <div class="col-md-4">
                @if($provinces && $provinces->count())
                    <script>
                        const provinces = '{!! json_encode($provinces) !!}';
                    </script>
                    <div class="card province_card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="card-header-title fw-bold">
                                    <i class="ik ik-aperture me-2"></i>
                                    <span>Tỉnh/thành phố</span>
                                </div>
                                <div class="card-header-action">
                                    <button class="btn btn-primary" ng-click="openLocationModal('province')">Thêm mới</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body perfect-scrollbar">
                            <table id="advanced_table" class="table mb-0">
                                    <tr ng-repeat="province in location.provinces track by province.key" data-key="'<% province.key %>'">
                                        <td class="d-flex justify-content-between align-items-center w-100">
                                            <label
                                                class="custom-control custom-checkbox d-flex justify-content-start align-items-center">
                                                <input type="checkbox" class="custom-control-input select_all_child"
                                                       id="province_checkbox_<% province.key %>" ng-true-value="'<% province.key %>'"
                                                       ng-false-value="'false'" ng-change="locationChecked($event, 'district', 'districts')" ng-model="location.province">
                                                <span class="ms-3"><% province.name %></span>
                                            </label>
                                            <div class="list-actions">
                                                <a ng-click="openLocationModal('province', 'update', province.key)" class="btn btn-icon btn-info"><i
                                                        class="ik ik-edit-2"></i></a>
                                                <a app-delete-confirm app-delete-confirmed="deleteLocationConfirmed('province', 'delete', province.key)" class="btn btn-icon btn-danger"><i
                                                        class="ik ik-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card district_card" ng-show="location.province">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="card-header-title fw-bold">
                                <i class="ik ik-aperture me-2"></i>
                                <span>Quận/huyện</span>
                            </div>
                            <div class="card-header-action">
                                <button class="btn btn-primary" ng-click="openLocationModal('district')">Thêm mới</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div ng-if="location.districtsLoader" class="text-center">
                            <div class="spinner-border"></div>
                        </div>
                        <table ng-if="!location.districtsLoader" id="advanced_table" class="table mb-0">
                            <tr ng-repeat="district in location.districts track by district.key" data-key="'<% district.key %>'">
                                <td class="d-flex justify-content-between align-items-center w-100">
                                    <label
                                        class="custom-control custom-checkbox d-flex justify-content-start align-items-center">
                                        <input type="checkbox" class="custom-control-input select_all_child"
                                               id="district_checkbox_<% district.key %>" ng-true-value="'<% district.key %>'"
                                               ng-false-value="'false'" ng-change="locationChecked($event, 'ward', 'wards')" ng-model="location.district">
                                        <span class="ms-3"><% district.name %></span>
                                    </label>
                                    <div class="list-actions">
                                        <a ng-click="openLocationModal('district', 'update', district.key)" class="btn btn-icon btn-info"><i
                                                class="ik ik-edit-2"></i></a>
                                        <a ng-click="openLocationModal('district', 'delete', district.key)" class="btn btn-icon btn-danger"><i
                                                class="ik ik-trash-2"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ward_card" ng-show="location.district">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div class="card-header-title fw-bold">
                                <i class="ik ik-aperture me-2"></i>
                                <span>Xã/phường/thị trấn</span>
                            </div>
                            <div class="card-header-action">
                                <button class="btn btn-primary" ng-click="openLocationModal('ward')">Thêm mới</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div ng-if="location.wardsLoader" class="text-center">
                            <div class="spinner-border"></div>
                        </div>
                        <table ng-if="!location.wardsLoader" id="advanced_table" class="table mb-0">
                            <tr ng-repeat="ward in location.wards track by ward.key" data-key="'<% ward.key %>'">
                                <td class="d-flex justify-content-between align-items-center w-100">
                                    <label
                                        class="custom-control custom-checkbox d-flex justify-content-start align-items-center">
                                        <span class="ms-3"><% ward.name %></span>
                                    </label>
                                    <div class="list-actions">
                                        <a ng-click="openLocationModal('ward', 'update', ward.key)" class="btn btn-icon btn-info"><i
                                                class="ik ik-edit-2"></i></a>
                                        <a ng-click="openLocationModal('ward', 'delete', ward.key)" class="btn btn-icon btn-danger"><i
                                                class="ik ik-trash-2"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css') @endpush
@push('js')
    <script src="{{ asset('assets/admin/modules/location/location.js') }}"></script>
@endpush
