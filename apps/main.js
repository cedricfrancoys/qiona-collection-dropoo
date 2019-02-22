'use strict';


// Instanciate resiway module
var project = angular.module('project', [
    // dependencies
    'ngCookies',
    'ui.bootstrap',
    'oi.select',
    'ngFileUpload',
    'ngToast'
])


/**
* Set HTTP POST format to URLENCODED (instead of JSON)
*
*/
.config([
    '$httpProvider', 
    '$httpParamSerializerJQLikeProvider', 
    function($httpProvider, $httpParamSerializerJQLikeProvider) {
        // Use x-www-form-urlencoded Content-Type
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';    
        $httpProvider.defaults.paramSerializer = '$httpParamSerializerJQLike';    
        $httpProvider.defaults.transformRequest.unshift($httpParamSerializerJQLikeProvider.$get());
    }
])

/**
* Enable HTML5 mode
*
*/
.config([
    '$locationProvider', 
    function($locationProvider) {
        // ensure we're in Hashbang mode
        $locationProvider.html5Mode({enabled: true, requireBase: true, rewriteLinks: true}).hashPrefix('!');
    }
])

.factory('httpRequestInterceptor', [
    '$cookies',    
    function ($cookies) {
        return {
            request: function (config) {
                config.headers['Authorization'] = 'Bearer ' + $cookies.get('access_token');
                return config;
            }
        };
    }
])

.config(['$httpProvider', function ($httpProvider) {
  $httpProvider.interceptors.push('httpRequestInterceptor');
}])

.run( [
    '$window', 
    '$timeout', 
    '$rootScope', 
    '$location',
    '$cookies',
    '$http',
    function($window, $timeout, $rootScope, $location, $cookies, $http) {
        console.log('run method invoked');
        
        // @init
        
        // flag indicating that some content is being loaded
        $rootScope.viewContentLoading = true;   

      

        // @events

        // This is triggered afeter loading, when DOM has been processed
        angular.element(document).ready(function () {
            console.log('dom ready');
            
            if(!$rootScope.$$phase) {
                $rootScope.$apply(function() {
                    $rootScope.viewContentLoading = false;
                });
            }
        });
        
        // when requesting another location (user click some link)
        $rootScope.$on('$locationChangeStart', function(angularEvent) {
            // mark content as being loaded (show loading spinner)
            $rootScope.viewContentLoading = true;
        });


        /**
        * This callback is invoked at each change of view
        * it is used to complete any pending action
        */
        $rootScope.$on('$viewContentLoaded', function(params) {
            console.log('$viewContentLoaded received');
            // hide loading spinner
            $rootScope.viewContentLoading = false;
        });
        
        
        $http({
            method: 'GET',
            url: '/index.php?get=me'
        })
        .then(
            function success(json) {
                console.log(json);
                $rootScope.currentUser = json.data;
            },
            function error(result) {
                console.log(result);
            }
        );        
    }
])

