fullpage.initialize('#fullpage', {
    anchors: ['firstPage', 'secondPage', '3rdPage', '4thpage', '5thpage', 'lastPage'],
    menu: '#menu',
    css3: true,
    navigation: true,
    navigationPosition: 'right',
    navigationTooltips: ['1', '2', '3', '4'],

    'afterLoad': function(anchorLink, index){
        if(index == 1) {
            document.getElementById('car-green').className = "active";
            document.getElementById('banner-txt-1').className = "animated bounceInDown";
            document.getElementById('banner-txt-2').className = "animated bounceInDown";
            // document.getElementById('download-btns').className = "active";
        }
        if(index == 2) {
            // document.getElementById('s2_boom').className = "active";
            // document.getElementById('s2_phone').className = "active";
            // document.getElementById('s2_shadow').className = "active";
        }
        if(index == 3) {
            document.getElementById('pic-2-2').className = "animated bounceInLeft";
            document.getElementById('pic-2-3').className = "animated bounceInUp";
            document.getElementById('pic-2-4').className = "animated bounceInRight";
        }
        if(index == 4) {
            document.getElementById('pic-3-2').className = "animated tada";
            document.getElementById('pic-3-3').className = "animated rotateInUpLeft";
        }
        if(index == 5) {
            document.getElementById('qr-hang').className = "animated bounceInDown";
            // document.getElementById('download-btns-last').className = "active";
        }
    },
    'onLeave': function(index, nextIndex, direction){
        if(index == 1) {
            document.getElementById('car-green').className = "";
            document.getElementById('banner-txt-1').className = "";
            document.getElementById('banner-txt-2').className = "";
        }
        if(index == 2) {
            // document.getElementById('s2_boom').className = "";
            // document.getElementById('s2_phone').className = "";
            // document.getElementById('s2_shadow').className = "";
        }
        if (index == 3) {
            document.getElementById('pic-2-2').className = "";
            document.getElementById('pic-2-3').className = "";
            document.getElementById('pic-2-4').className = "";
        }
        if (index == 3 && direction == 'down'){
        }
        else if(index == 3 && direction == 'up'){
        }
        if (index == 4){
            document.getElementById('pic-3-2').className = "";
            document.getElementById('pic-3-3').className = "";
        }
        if(index == 5) {
            document.getElementById('qr-hang').className = "";
        }
    }
});
