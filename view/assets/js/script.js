'use strict';

function genericSocialShare(key) {
    var url;
    var ngrok = "https://2914b43d.ngrok.io";
    url = "http://www.facebook.com/sharer.php?u=" + ngrok + "/upload/" + key + ".png";
    window.open(url, 'sharer', 'toolbar=0,status=0,width=648,height=395');
    return true;
}
