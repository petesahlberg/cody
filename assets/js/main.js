jQuery(function($){

'use strict';

var cody = window.cody || {};

var mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);


/*////// NAVIGATION //////*/

cody.navigation = function() {


  var element = $('.main-navigation'),
  button = $('.menu-toggle'),
  body = $('body');

  element.mousedown(function(e){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    e.preventDefault();
    }
  });

  button.click(function() {

    body.addClass('lock');

  //  if($('body').hasClass('custom-background')) {
      var bodycolor = $('body').css('background-color');
      $('.main-navigation').css('background-color', bodycolor);

  //  }

    var bg_color = $('body').css('background-color');

    //element.css('background-color', bg_color);

    if(!$('body').hasClass('home')) {

    if($(this).hasClass('toggled')) {
      element.fadeOut(100);
      body.removeClass('lock');
    //  button.html('Menu');
      button.fadeIn(50);
      $(this).removeClass('toggled');
    } else {
      button.fadeOut(100);
      //button.html('Close')
      element.fadeIn(50);
      $(this).addClass('toggled');
      }
    }
  });

  // close if BG is clicked
  element.find('a').on('click', function(e) {
    e.stopPropagation();
  });
  $('html').on('.click', '#primary-menu a', function(e) {
    e.stopPropagation();
  });
  element.click(function() {
    if(!$('body').hasClass('home')) {
        //button.html('Menu');
      element.fadeOut(100);
      button.fadeIn(50);
      button.removeClass('toggled');
      body.removeClass('lock');
    }
  });
}

/*////// Home Hover  ////*/

cody.homeHover = function() {

  if(mobile) {
    //do nothing
  } else {

  var menu = $('#primary-menu'),
      nav = $('.main-navigation .archive-bg'),
      link = menu.find('a'),
      images = [];

  menu.find('img').each(function() {
      var src = $(this).attr('src');
      images.push(src);
  });

  //console.log(images);

  link.each(function(i) {
    $(this).hover(function() {
    menu.find('*').not(this).css('opacity', '.2');
    $(this).css('opacity', '1');
    nav.css('background-image','url('+images[i]+')');
    }, function() {
      nav.css('background-image','none');
      menu.find('*').not(this).css('opacity', '1');
      });
    });
  }
}

//*// CREATE CODY LINK //*////

cody.introLink  = function() {
  function findText(element, pattern, callback) {
    for (var childi= element.childNodes.length; childi-->0;) {
        var child= element.childNodes[childi];
        if (child.nodeType==1) {
            findText(child, pattern, callback);
        } else if (child.nodeType==3) {
            var matches= [];
            var match;
            while (match= pattern.exec(child.data))
                matches.push(match);
            for (var i= matches.length; i-->0;)
                callback.call(window, child, matches[i]);
        }
    }
  }

  findText($('#primary-menu strong')[0], /\bCody Paulson\b/gi, function(node, match) {
    node.splitText(match.index+match[0].length);
    var link = document.createElement('a');
    link.href = '/';
    link.appendChild(node.splitText(match.index));
    node.parentNode.insertBefore(link, node.nextSibling);
 });
}

/*////// Project Archive Hover  ////*/

cody.archiveHover = function() {
  if(mobile) {
    //do nothing
  } else {
    $('.post-type-archive-project article, .tax-type article').each(function () {
      $(this).hover(function() {
      var bg = $(this).children('.bg-image').css('background-image'),
          bg_color = $(this).find('.archive-bg-color').val();
      $('body').addClass("dark-bg");
      $('.archive-bg').css('background-image', bg);
      $('body, .archive-bg').css('background-color', bg_color);
    },
    function () {
      $('body').removeClass('dark-bg');
      $('.archive-bg').css('background-image','none');
      $('.archive-bg').css('background-color','transparent');
      $('body').css('background-color','');
      }
    );
  });
  }
}


cody.imageMove = function() {
var movementStrength = 25;
var height = movementStrength / $(window).height();
var width = movementStrength / $(window).width();
$("body, html").mousemove(function(e){
  var pageX = e.pageX - ($(window).width() / 2);
  var pageY = e.pageY - ($(window).height() / 2);
  var newvalueX = width * pageX * -1 - 25;
  var newvalueY = height * pageY * -1 - 50;
  $('.sbi_photo_wrap img').css('position','relative').css("top", newvalueX+"px").css("right", +newvalueY+"px");
});
}



/*//////  READ MORE   ///////*/
cody.readMore  = function() {
  $('.read-more').on('click', function(e) {
    e.preventDefault();
    if(!$(this).hasClass('arrow-rotate-up')) {
    $(this).addClass('arrow-rotate-up');
    $(this).find('span').text('Read Less');
    $('.content-more').slideDown(150);
  } else {
    $(this).removeClass('arrow-rotate-up');
    $(this).find('span').text('Read More');
    $('.content-more').slideUp(250);
  }
  });
}

