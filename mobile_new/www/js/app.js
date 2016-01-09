// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'starter.controllers', 'starter.services', 'ngCordova'])

  .run(function ($ionicPlatform) {
    $ionicPlatform.ready(function () {
      if (window.cordova && window.cordova.plugins.Keyboard) {
        // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
        // for form inputs)
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

        // Don't remove this line unless you know what you are doing. It stops the viewport
        // from snapping when text inputs are focused. Ionic handles this internally for
        // a much nicer keyboard experience.
        cordova.plugins.Keyboard.disableScroll(true);
      }
      if (window.StatusBar) {
        StatusBar.styleDefault();
      }
    });
  })

  .run(['$ionicPlatform', '$ionicPopup', '$rootScope', '$location', '$ionicHistory',
    function ($ionicPlatform, $ionicPopup, $rootScope, $location, $ionicHistory) {
      $ionicPlatform.registerBackButtonAction(function (e) {
        e.preventDefault();

        function showConfirm() {
          var confirmPopup = $ionicPopup.confirm({
            title: '<strong>退出应用?</strong>',
            template: '你确定要退出应用吗?',
            okText: '退出',
            cancelText: '取消'
          });
          confirmPopup.then(function (res) {
            if (res) {
              ionic.Platform.exitApp();
            } else {
              // Don't close
            }
          });
        }

        // Is there a page to go back to?
        if ($location.path() == '/app/home') {
          showConfirm();
        } else {
          $ionicHistory.goBack();
        }

        //  else if ($rootScope.$viewHistory.backView) {
        //   // console.log('currentView:', $rootScope.$viewHistory.currentView);
        //   // Go back in history
        //   // $rootScope.$viewHistory.backView.go();
        //   window.location.href = '/';
        // } else {
        //   // This is the last page: Show confirmation popup
        //   showConfirm();
        // }
        // return false;
      }, 100);
    }
  ])

  .directive('input', function ($timeout) {
    return {
      restrict: 'E',
      scope: {
        'returnClose': '=',
        'onReturn': '&',
        'onFocus': '&',
        'onBlur': '&'
      },
      link: function (scope, element, attr) {
        element.bind('focus', function (e) {
          if (scope.onFocus) {
            $timeout(function () {
              scope.onFocus();
            });
          }
        });
        element.bind('blur', function (e) {
          if (scope.onBlur) {
            $timeout(function () {
              scope.onBlur();
            });
          }
        });
        element.bind('keydown', function (e) {
          if (e.which == 13) {
            if (scope.returnClose) element[0].blur();
            if (scope.onReturn) {
              $timeout(function () {
                scope.onReturn();
              });
            }
          }
        });
      }
    }
  })

  .config(function ($stateProvider, $urlRouterProvider) {

    // Ionic uses AngularUI Router which uses the concept of states
    // Learn more here: https://github.com/angular-ui/ui-router
    // Set up the various states which the app can be in.
    // Each state's controller can be found in controllers.js
    $stateProvider

      .state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'templates/app/side-menu.html',
        controller: 'HomeCtrl'
      })
      .state('app.home', {
        url: '/home',
        views: {
          'main-content': {
            templateUrl: "templates/app/home.html",
            controller: 'HomeCtrl'
          }
        }
      })
      .state('app.learn-process', {
        url: '/learn-process',
        views: {
          'main-content': {
            templateUrl: 'templates/app/learn/process.html'
          }
        }
      })
      .state('app.learn-record', {
        url: '/learn-record',
        views: {
          'main-content': {
            templateUrl: 'templates/app/learn/record.html'
          }
        }
      })
      .state('app.invite', {
        url: '/invite',
        views: {
          'main-content': {
            templateUrl: 'templates/app/invite/invite.html'
          }
        }
      })
      .state('app.coach-list', {
        url: '/coach-list',
        views: {
          'main-content': {
            templateUrl: 'templates/app/coach/list.html'
          }
        }
      })
      .state('app.coach-detail', {
        url: '/coach-detail',
        views: {
          'main-content': {
            templateUrl: 'templates/app/coach/detail.html'
          }
        }
      })
      .state('app.coach-mine', {
        url: '/coach-mine',
        views: {
          'main-content': {
            templateUrl: 'templates/app/coach/mine.html'
          }
        }
      })
      .state('app.coach-address', {
        url: '/coach-address',
        views: {
          'main-content': {
            templateUrl: 'templates/app/coach/address.html',
            controller: 'CoachAddressCtrl'
          }
        }
      })
      .state('app.feedback', {
        url: '/feedback',
        views: {
          'main-content': {
            templateUrl: 'templates/app/feedback.html'
          }
        }
      })
      .state('app.exercise', {
        url: '/exercise',
        views: {
          'main-content': {
            templateUrl: 'templates/app/exercise/exercises.html',
            controller: 'ExerciseCtrl'
          }
        }
      })
      .state('app.chapter', {
        url: '/chapter',
        views: {
          'main-content': {
            templateUrl: 'templates/app/exercise/exercise.html',
            controller: 'ExerciseCtrl'
          }
        }
      })
      .state('app.enroll', {
        url: '/enroll',
        views: {
          'main-content': {
            templateUrl: 'templates/app/enroll.html'
          }
        }
      })
      .state('app.coach-enroll', {
        url: '/coach-enroll',
        views: {
          'main-content': {
            templateUrl: 'templates/app/coach/enroll.html'
          }
        }
      })
      .state('app.protocol', {
        url: '/protocol',
        views: {
          'main-content': {
            templateUrl: 'templates/app/protocol.html',
          }
        }
      })
      .state('app.purse', {
        url: '/purse',
        views: {
          'main-content': {
            templateUrl: 'templates/app/purse/account.html'
          }
        }
      })
      .state('app.purse-detail', {
        url: '/purse-detail',
        views: {
          'main-content': {
            templateUrl: 'templates/app/purse/detail.html'
          }
        }
      })
      .state('contact', {
        url: '/contact',
        templateUrl: 'templates/contact.html',
        controller: 'Messages'
      })
      .state('notify', {
        url: '/notify',
        templateUrl: 'templates/notify.html',
        controller: 'Messages'
      })

      .state('auth.login', {
        url: '/login',
        templateUrl: "templates/auth/login.html",
        controller: 'LoginCtrl'
      })
      .state('auth.signup', {
        url: '/signup',
        templateUrl: "templates/auth/signup.html",
        controller: 'SignupCtrl'
      })
      .state('auth.forgot-password', {
        url: "/forgot-password",
        templateUrl: "templates/auth/forgot-password.html",
        controller: 'ForgotPasswordCtrl'
      })
      //.state('chapter', {
      //  url: '/exercise/chapter',
      //  templateUrl: 'templates/exercise.html',
      //  controller: 'ExerciseCtrl'
      //})
      //.state('random', {
      //  url: '/exercise/random',
      //  templateUrl: 'templates/exercise.html',
      //  controller: 'ExerciseCtrl'
      //})
      //.state('order', {
      //  url: '/exercise/order',
      //  templateUrl: 'templates/exercise.html',
      //  controller: 'ExerciseCtrl'
      //});

    cache: false;
    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/app/home');

  })
