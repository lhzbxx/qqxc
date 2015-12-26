// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'starter.controllers', 'starter.services', 'ngCordova'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
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

.run(['$ionicPlatform', '$ionicPopup', '$rootScope', '$location',
  function($ionicPlatform, $ionicPopup, $rootScope, $location) {
    $ionicPlatform.registerBackButtonAction(function(e) {
      e.preventDefault();

      function showConfirm() {
        var confirmPopup = $ionicPopup.confirm({
          title: '<strong>退出应用?</strong>',
          template: '你确定要退出应用吗?',
          okText: '退出',
          cancelText: '取消'
        });
        confirmPopup.then(function(res) {
          if (res) {
            ionic.Platform.exitApp();
          } else {
            // Don't close
          }
        });
      }
      // Is there a page to go back to?
      if ($location.path() == '/') {
        showConfirm();
      } else if ($rootScope.$viewHistory.backView) {
        // console.log('currentView:', $rootScope.$viewHistory.currentView);
        // Go back in history
        // $rootScope.$viewHistory.backView.go();
        $location.path('/');
      } else {
        // This is the last page: Show confirmation popup
        showConfirm();
      }
      return false;
    }, 101);
  }
])

.directive('input', function($timeout) {
  return {
    restrict: 'E',
    scope: {
      'returnClose': '=',
      'onReturn': '&',
      'onFocus': '&',
      'onBlur': '&'
    },
    link: function(scope, element, attr) {
      element.bind('focus', function(e) {
        if (scope.onFocus) {
          $timeout(function() {
            scope.onFocus();
          });
        }
      });
      element.bind('blur', function(e) {
        if (scope.onBlur) {
          $timeout(function() {
            scope.onBlur();
          });
        }
      });
      element.bind('keydown', function(e) {
        if (e.which == 13) {
          if (scope.returnClose) element[0].blur();
          if (scope.onReturn) {
            $timeout(function() {
              scope.onReturn();
            });
          }
        }
      });
    }
  }
})

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider

    .state('index', {
      url: '/',
      templateUrl: 'templates/home.html',
      controller: 'HomeCtrl'
    })
    .state('coach-detail', {
      url: '/coach-detail',
      templateUrl: 'templates/coach-detail.html',
      controller: 'HomeCtrl'
    })
    .state('register-info', {
      url: '/register-info',
      templateUrl: 'templates/register-info.html',
      controller: 'HomeCtrl'
    })
    .state('coach-list', {
      url: '/coach-list',
      templateUrl: 'templates/coach-list.html',
      controller: 'HomeCtrl'
    })
    .state('learn-process', {
      url: '/learn-process',
      templateUrl: 'templates/learn-process.html',
      controller: 'HomeCtrl'
    })
    .state('learn-record', {
      url: '/learn-record',
      templateUrl: 'templates/learn-record.html',
      controller: 'HomeCtrl'
    })
    .state('feedback', {
      url: '/feedback',
      templateUrl: 'templates/feedback.html',
      controller: 'HomeCtrl'
    })
    .state('contact', {
      url: '/contact',
      templateUrl: 'templates/contact.html',
      controller: 'Messages'
    })
    .state('invite', {
      url: '/invite',
      templateUrl: 'templates/invite.html',
      controller: 'HomeCtrl'
    });

  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/');

})