/**
*
* we take advantage of the rootController to define globaly accessible utility methods
*/
.controller('rootController', [
    '$rootScope', 
    '$scope',
    '$location',
    '$http',
    '$timeout',
    '$cookies',
    '$q',
    'Upload',
    '$uibModal',
    'ngToast',
    function($rootScope, $scope, $location, $http, $timeout, $cookies, $q, Upload, $uibModal, ngToast) {
        console.log('root controller');

        var rootCtrl = this;       
        
        $scope.isUploading = false;  
        
        $scope.conf = {
            total_items:  -1,
            items_batch: 7,
            current_page: 1,
            items: []
        };

        // @handlers        
        $scope.openLogin = function () {

            var modalInstance = $uibModal.open({
                animation: true,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                templateUrl: 'loginModal.html',
                controllerAs: 'ctrl',
                controller: function($scope) {
                    var ctrl = this;
                    $scope.errors = [];
                    $scope.result = '';
                    
                    ctrl.login = function() {
                        $scope.errors = [];
                        if(!$scope.form_login.login.$valid) {
                            $scope.errors.push('expected login as valid email');
                        }
                        if(!$scope.form_login.password.$valid) {
                            $scope.errors.push('password is mandatory');
                        }
                        if($scope.errors.length) return;
                        $http({
                            method: 'GET',
                            url: '/index.php?do=qinoa_user_login',
                            params: {
                                login:  $scope.login,
                                password: md5($scope.password)
                            }
                        })
                        .then(
                            function success(json) {
                                var now = new Date();
                                var exp = new Date(now.getFullYear()+1, now.getMonth(), now.getDate());
                                
                                $rootScope.currentUser = json.data;                                
                                $cookies.put('access_token', json.data['access_token'], {expires: exp});                                
                                
                                console.log(json);
                                $scope.result = 'successfull logon';
                                ngToast.success({
                                  content: '<b>auth</b>: welcome '+json.data['firstname']+' '+json.data['lastname'],
                                  dismissButton:true
                                });							
								
                                $timeout(function() {
                                    modalInstance.close();
									rootCtrl.pageChanged();									
                                }, 500);
                                
                            },
                            function error(result) {
                                console.log(result);
                                $scope.result = 'Invalid credentials';
                                $timeout(function() {
                                    $scope.result = '';
                                }, 1000);
                                ngToast.danger({
                                  content: '<b>error</b>: could not authenticate',
                                  dismissButton:true
                                });
                            }
                        );                        
                        
                    };
                    
					ctrl.logout = function() {
						$cookies.remove('access_token');
						ngToast.success({
						  content: '<b>auth</b>: sucessfully logged out',
						  dismissButton:true
						});
						$timeout(function() {
							modalInstance.dismiss('cancel'); 
							$rootScope.currentUser = null;							
							rootCtrl.pageChanged();
						}, 100);
					};
					
                    ctrl.cancel = function() {
                        modalInstance.dismiss('cancel');                        
                    };
                    
                },
                size: 'sm',
                appendTo: angular.element(document.querySelector('.modal-wrapper')),
            });
        }
    
        rootCtrl.pageChanged = function () {
			// reset listing
			$scope.conf.total_items =  -1;
			$scope.conf.items = [];
			$scope.conf.current_page = 1;
			
            $http({
                method: 'GET',
                url: '/index.php?get=qinoa_model_collection',
                params: {
                    entity: 'dropoo\\Document',
                    fields: ['id', 'name', 'size', 'content_type', 'hash'],
                    start:  ($scope.conf.current_page-1)*$scope.conf.items_batch,
                    limit: $scope.conf.items_batch
                }
            })
            .then(
                function success(json) {
                    console.log(json);
                    console.log(json.headers());
                    var headers = json.headers()
                    $scope.conf.total_items = headers['x-total-count'];
                    $scope.conf.items = json.data;
                },
                function error(result) {
                    console.log(result);
                }
            );
        }
        
        $scope.deleteFile = function(id) {
            $http({
                method: 'GET',
                url: '/index.php?do=qinoa_model_delete',
                params: {
                    entity: 'dropoo\\Document',
                    id: id,
                    permanent:  true
                }
            })
            .then(
                function success(json) {
                    console.log(json);
                    console.log(json.headers());
                    ngToast.success({
                      content: '<b>deleted</b> one item',
                      dismissButton:true
                    });                    
                    rootCtrl.pageChanged();                    
                },
                function error(result) {
                    console.log(result);
                    ngToast.danger({
                      content: '<b>error</b>: could not delete item',
                      dismissButton:true
                    });                    
                }
            );

        };
        
        $scope.uploadFiles = function(files) {
            if(typeof files == 'undefined' || files.length < 1) return;
            console.log(files);
            $scope.isUploading = true;
            var promises = [];
            if (files && files.length) {
                while (files.length) {
                    var file = files.shift();
                    promises.push(
                        Upload.upload({
                            url: 'index.php?do=qinoa_model_create', 
                            method: 'POST',                
                            data: {
                                "entity": 'dropoo\\Document',
                                "fields[name]": file.name,
                                "fields[data]": file
                            }
                        })
                        .then(
                        function success(response) {
                            console.log(response);
                        }, 
                        function error(response) {                            
                            console.log(response);
                            ngToast.danger({
                              content: '<b>error</b>: could not add item, '+response.statusText,
                              dismissButton:true
                            });                             
                        })
                    );

                }
                $q.all(promises).then(function() {
                    $scope.isUploading = false;                    
                    rootCtrl.pageChanged();
                });
            }
        }
        
        // @init
        rootCtrl.pageChanged();
        
    }
]);