/*//////  FITVIDS  ///////*/


cody.fitVids = function () {
  $("#primary, #content-rows").fitVids();
}


/*//////  PORT CITY  ///////*/
function loadNew() {
  var time = 0;
  $('.port-image:not(:visible):lt(10)').each(function() {
     var data = $(this).find('img').attr('data-image');
      $(this).delay(time).fadeIn(300).find('img').attr('src', data);
      time += 50;
       //$('.port-image:not(.visible):lt(4)').addClass('new-visible');
  });
}


cody.portCity = function () {



  //vars
  var box = $('#lightbox'),
      link =  $('.port-image:visible'),
      close = $('.close'),
      carousel = box.find('.carousel'),
      image = $('.flickity-viewport'),
      compare = [];

      function remove() {
          box.removeClass('appear').css('opacity','');
          carousel.find('.image-wrapper').remove();
          carousel.flickity('destroy');
      }



      var time = 0;
      var count = 0
      $('#page .port-image img').each(function() {
        if(count < 20) {
          var data = $(this).attr('data-image');
          $(this).delay(time).attr('src', data);
          time += 50;
          count++;
        }
           //$('.port-image:not(.visible):lt(4)').addClass('new-visible');
      });



      $(document).on('click', '.port-image:visible', function(e) {

          var index = $(this).attr('index') - 1;
          e.preventDefault();
          box.addClass('appear');
          $('body, html').addClass('lock');
          carousel.addClass('enabled'); // to signify its opened

          var html = [];
          $('.port-image').each(function() {
            var src = $(this).attr('href');
            var markup = '<div class="image-wrapper"><img data-image="'+src+'"/></div>';
            html.push(markup);
          });

          carousel.append(html).flickity({
            selectedAttraction: 0.13,
            friction: 1,
            lazyLoad: true,
            adaptiveHeight: true,
            setGallerySize: false

          });
          //carousel.click();
          carousel.flickity('select',index, true, false);
          carousel.flickity('resize');

          var current = $('.is-selected').find('img').attr('data-image');
          $('.is-selected').find('img').attr('src', current);


      });

      carousel.on('select.flickity', function() {
        var flkty = Flickity.data( '.carousel' );
        var index = flkty.selectedIndex + 1;
        var title = $('.port-image[index='+index+']').attr('data-title');
        var current = $('.is-selected').find('img').attr('data-image');
        var next = $('.is-selected').next().find('img').attr('data-image');
        var prev =  $('.is-selected').prev().find('img').attr('data-image');
        var nextNext = $('.is-selected').next().next().find('img').attr('data-image');
        var prevPrev =  $('.is-selected').prev().prev().find('img').attr('data-image');
        $('.is-selected').find('img').attr('src', current);
        $('.is-selected').prev().find('img').attr('src', prev);
        $('.is-selected').next().find('img').attr('src', next);
        $('.is-selected').prev().prev().find('img').attr('src', prevPrev);
        $('.is-selected').next().next().find('img').attr('src', nextNext);
        //console.log(title);
        $('p.title').text(title);
        $('.close + a').attr('href',' mailto:cody@codypaulson.com?subject=I%27d%20Like%20To%20Purchase%20"'+title+'"%20From%20Port%20City%20Supply%20Co.');
        if(index % 10  == 0) {
          loadNew();
          console.log('divisible');
        }
      });


      // append stuff


      // close lightbox
      close.on('click', function(e) {
        e.preventDefault();
        box.css('opacity','0');
        carousel.removeClass('enabled');
        $('body, html').removeClass('lock');
        setTimeout(function(){ remove(); }, 300);
        compare = [];
      });


      if(!mobile) {
        box.on('click', function() {
          if(window.innerWidth >= 769) {
            if($('#lightbox').hasClass('cursor-left')) {
              console.log('yep');
             carousel.flickity( 'previous');
            } else {
             carousel.flickity( 'next');
              }
            }
          });
        }

        box.find('a').on('click', function(e) {
          e.stopPropagation();
        });

}



cody.portNav = function() {
  var box = $("#lightbox");
  box.on('mousemove', function(e) {
    var mouseSide;
    if ((e.pageX - this.offsetLeft) < $(this).width() / 2) {
        mouseSide = 'L';
        box.addClass('cursor-left');
        box.removeClass('cursor-right');
    } else {
        mouseSide = 'R';
        box.addClass('cursor-right');
        box.removeClass('cursor-left');
    }
  //  console.log(mouseSide);
  });

  $('#to-top.port-to-top a').click(function(e) {
    e.preventDefault();
    // $(this).closest('nav').fadeOut(150);
    $('html, body').animate({
       scrollTop: 0
   },500, 'easeOutExpo');

  });

}

cody.portNavTop = function() {
  var windOw = $(window);
  var height = windOw.height() / 1.5;
  var el = $('.port-to-top');
  if(windOw.scrollTop() > height) {
    el.addClass('port-nav-appear');
  } else {
    el.removeClass('port-nav-appear');
  //  setTimeout(function(){ el.css('opacity','0'); }, 300);
  }

}

