/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        //Smooth Slider
        var sections = $('section'),
          nav = $('nav'),
          nav_height = nav.outerHeight();
          //console.log(nav_height);
        $(window).on('scroll', function () {
          var cur_pos = $(this).scrollTop();
          sections.each(function() {
            var top = $(this).offset().top - nav_height,
                bottom = top + $(this).outerHeight();
            
            if (cur_pos >= top && cur_pos <= bottom) {
              nav.find('a').parent('li').removeClass('active');
              sections.parent('li').removeClass('active');
              $(this).parent('li').addClass('active');
              nav.find('a[href="#'+$(this).attr('id')+'"]').parent('li').addClass('active');
            }
          }); 
        });
        $('nav').find('a').on('click', function () {
          var $el = $(this),
              id = $el.attr('href');
              var str = location.href;

              //console.log( nav.find('a').attr("href") );
              //going home or from blog
              if( str.indexOf("blog") > 0 && id === "#blog") {
                   //console.log(id+" nothing at all!");
              } else {
                //console.log('----'+id.indexOf("?"));
                //console.log('----'+window.location.href.indexOf("?s"));

                if(id.indexOf("#") >= 0 && window.location.href.indexOf("?s") < 0){
                  $('html, body').animate({
                      scrollTop: $(id).offset().top - (nav_height-1)
                    }, 500);
                    window.location.hash = id;
                    //console.log("animate yow!");
                    return false;
                } else  {
                    var x = window.location.hostname;
                    var y = window.location.protocol;
                    console.log(y + x + id);


                   window.location = y + '//' + x + id;
                  }        
              }
         
        });

        $(document).ready(function(){ 
          if(window.location.hash.length >= 1) {
            var str = window.location.hash.split("#")[1].split('-')[0];
            if(str){
              str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                  return letter.toUpperCase();
              });
            }
            jQuery("#menu-main-menu li a:contains("+str+")").click();
           }
        }); 

        var urlHome = window.location.href;
        if ( urlHome === "http://localhost/lawn-griffiths") {
          jQuery("nav li.fa-home").addClass('active');
        }
        //End Smooth Slider
        //Header Span
        $('.lastWord').each(function() {
          var $this = $(this);
          $this.html($this.html().replace(/(\S+)\s*$/, '<span>$1</span>'));
        });
        //End Header Span
        //Wow JS
        wow = new WOW(
          {
            mobile: false     // default
          }
        );
        wow.init();
        //End Wow JS
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
        //MailPoet
          $(".mailpoetsignup").replaceWith(function() {
                return "<label class='wpcf7-form-control-wrap mailpoetsignup'>" + this.innerHTML + "</label>";
          });
          $(".mailpoetsignup label").replaceWith(function() {
              return "<span>" + this.innerHTML + "</span>";
          });
        //End MailPoet        
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
