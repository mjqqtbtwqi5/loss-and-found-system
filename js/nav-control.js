let features = document.getElementById("navbar").getElementsByClassName("nav-link");
for(var i = 0;i < features.length;i++) {
    if(features[i].href === location.href) {
        features[i].className += " active";
        features[i].ariaCurrent = "page";
        break;
    }
}