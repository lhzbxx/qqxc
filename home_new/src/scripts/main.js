fullpage.initialize('#fullpage', {
    anchors: ['1', '2', '3', '4', '5', '6'],
    menu: '#menu',
    css3: true,
    navigation: true,
    navigationPosition: 'right',
    navigationTooltips: ['1', '2', '3', '4', '5'],

    'afterLoad': function(anchorLink, index) {
        if(index == 1) {
            document.getElementById('car-green').className = "active";
            document.getElementById('banner-txt-1').className = "animated fadeInDown";
            document.getElementById('banner-txt-2').className = "animated fadeIn";
            // document.getElementById('download-btns').className = "active";
        }
        if(index == 2) {
            document.getElementById('pic-text-1-1').className = "text-line-1 animated fadeInDown";
            document.getElementById('pic-text-1-2').className = "text-line-2 animated fadeIn";
            document.getElementById('pic-1-2').className = "animated bounceInUp";
            document.getElementById('pic-1-3-1').className = "active";
            document.getElementById('pic-1-3-2').className = "active";
            document.getElementById('pic-1-4').className = "animated zoomIn";
            document.getElementById('pic-1-5').className = "active";
        }
        if(index == 3) {
            document.getElementById('pic-text-2-1').className = "text-line-1 animated fadeInDown";
            document.getElementById('pic-text-2-2').className = "text-line-2 animated fadeIn";
            document.getElementById('pic-2-2').className = "animated bounceInLeft";
            document.getElementById('pic-2-3').className = "animated bounceInUp";
            document.getElementById('pic-2-4').className = "animated bounceInRight";
            document.getElementById('pic-2-5').className = "animated tada";
        }
        if(index == 4) {
            document.getElementById('pic-text-3-1').className = "text-line-1 animated fadeInDown";
            document.getElementById('pic-text-3-2').className = "text-line-2 animated fadeIn";
            document.getElementById('pic-3-2').className = "animated tada";
            document.getElementById('pic-3-3').className = "animated rotateInUpLeft";
            document.getElementById('pic-3-4').className = "animated fadeIn";
        }
        if(index == 5) {
            document.getElementById('qr-hang').className = "animated bounceInDown";
            document.getElementById('qr-txt').className = "animated slideInRight";
            // document.getElementById('download-btns-last').className = "active";
        }
    },
    'onLeave': function(index, nextIndex, direction){
        if(index == 1) {
            fresh();
        }
        if(index == 2) {
            fresh();
        }
        if (index == 3) {
            fresh();
        }
        if (index == 3 && direction == 'down'){
        }
        else if(index == 3 && direction == 'up'){
        }
        if (index == 4){
            fresh();
        }
        if(index == 5) {
            fresh();
        }
    }
});

function fresh() {
    document.getElementById('car-green').className = "";
    document.getElementById('banner-txt-1').className = "inactive";
    document.getElementById('banner-txt-2').className = "inactive";
    document.getElementById('pic-1-2').className = "inactive";
    document.getElementById('pic-1-3-1').className = "";
    document.getElementById('pic-1-3-2').className = "";
    document.getElementById('pic-1-4').className = "inactive";
    document.getElementById('pic-1-5').className = "inactive";
    document.getElementById('pic-2-2').className = "inactive";
    document.getElementById('pic-2-3').className = "inactive";
    document.getElementById('pic-2-4').className = "inactive";
    document.getElementById('pic-2-5').className = "";
    document.getElementById('pic-3-2').className = "inactive";
    document.getElementById('pic-3-3').className = "inactive";
    document.getElementById('pic-3-4').className = "inactive";
    document.getElementById('qr-hang').className = "inactive";
    document.getElementById('qr-txt').className = "inactive";
    document.getElementById('pic-text-1-1').className = "text-line-1 transparent";
    document.getElementById('pic-text-1-2').className = "text-line-2 transparent";
    document.getElementById('pic-text-2-1').className = "text-line-1 transparent";
    document.getElementById('pic-text-2-2').className = "text-line-2 transparent";
    document.getElementById('pic-text-3-1').className = "text-line-1 transparent";
    document.getElementById('pic-text-3-2').className = "text-line-2 transparent";
}
