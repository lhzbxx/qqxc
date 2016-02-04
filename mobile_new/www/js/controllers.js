angular.module('starter.controllers', ['baiduMap'])
  .controller('CoachAddressCtrl', function ($scope) {
    var longitude = 113.738487;
    var latitude = 34.361282;
    $scope.mapOptions = {
      center: {
        longitude: longitude,
        latitude: latitude
      },
      zoom: 15,
      navCtrl: true,
      city: 'Xinzheng',
      markers: [{
        longitude: longitude,
        latitude: latitude,
        icon: 'http://img.coolwp.com/wp-content/uploads/2015/04/48-map-marker.png',
        width: 48,
        height: 48,
        title: '在哪儿',
        content: '新郑市梨河镇'
      }]
    };
  })

  .controller('LearnProcessCtrl', function ($scope, servicePhone) {
    $scope.servicePhone = servicePhone;
  })

  .controller('FeedbackCtrl', function ($scope, $http, $ionicLoading, $ionicPopup, apiUrl, servicePhone, $ionicHistory) {
    $scope.servicePhone = servicePhone;
    $scope.comment = {};
    $scope.isEmpty = function () {
      return $scope.comment.text.length;
    };
    $scope.submitFeedback = function () {
      if ($scope.comment.text.length) {
        $ionicLoading.show({
          template: '<ion-spinner icon="bubbles" class="spinner-light">'
          + '</ion-spinner><br>发送中...<style>'
          + '.spinner svg {width: 50px !important; height: 50px !important;}</style>'
        });
        $http({
          method: 'POST',
          url: apiUrl + '/api/app/1/feedback/send',
          timeout: 3000,
          //data: 'phone=123456&content=123456'
          transformRequest: function(obj) {
            var str = [];
            for(var p in obj)
              str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
            return str.join("&");
          },
          data: {
            'phone': '123456',
            'content': $scope.comment.text
          }
        }).success(function(data) {
          $scope.comment = {};
          $ionicLoading.hide();
          $ionicPopup.alert({
            title: '消息',
            template: '提交成功！'
          }).then(function () {
            $ionicHistory.goBack();
          });
        }).error(function(data) {
          $ionicLoading.hide();
          $ionicPopup.alert({
            title: '错误',
            template: '网络错误！'
          });
        });
      }
    }
  })

  .controller('MenuCtrl', function ($scope, $ionicSideMenuDelegate, $ionicPopup, $ionicModal, $timeout) {
    $scope.closeMenu = function () {
      $ionicSideMenuDelegate.toggleRight();
    };
    var login = false;
    $ionicModal.fromTemplateUrl('templates/auth/auth.html', {
      scope: $scope,
      animation: 'slide-in-up'
    }).then(function(modal) {
      $scope.modal = modal;
    });
    $scope.state = '2';
    $scope.title = '注册';
    $scope.verify_code = '获取验证码';
    $scope.cou = 60;
    $scope.verify = function () {
      if ($scope.cou == 60) {
        $scope.verify_code = $scope.cou+'秒';
        $timeout(function () {
          counter()
        }, 1000);
      }
    };
    function counter() {
      if ($scope.cou != 0) {
        $scope.cou -= 1;
        $scope.verify_code = $scope.cou+'秒';
        $timeout(function () {
          counter()
        }, 1000);
      }
      else {
        $timeout.cancel();
        $scope.cou = 60;
        $scope.verify_code = '获取验证码';
      }
    }
    $scope.change = function (state) {
      $scope.state = state;
      switch (state) {
        case 1:
          $scope.title = '登录';
          break;
        case 2:
          $scope.title = '注册';
          break;
        case 3:
          $scope.title = '修改密码';
          break;
      }
    };
    $scope.check = function (state) {
      return $scope.state == state;
    };
    $scope.show = function() {
      $scope.modal.show();
    };
    $scope.closeModal = function() {
      $scope.modal.hide();
    };
    //Cleanup the modal when we're done with it!
    $scope.$on('$destroy', function() {
      $scope.modal.remove();
    });
    // Execute action on hide modal
    $scope.$on('modal.hidden', function() {
      // Execute action
    });
    // Execute action on remove modal
    $scope.$on('modal.removed', function() {
      // Execute action
    });
    //$scope.login = function () {
    //  function showConfirm() {
    //    var myPopup = $ionicPopup.show({
    //      template: '<div class="list">' +
    //      '<label class="item item-input">' +
    //      '<input type="text" placeholder="手机号">' +
    //      '</label>' +
    //      '<label class="item item-input">' +
    //      '<input type="text" placeholder="密码">' +
    //      '</label>' +
    //      '</div><a>新用户注册</a>',
    //      title: '用户登录',
    //      // subTitle: 'Please use normal things',
    //      scope: $scope,
    //      buttons: [{
    //        text: '取消'
    //      }, {
    //        text: '<b>登录</b>',
    //        type: 'button-positive',
    //        onTap: function (e) {
    //          if (!$scope.data.wifi) {
    //            //don't allow the user to close unless he enters wifi password
    //            e.preventDefault();
    //          } else {
    //            return $scope.data.wifi;
    //          }
    //        }
    //      }]
    //    });
    //  }
    //  if (!login) {
    //    showConfirm();
    //  }
    //};
  })

  .controller('PayCtrl', function ($scope, $pingpp, $ionicPopup) {
    $scope.pay=function(){
      var charge={"id":"ch_ez9a5O9GSCy5fj5afHTGmvHG","object":"charge","created":1442542657,"livemode":false,"paid":false,"refunded":false,"app":"app_ir1uHKe9aHaL9SWn","channel":"upacp","order_no":"123456789","client_ip":"127.0.0.1","amount":100,"amount_settle":0,"currency":"cny","subject":"Your Subject","body":"Your Body","extra":{},"time_paid":null,"time_expire":1442546257,"time_settle":null,"transaction_no":null,"refunds":{"object":"list","url":"/v1/charges/ch_ez9a5O9GSCy5fj5afHTGmvHG/refunds","has_more":false,"data":[]},"amount_refunded":0,"failure_code":null,"failure_msg":null,"metadata":{},"credential":{"object":"credential","upacp":{"tn":"201509181017374044084","mode":"00"}},"description":null};
      try{
        $pingpp.createPayment(charge, function(result){
          $ionicPopup.show('suc: '+result);  //"success"
        }, function(result){
          $ionicPopup.show('err: '+result);  //"fail"|"cancel"|"invalid"
        });
      }
      catch(e){
        $ionicPopup.show(e);
      }
    };
  })

  .controller('HomeCtrl', function ($scope, $cordovaToast, $ionicLoading, $http, $cordovaGeolocation, apiUrl, $ionicPopup) {
    //$http({
    //    method: 'POST',
    //    url: 'http://59.78.46.141/index.php/api/user/login',
    //    data: { 'phone' : '13651608916' }
    //}).then(function successCallback(response) {
    //    alert(response.status);
    //    alert(response.data);
    //}, function errorCallback(response) {
    //    alert(response.status);
    //});
    $scope.test = function () {
      $http({
        method: 'GET',
        url: apiUrl + 'app/1/api/test',
        timeout: 10000,
        data: {
        }
      }).success(function(data) {
        $scope.comment = {};
        $ionicLoading.hide();
        $ionicPopup.alert({
          title: '成功',
          template: data
        })
      }).error(function(data) {
        $ionicLoading.hide();
        $ionicPopup.alert({
          title: '失败',
          template: '网络错误！'
        });
      });
    };
    var posOptions = {
      timeout: 3000,
      enableHighAccuracy: false
    };
    $scope.locCity = '';
    function toast(content)
    {
      $cordovaToast
        .show(content, 'short', 'bottom');
    }
    if ($scope.locCity == '')
    {
      $cordovaGeolocation
        .getCurrentPosition(posOptions)
        .then(function (position) {
          var lat = position.coords.latitude;
          var long = position.coords.longitude;
          $http({
            method: 'GET',
            url: 'http://api.map.baidu.com/geocoder/v2/?ak=cgTX3SveDGQq32CoDPXGyGKh&output=json&location=' + lat + ',' + long
          }).success(function(data){
            $scope.locCity = data.result.addressComponent.city;
          })
          .error(function(data){
            toast('地图服务故障');
          })
        }, function (err) {
          toast('定位失败');
        });
    }
    $scope.getPos = function () {
      if ($scope.locCity == '') {
        $ionicLoading.show({
          template: '<ion-spinner icon="bubbles" class="spinner-light">'
          + '</ion-spinner><br>正在定位...<style>'
          + '.spinner svg {width: 50px !important; height: 50px !important;}</style>'
        });
        $cordovaGeolocation
          .getCurrentPosition(posOptions)
          .then(function (position) {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            $scope.url = 'http://api.map.baidu.com/geocoder/v2/?ak=cgTX3SveDGQq32CoDPXGyGKh&output=json&location=' + lat + ',' + long;
            $http({
              method: 'GET',
              url: 'http://api.map.baidu.com/geocoder/v2/?ak=cgTX3SveDGQq32CoDPXGyGKh&output=json&location=' + lat + ',' + long
            }).success(function(data){
              $ionicLoading.hide();
              $scope.locCity = data.result.addressComponent.city;
                toast('当前定位城市：' + $scope.locCity);
            })
            .error(function(data){
              $ionicLoading.hide();
              toast('网络错误');
            })
          }, function (err) {
            $ionicLoading.hide();
            toast('定位失败');
          });
      }
    };
  })

  .controller('NotifyCtrl', function ($scope, $http) {
    $scope.items = [
      {
        'author': '客服',
        'date': '2016/1/2 15:09',
        'content': '这是一条来自未来的消息。'
      },
      {
        'author': '教练',
        'date': '2016/1/2 15:09',
        'content': '明天约不约？'
      }
    ];
    $scope.doRefresh = function() {
      $http.get('http://www.runoob.com/try/demo_source/item.json')
        .success(function(newItems) {
          // $scope.items = newItems;
        })
        .finally(function() {
          $scope.$broadcast('scroll.refreshComplete');
        });
    };
    $scope.loadMore = function() {
      $http.get('/more-items').success(function(items) {
        useItems(items);
        $scope.$broadcast('scroll.infiniteScrollComplete');
      });
    };
    $scope.$on('$stateChangeSuccess', function() {
      $scope.loadMore();
    });
  })

  .controller('DashCtrl', function ($scope, $ionicActionSheet, $ionicSlideBoxDelegate, $http) {
    $scope.show_level = function () {
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
        cancel: function () {
          // add cancel code..
        },
        buttonClicked: function (index) {
          return true;
        }
      });
    };
    $scope.show_price = function () {
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
        cancel: function () {
          // add cancel code..
        },
        buttonClicked: function (index) {
          this.text(index);
          return true;
        }
      });
    };
    $scope.doRefresh = function () {
      $http.get('http://www.4byte.cn/question/1014482/css-banner-menu-postions.html')
        .success(function (newItems) {
        })
        .finally(function () {
          $scope.$broadcast('scroll.refreshComplete');
        });
    };
    $scope.moreDataCanBeLoaded = function () {
      return true;
    };
    $scope.loadMore = function () {
      return true;
    };
    $scope.show_place = function () {
      var hideSheet = $ionicActionSheet.show({
        buttons: [{
          text: '自动定位'
        }, {
          text: '手动选择'
        }],
        destructiveText: '不限制',
        titleText: '请选择您需要的学车地点~',
        cancelText: '取消',
        cancel: function () {
          // add cancel code..
        },
        buttonClicked: function (index) {
          return true;
        }
      });
    };
  })


  //LOGIN
  .controller('LoginCtrl', function ($scope, $state, $templateCache, $q, $rootScope) {
    $scope.doLogIn = function () {
      $state.go('app.feeds-categories');
    };
    $scope.user = {};
    $scope.user.email = "john@doe.com";
    $scope.user.pin = "12345";
    // We need this for the form validation
    $scope.selected_tab = "";
    $scope.$on('my-tabs-changed', function (event, data) {
      $scope.selected_tab = data.title;
    });
  })

  .controller('SignupCtrl', function ($scope, $state) {
    $scope.user = {};
    $scope.user.email = "john@doe.com";
    $scope.doSignUp = function () {
      $state.go('app.feeds-categories');
    };
  })

  .controller('ForgotPasswordCtrl', function ($scope, $state) {
    $scope.recoverPassword = function () {
      $state.go('app.feeds-categories');
    };
    $scope.user = {};
  })

  .controller('ChatsCtrl', function ($scope, Chats) {
    // With the new view caching in Ionic, Controllers are only called
    // when they are recreated or on app start, instead of every page change.
    // To listen for when this page is active (for example, to refresh data),
    // listen for the $ionicView.enter event:
    //
    //$scope.$on('$ionicView.enter', function(e) {
    //});

    $scope.chats = Chats.all();
    $scope.remove = function (chat) {
      Chats.remove(chat);
    };
  })

  .controller('ChatDetailCtrl', function ($scope, $stateParams, Chats) {
    $scope.chat = Chats.get($stateParams.chatId);
  })

  .controller('BBSCtrl', function ($scope) {
  })

  .controller('AccountCtrl', function ($scope) {
    $scope.settings = {
      enableFriends: true
    };
  })

  .controller('ExerciseCtrl', function ($scope, $cordovaToast) {
    $scope.show_all = false;
    $scope.show_all_exercise = function () {
      $scope.show_all = true;
    };
    $scope.hide_all_exercise = function () {
      $scope.show_all = false;
    };
    $scope.isStar = false;
    $scope.star = function () {
      $scope.isStar = true;
      $cordovaToast
        .show('收藏成功', 'short', 'bottom')
        .then(function (success) {
        }, function (error) {
        });
    };
    $scope.unstar = function () {
      $scope.isStar = false;
      $cordovaToast
        .show('取消收藏', 'short', 'bottom')
        .then(function (success) {
        }, function (error) {
        });
    };
    $scope.mode = 0; // 默认为答题模式
    $scope.changeMode = function (index) {
      $scope.mode = index;
    };
    $scope.checkMode = function (index) {
      return $scope.mode == index;
    };
    $scope.switch = false; // 默认为日光
    $scope.changeSwitch = function () {
      $scope.switch = !$scope.switch;
    };
  })

  .controller('CoachListCtrl', function ($scope, $ionicLoading, $ionicPopup, $ionicHistory, $http, apiUrl) {
    $scope.filter = 0;
    $scope.checkFilter = function (index) {
      return $scope.filter == index;
    };
    $scope.changeFilter = function (index) {
      $scope.filter = index;
      $scope.items = [];
      $scope.loading = true;
      // todo: 从缓存中获取。
      $http({
        method: 'POST',
        url: apiUrl + '/api/coach/get_coach_list',
        timeout: 3000,
        transformRequest: function(obj) {
          var str = [];
          for(var p in obj)
            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
          return str.join("&");
        },
        data: {
        }
      }).success(function(data) {
        $scope.items = data.data;
        $scope.loading = false;
      }).error(function(data) {
        $ionicPopup.alert({
          title: '错误',
          template: '网络错误！'
        }).then(function () {
          $ionicHistory.goBack();
        });
      });
    };
    $scope.items = [];
    $scope.loading = true;
    // todo: 从缓存中获取。
    $http({
      method: 'POST',
      url: apiUrl + '/api/coach/get_coach_list',
      timeout: 3000,
      transformRequest: function(obj) {
        var str = [];
        for(var p in obj)
          str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        return str.join("&");
      },
      data: {
      }
    }).success(function(data) {
      $scope.items = data.data;
      $scope.loading = false;
    }).error(function(data) {
      $ionicPopup.alert({
        title: '错误',
        template: '网络错误！'
      }).then(function () {
        $ionicHistory.goBack();
      });
    });
  })

  .controller('Messages', function ($scope, $timeout, $location, $ionicScrollDelegate) {

    $scope.back = function () {
      $location.path('/#/coach-detail');
    };

    $scope.hideTime = true;

    var alternate,
      isIOS = ionic.Platform.isWebView() && ionic.Platform.isIOS();

    $scope.sendMessage = function () {
      alternate = !alternate;

      var d = new Date();
      d = d.toLocaleTimeString().replace(/:\d+ /, ' ');

      $scope.messages.push({
        userId: alternate ? '12345' : '54321',
        text: $scope.data.message,
        time: d
      });

      delete $scope.data.message;
      $ionicScrollDelegate.scrollBottom(true);

    };

    $scope.inputUp = function () {
      if (isIOS) $scope.data.keyboardHeight = 216;
      $timeout(function () {
        $ionicScrollDelegate.scrollBottom(true);
      }, 300);

    };

    $scope.inputDown = function () {
      if (isIOS) $scope.data.keyboardHeight = 0;
      $ionicScrollDelegate.resize();
    };

    $scope.closeKeyboard = function () {
      // cordova.plugins.Keyboard.close();
    };

    $scope.data = {};
    $scope.myId = '12345';
    $scope.messages = [];

  })