cody.portNavInfinityScroll = function() {
    var img = $('.port-image');
    $('.port-image:visible').addClass('visible');
  if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight - 10) {
    //$('body').css('-webkit-overflow-scrolling','auto');
     // you're at the bottom of the page
    // var time = 0;
     loadNew();
   }

}

function animateValue(id, start, end, duration) {
// assumes integer values for start and end

var obj = document.getElementById(id);
var range = end - start;
// no timer shorter than 50ms (not really visible any way)
var minTimer = 10;
// calc step time to show all interediate values
var stepTime = Math.abs(Math.floor(duration / range));

// never go below minTimer
stepTime = Math.max(stepTime, minTimer);

// get current time and calculate desired end time
var startTime = new Date().getTime();
var endTime = startTime + duration;
var timer;

function run() {
    var now = new Date().getTime();
    var remaining = Math.max((endTime - now) / duration, 0);
    var value = Math.round(end - (remaining * range));
    obj.innerHTML = value;
    console.log(value);
    if (value == end) {
        clearInterval(timer);
    }
}

timer = setInterval(run, stepTime);
run();
}

/*//////  PRE-LOADER  ///////*/

cody.pageLoad = function() {
  if(document.contains(document.getElementById("counter"))) {
  (function () {
      var _loaded = []
      ,   _progress = 0
      ,   _loadedPara = null
      ,   _loadingBar = null;


      document.getElementById("counter").style.display = 'block';

      var prev = ['0'];

      function render(num) {

        var calc = num - prev;
        var i;
        var previous = parseFloat(prev[0]);

        //console.log(previous);
        //console.log(num);

        if(num <= 100 && previous < num) {
          if(num > 100 || prev > 100) {
            animateValue("counter", 95, 100, 200);
          } else {
            animateValue("counter", previous, num, 200);
          }
        }

        prev = [];

      }

      RealProgress.onResourceLoad = function (name) {
          _loaded.push(name.split("/").pop());
          //console.log(name);
      };

      RealProgress.onProgress = function (progress) {
          _progress = progress;
          _progress = _progress * 100;
          _progress = _progress.toString();
          _progress = _progress.split('.');
          _progress = _progress[0];
          var num = _progress
          //console.log(num);
          render(num);
          prev.push(num);
      };

      RealProgress.onLoad = function (uncaptured) {
          setTimeout(function() {
           document.getElementById("counter").style.opacity = '0';
          jQuery('body.load #page').addClass('fade-in');
           }, 600 );
          console.log(_loaded);
      };
  })();

  RealProgress.init({

  });
  }
 }


jQuery(window).scroll(function() {
  cody.portNavTop();
  cody.portNavInfinityScroll();
});

jQuery(document).ready(function($) {

if (window.performance) {

  var type = performance.navigation.type;
  //console.log(type);
  var home = $('body').hasClass('home');
  var proj = $('body').hasClass('post-type-archive-project');
  var cat = $('body').hasClass('tax-type');
  var img = $('body').hasClass('post-type-archive-image');

  if ( type == 0 )  {
      if($('body').hasClass('home') && !sessionStorage.getItem("seen_home")) {
      cody.pageLoad();
      sessionStorage.setItem( 'seen_home', true );
      console.log('home load');
    } else if($('body').hasClass('post-type-archive-project') && !sessionStorage.getItem( 'seen_proj' )) {
      cody.pageLoad();
      console.log('project load');
      sessionStorage.setItem( 'seen_proj', true );

    } else if($('body').hasClass('tax-type') && !sessionStorage.getItem( 'seen_cat' )) {
      cody.pageLoad();
      console.log('tax load');
      sessionStorage.setItem( 'seen_cat', true );

    } else if($('body').hasClass('post-type-archive-image') && !sessionStorage.getItem( 'seen_img' )) {
      console.log('img load');
      cody.pageLoad();
      sessionStorage.setItem( 'seen_img', true );

    } else {
      $('body.load #page, body.load').css('opacity','1').css('transition','none').css('pointer-events','all');
      $('body.load #counter').hide();
    }
  }  else {
      $('body.load #page, body.load').css('opacity','1').css('transition','none').css('pointer-events','all');
      $('body.load #counter').hide();
      //cody.pageLoad();
    }
}


//cody.pageLoad();

cody.navigation();

cody.archiveHover();
cody.homeHover();
cody.fitVids();
cody.portCity();
cody.portNav();
cody.portNavTop();
cody.readMore();
cody.portNavInfinityScroll();
//cody.introLink();
//cody.imageMove();

}); /// End Document Ready

$(window).resize(function() {
  cody.archiveHover();
  cody.homeHover();
  //cody.portCity();
  //cody.portNavResize();
  //$('.flickity-slider').reposition();
});

}); /// End jQuery
