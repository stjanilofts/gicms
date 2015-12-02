/*var header = $('header');
var range = 200;

$(window).on('scroll', function () {
  
    var scrollTop = $(this).scrollTop();
    var offset = header.offset().top;
    var height = header.outerHeight();
    offset = offset + height / 2;
    var calc = 1 - (scrollTop - offset + range) / range;
  
    header.css({ 'opacity': calc });
  
    if ( calc > '1' ) {
      header.css({ 'opacity': 1 });
    } else if ( calc < '0' ) {
      header.css({ 'opacity': 0 });
    }
  
});*/



    
/*heightsReady = false;
$(window).load(function() {
    heightsReady = true;
    function matchHeights() {
        $elems = $('[data-match-height]');

        var largest = false;

        $.each($elems, function(i, v) {
            var $h = $(v).height();

            console.log($h);

            if (!largest || largest < $h) {
                largest = $h;
            }
        });
        
        $.each($elems, function(i, v) {
            console.log(largest);
            $(v).height(largest);
        });
    }

    matchHeights();
});
$(window).resize(function() {
    if(heightsReady) {
        matchHeights();
    }
});*/