
$(window).on('beforeload', function () {
    console.log("before loading..");
    $(".preload").fadeIn();
});
$(window).on('beforeunload', function () {
//    return 'Are you sure you want to leave?';
    $(".preload").fadeIn();
    console.log("leaving..");
});
$(document).ready(function () {
    $(".preload").fadeOut();
    console.log("DOM fully loaded and parsed");
    var docHeight = $(document).height();
    $("#overlay")
            .height(docHeight)
            .css({
                'opacity': 0.4,
                'position': 'absolute',
                'top': 0,
                'left': 0,
                'background-color': 'transparent',
                'width': '100%',
                'z-index': 5000
            });
});
