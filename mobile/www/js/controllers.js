angular.module('starter.controllers', [])

.controller('DashCtrl', function($scope, $ionicActionSheet, $ionicSlideBoxDelegate, $http) {
  $scope.show_level = function() {
    var hideSheet = $ionicActionSheet.show({
      buttons: [{
        text: 'A'
      }, {
        text: 'B'
      }, {
        text: 'C'
      }],
      destructiveText: '不限制',
      titleText: '请选择您要考取的驾照级别~',
      cancelText: '取消',
      cancel: function() {
        // add cancel code..
      },
      buttonClicked: function(index) {
        return true;
      }
    });
  };
  $scope.show_price = function() {
    var hideSheet = $ionicActionSheet.show({
      buttons: [{
        text: '3k以下'
      }, {
        text: '3k-5k'
      }, {
        text: '5k-8k'
      }, {
        text: '8k以上'
      }],
      destructiveText: '不限制',
      titleText: '请选择您可以接受的价格区间~',
      cancelText: '取消',
      cancel: function() {
        // add cancel code..
      },
      buttonClicked: function(index) {
        this.text(index);
        return true;
      }
    });
  };
  $scope.doRefresh = function() {
    $http.get('http://www.4byte.cn/question/1014482/css-banner-menu-postions.html')
      .success(function(newItems) {
      })
      .finally(function() {
        $scope.$broadcast('scroll.refreshComplete');
      });
  };
  $scope.moreDataCanBeLoaded = function() {
    return true;
  }
  $scope.loadMore = function() {
    return true;
  }
  $scope.show_place = function() {
    var hideSheet = $ionicActionSheet.show({
      buttons: [{
        text: '自动定位'
      }, {
        text: '手动选择'
      }],
      destructiveText: '不限制',
      titleText: '请选择您需要的学车地点~',
      cancelText: '取消',
      cancel: function() {
        // add cancel code..
      },
      buttonClicked: function(index) {
        return true;
      }
    });
  };
})

.controller('ChatsCtrl', function($scope, Chats) {
  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //
  //$scope.$on('$ionicView.enter', function(e) {
  //});

  $scope.chats = Chats.all();
  $scope.remove = function(chat) {
    Chats.remove(chat);
  };
})

.controller('ChatDetailCtrl', function($scope, $stateParams, Chats) {

  $scope.chat = Chats.get($stateParams.chatId);
})

.controller('BBSCtrl', function($scope) {})

.controller('AccountCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
