<!DOCTYPE html>
<!-- global attr for scrolling to top -->
<!-- app name ('project' as default)-->    
<!-- use of rootCtrl as convention for root (global) controller -->
<html lang="fr" id="top" ng-app="project" ng-controller="rootController as rootCtrl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- define fragment to be used as hashbang (@see https://www.contentside.com/angularjs-seo/) -->        
        <meta name="fragment" content="!">
        <base href="/">
        
        <meta itemscope itemtype="https://schema.org/WebApplication" />        
        <!-- add absolute path of a thumbnail here -->
        <meta itemprop="image" content="" />

        <meta property="og:type" content="website" />
        <!-- add absolute path of a thumbnail here -->        
        <meta property="og:image" content="" />

        <!-- webapp title -->
        <title></title>
        <meta name="title" content="">
        <!-- webapp description -->
        <meta name="description" content="">        
        
        <script type="text/javascript" src="https://code.angularjs.org/1.6.9/angular.min.js"></script>
        <script type="text/javascript" src="https://code.angularjs.org/1.6.9/angular-animate.min.js"></script>
        <script type="text/javascript" src="https://code.angularjs.org/1.6.9/angular-touch.min.js"></script>
        <script type="text/javascript" src="https://code.angularjs.org/1.6.9/angular-sanitize.min.js"></script>
        <script type="text/javascript" src="https://code.angularjs.org/1.6.9/angular-cookies.min.js"></script>
        <script type="text/javascript" src="https://code.angularjs.org/1.6.9/angular-route.min.js"></script>


        <script type="text/javascript" src="/packages/dropoo/assets/js/moment.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/md5.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/hello.all.min.js"></script>        
        <script type="text/javascript" src="/packages/dropoo/assets/js/angular-translate.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/angular-moment.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/ng-file-upload.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/angular-hello.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/ui-bootstrap-tpls-2.2.0.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/angular-tinymce.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/ngToast.min.js"></script>
        <script type="text/javascript" src="/packages/dropoo/assets/js/select-tpls.min.js"></script>
        
        
        <script type="text/javascript" src="/packages/dropoo/apps/main.js"></script>

        
        <link rel="stylesheet" type="text/css" href="/packages/dropoo/assets/css/project.css?v=" />
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,400" />
        
        <script>
        /* global config object, when necessary */
        var global_config = {
        };
        
        /* additional mandatory js content, if any */
        </script>
        
        <style>
        .drop-box {
            text-align:center;
            font-family: Roboto, sans-serif;
            font-size: 20px; 
            background-color: #c8dadf;
            position: relative;
            padding: 30px 20px;
            font-weight: normal;
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;

            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
        }

        .drop-box.dragover {
            outline-offset: -20px;
            outline-color: #c8dadf;
            background-color: #fff;
        }
        .drop-box label {
            font-weight: normal;
        }
        .drop-box label strong {
            cursor: pointer;
        }
        .drop-box label strong:hover {
            cursor: pointer;
            color: #39BFD3;
        }

        .drop-box .box__icon {
            width: 100%;
            height: 80px;
            fill: #92b0b3;
            display: block;
            margin-bottom: 40px;
        }


        .box__uploading,
        .box__success,
        .box__error {
            display: block;
            position: absolute;
            top: 50%;
            right: 0;
            left: 0;
            z-index: 1000;
            -webkit-transform: translateY( -50% );
            transform: translateY( -50% );
            outline: 0 !important;
            border: 0 !important;
        }
        .box__uploading {
            font-style: italic;
        }
        .box__success {
            -webkit-animation: appear-from-inside .25s ease-in-out;
            animation: appear-from-inside .25s ease-in-out;
        }
        @-webkit-keyframes appear-from-inside {
            from	{ -webkit-transform: translateY( -50% ) scale( 0 ); }
            75%		{ -webkit-transform: translateY( -50% ) scale( 1.1 ); }
            to		{ -webkit-transform: translateY( -50% ) scale( 1 ); }
        }
        @keyframes appear-from-inside {
            from	{ transform: translateY( -50% ) scale( 0 ); }
            75%		{ transform: translateY( -50% ) scale( 1.1 ); }
            to		{ transform: translateY( -50% ) scale( 1 ); }
        }

        </style>        
        
    </head>


    <body class="ng-cloak">
        <!-- This is a dedicated element wherein FB scripts will create additional DOM elements -->
        <div id="fb-root"></div>
        
        <!-- These elements might be used by some social networks and have 
        Content should be identical to meta/title 
        -->
        <div class="sectiontitle ng-hide"></div>
        <title class="ng-hide"></title>
    
        <!-- This is a dedicated element for displaying notifications (ng-toast or other)
        -->
        <toast></toast>

        <!-- This is a hidden container for embedding some stuff into the current file.
        It can be used for images preload -->
        <div class="ng-hide">
        </div>
        
        <!-- In some cases, html templates must be embedded in rootScope 
        This is the place to hard-code those, if any.
        -->
        <script type="text/ng-template" id="loginModal.html">
            <form name="form_login">        
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title">Log in</h3>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="login-form" ng-hide="result.length || currentUser">

                        <div class="form-group" ng-class="{'has-error': form_login.login.$touched && form_login.login.$invalid}">
                            <input ng-model="login" name="login" type="email" class="form-control" placeholder="Username" required="required">
                        </div>
                        <div class="form-group" ng-class="{'has-error': form_login.password.$touched && form_login.password.$invalid}">
                            <input ng-model="password" name="password" type="password" class="form-control" placeholder="Password" required="required">
                        </div>
                        <div class="clearfix" ng-show="errors.length">
                            <div class="panel panel-danger">
                                <div class="panel-heading" style="padding: 2px 5px;">
                                    <h3 class="panel-title">errors</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="text-danger" ng-repeat="error in errors">&bull; {{error}}</div>
                                </div>
                            </div>                            
                        </div>
                        <div class="clearfix">
                            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
                            <a href="#" class="pull-right">Forgot Password?</a>
                        </div>        

                        <p class="text-center"><a href="#">Create an Account</a></p>
                    </div>
                    <div ng-show="result.length">
                    {{result}}
                    </div>
                    <div ng-show="currentUser">
                    {{currentUser.firstname}} {{currentUser.lastname}}
                    </div>
                </div>
				<div class="modal-footer" ng-show="currentUser">
					<button class="btn btn-success" type="button" ng-click="ctrl.logout()">Log out</button>
				</div>									
                <div class="modal-footer" ng-hide="currentUser">
                    <button class="btn btn-success" type="submit" ng-click="ctrl.login()">Log in</button>
                    <button class="btn btn-warning" type="button" ng-click="ctrl.cancel()">Cancel</button>
                </div>
            </form>
        </script>        
        <!-- header / topbar -->
        <header 
            id="header" 
            class="navbar navbar-default navbar-fixed-top navbar-inner ng-cloak"
            >
            <div style="display: inline-block; cursor:pointer; padding-left: 200px; padding-top: 5px;" ng-click="openLogin()"><img style="height: 40px;" src="/packages/dropoo/assets/img/dropoo_logo.png" /></div>
        </header>
        
        <main id="body" role="main">
            <!-- This is a dedicated element where modal will anchor -->
            <div class="modal-wrapper"></div>
                       
            <div class="container" style="padding-bottom: 0px;">

                <!-- gloabl loader overlay -->
                <div ng-show="viewContentLoading" class="loader"><i class="fa fa-spin fa-spinner" aria-hidden="true"></i></div>
                <div ng-view ng-hide="viewContentLoading">
                
                    <div class="row">
                        <div class="table-responsive" style="font-size: 80%;">
                          <table class="table">
                            <tr ng-repeat="file in conf.items">
                                <td style="min-width: 50px;"><a target="_blank" ng-href="/document/{{file.hash}}"><img style="height: 35px;" ng-src="/document/{{file.hash}}" /></a></td>
                                <td style="min-width: 80px;"><a target="_blank" ng-href="/document/{{file.hash}}">{{file.hash}}</a></td>
                                <td><a target="_blank" ng-href="/document/{{file.hash}}">{{file.name}}</a></td>
                                <td class="hidden-xs">{{file.content_type}}</td>
                                <td class="hidden-xs">{{file.size}}</td>
                                <td><a href="#" ng-click="deleteFile(file.id)"><i class="fa fa-trash" aria-hidden="true"></i></a></td>                                
                            </tr>
                          </table>
                        </div>
                        <ul style="margin-left: 30px; margin-top: 0;" ng-hide="conf.total_items < 1" uib-pagination ng-change="pageChanged()" total-items="conf.total_items" ng-model="conf.current_page" max-size="maxSize" class="pagination-sm" boundary-link-numbers="true" rotate="false"></ul>
                    </div>
                    
                </div>
            </div>
        </main>

        <footer id="footer" class="footer">
            <div class="grid wrapper">
                <div class="container col-1-1" >
                    <!-- footer -->

                    <form ng-app="fileUpload" name="form" style="position: relative;">
                        <div 
                            ngf-drop="uploadFiles($files)"
                            ngf-select
                            ngf-multiple="true" 
                            ngf-keep="true" class="drop-box box__input">
                            <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"/></svg>

                            <label><strong>Choose a file</strong> or drag it here.</label>
                        </div>
                        <div class="drop-box box__uploading" ng-show="isUploading">Uploading&hellip;</div>
                        <div class="drop-box box__success" ng-show="isSuccess">Done!</div>
                        <div class="drop-box box__error" ng-show="isError">Error! <span></span>.</div>                        

                    </form>

                </div>
            </div>
        </footer>
    </body>

</html>
