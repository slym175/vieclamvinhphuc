if (ngAppWrapper) {
    ngAppWrapper.factory('toaster', () => {
        return (header = "", body = "", type = 'default', callback = {
            beforeShow: () => {
            },
            afterShown: () => {
            },
            beforeHide: () => {
            },
            afterHidden: () => {
            },
        }) => {
            const toastType = {
                'default': 'black',
                'warning': 'red',
                'success': 'green',
                'error': 'red',
                'info': 'blue'
            }
            jQuery.toast({
                heading: header ? header : 'Notification!',
                text: body ? body : 'Something was happen!!',
                icon: type === 'default' ? '' : type,
                loader: true,
                loaderBg: toastType[type],
                hideAfter: 5000,
                showHideTransition: 'slide',
                allowToastClose: true,
                stack: 4,
                position: 'top-right',
                beforeShow: jQuery.isFunction(callback.beforeShow) ? callback.beforeShow : () => {
                },
                afterShown: jQuery.isFunction(callback.afterShown) ? callback.afterShown : () => {
                },
                beforeHide: jQuery.isFunction(callback.beforeHide) ? callback.beforeHide : () => {
                },
                afterHidden: jQuery.isFunction(callback.afterHidden) ? callback.afterHidden : () => {
                }
            })
        };
    });

    ngAppWrapper.factory('genSlug', (text = '', separator = '-') => {
        return (text = '', separator = '-') => {
            text = text.toLowerCase();

            text = text.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
            text = text.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
            text = text.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
            text = text.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
            text = text.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
            text = text.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
            text = text.replace(/(đ)/g, 'd');

            text = text.replace(/([^0-9a-z-\s])/g, '');
            text = text.replace(/(\s+)/g, separator);
            text = text.replace(/^-+/g, '');

            text = text.replace(/-+$/g, '');

            return text;
        }
    });

    ngAppWrapper.directive('appDeleteConfirm', function () {
        return {
            restrict: "A",
            scope: {
                "appDeleteConfirmed": "&",
                "appDeleteUnconfirmed": "&"
            },
            link: (scope, element, attrs) => {
                element.on('click', function () {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            scope.appDeleteConfirmed()
                        }
                        if (result.isDismissed) {
                            scope.appDeleteUnconfirmed()
                        }
                    })
                })
            }
        };
    });

    ngAppWrapper.directive("appSelect2", function ($timeout, $parse) {
        return {
            restrict: 'AC',
            require: 'ngModel',
            link: function (scope, element, attrs) {
                const modelAccessor = $parse(attrs.ngModel);

                $timeout(function () {
                    $(element).select2();
                });

                scope.$watch(modelAccessor, function (val) {
                    if (val) {
                        $(element).select2("val", val);
                    }
                });

                element.on('change', function () {
                    scope.$apply(function () {
                        model.$setViewValue(element.select2("val"));
                    });
                })
            }
        };
    });


    ngAppWrapper.directive('appLocationSelector', [function ($timeout, $parse) {
        return {
            restrict: "E",
            scope: {
                ngProvinceModel: '=',
                ngDistrictModel: '=',
                ngWardModel: '=',
            },
            link: function (scope, element, attrs) {
                init();

                function init() {
                    element.find('.select2').select2()
                }

                scope.provinces = [];
            },
            template: function (scope, element, attrs) {
                return `<div class="form-row row">
                        <div class="col-md-4">
                            <select class="form-control select2" app-select2 ng-model="scope.ngProvinceModel">
                                <option value="cheese">Cheese</option>
                                <option value="tomatoes">Tomatoes</option>
                                <option value="mozarella">Mozzarella</option>
                                <option value="mushrooms">Mushrooms</option>
                                <option value="pepperoni">Pepperoni</option>
                                <option value="onions">Onions</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control select2" app-select2 ng-model="scope.ngDistrictModel">
                                <option value="cheese">Cheese</option>
                                <option value="tomatoes">Tomatoes</option>
                                <option value="mozarella">Mozzarella</option>
                                <option value="mushrooms">Mushrooms</option>
                                <option value="pepperoni">Pepperoni</option>
                                <option value="onions">Onions</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control select2" app-select2 ng-model="scope.ngWardModel">
                                <option value="cheese">Cheese</option>
                                <option value="tomatoes">Tomatoes</option>
                                <option value="mozarella">Mozzarella</option>
                                <option value="mushrooms">Mushrooms</option>
                                <option value="pepperoni">Pepperoni</option>
                                <option value="onions">Onions</option>
                            </select>
                        </div>
                    </div>`;
            },
        }
    }]);
}
