//set the container that Masonry will be inside of in a var
var container = document.querySelector('#masonry-loop');
//create empty var msnry
var msnry;
// initialize Masonry after all images have loaded
if(container != undefined){
    imagesLoaded( container, function() {
        msnry = new Masonry( container, {
            itemSelector: '.hentry'
        });
    });
}

//set the container that Masonry will be inside of in a var
var footerContainer = document.querySelector('#footer-widgets');
//create empty var msnry
var msnry2;
// initialize Masonry after all images have loaded
if(footerContainer != undefined){
    imagesLoaded( footerContainer, function() {
        msnry2 = new Masonry( footerContainer, {
            itemSelector: '.widget'
        });
    });
}
