$(function(){
  $('.scroll-pane').jScrollPane(
    {
      // verticalGutter: 30
    }
  );
});
$(function(){
  $('.slider-row-2-col-3 ul.avia-icon-list').slick({
    dots: true,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    speed: 700,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: true,
    rows: 2,
    pauseOnHover: false,
    adaptiveHeight: true,
    prevArrow: '<button id="prev" type="button" class="slick-prev slick-arrow"><i class="icon-arrow-prev"></i></button>',
    nextArrow: '<button id="next" type="button" class="slick-next slick-arrow"><i class="icon-arrow-next"></i></button>',
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      }
    ]
  });
});
jQuery(document).ready(function( $ ) {
  if(document.documentElement.clientWidth < 993) {
    $('#header_main .av-burger-menu-main').on('click', function() {
        $('#header_main .lang_sel_list').fadeToggle();
        $('#header_main .lang_sel_list').toggleClass('active');
    });
  }
});


// !function(a){a.fn.animated=function(n){a(this).each(function(){
//   var t=a(this);
//   t.css("opacity","0").addClass("animated").waypoint(function(a){
//     "down"===a&&t.addClass(n).css("opacity","1")
//   },
//   {offset:"80%"}
//   )
// })}}(jQuery);


// $(document).ready(function() {
//   if(document.documentElement.clientWidth > 576) {
//     $(".animate-fi").animated("fadeIn");
//   }
// });


$(document).ready(function(){
  $('.custom-services-item').hover(
    function() {
      $( this ).find('.av-icon-char').addClass('jello');
    }, function() {
      $( this ).find('.av-icon-char').removeClass('jello');
    }
  );
});



$(document).ready(function(){
  $('.slider-style.icon-box-shadow li').hover(
    function() {
      $( this ).find('.iconlist_icon').addClass('jello');
    }, function() {
      $( this ).find('.iconlist_icon').removeClass('jello');
    }
  );
});

$(document).ready(function(){
  $('.slider-style.slider-style-tada li').hover(
    function() {
      $( this ).find('.iconlist_icon').addClass('tada');
    }, function() {
      $( this ).find('.iconlist_icon').removeClass('tada');
    }
  );
});