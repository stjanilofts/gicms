$(document).ready(function() {
    $('.Head').ready(function() {
        var img = new Image();
        img.onload = function() {
            $('.bg-image').css('background-image', 'url(/imagecache/frontpagebanner/mynd1.jpg)')
            $('.bg-image').addClass('bg-ready')
        }
        img.src = '/imagecache/frontpagebanner/mynd1.jpg';
    });

    $('.image-popup:not(.prevent_default)').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        }
    });

    var offsets = [];

    function setOffsets() {
        offsets = [];
        
        $.each($('[data-sticky]'), function(i, v) {
            offsets.push($(v).offset().top);
        });
    }

    function setStickys() {
        var $top = $(window).scrollTop();

        $.each($('[data-sticky]'), function(i, v) {
            if($top >= offsets[i]) {
                if(! ($('.cloned').length > 0)) {
                    $(v).clone().removeAttr('data-sticky').addClass('cloned').insertBefore($(v));
                }
                
                $(v).not('.cloned').addClass('sticky');
            } else {
                $('.cloned').remove();
                $(v).removeClass('sticky');
            }
        });
    }

    var positions = [];
    $.each($('[data-scroller]'), function(i, v) {
        $(v).click(function(e) {
            e.preventDefault();

            slug = $(v).attr('data-scroller');
            offset = $(v).attr('data-scroller-offset')
                ?  $(v).attr('data-scroller-offset')
                : 0;

            pos = $('a[name="' + slug + '"]').offset().top;

            $('html, body').stop(true, true).animate({
                scrollTop: (parseInt(pos) + parseInt(offset))
            }, 1000);
        })
    });

    $(window).on('resize', function() {
        setOffsets();
        setStickys();
    });

    $(window).on('scroll', function() {
        setStickys();
    });

    setOffsets();
    setStickys();











    $('nav.main.mobile a').click(function(e) {
        e.preventDefault();
        if($('nav.main.slide').is(':visible')) {
            $('nav.main.slide').slideUp('fast');
        } else {
            $('nav.main.slide').slideDown('fast');
        }
    });
});

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


