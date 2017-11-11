/*
# =============================================================================
#   Sparkline Linechart JS
# =============================================================================
*/


(function() {

  var linechartResize;

  linechartResize = function() {
    $("#linechart-1").sparkline([160, 240, 120, 200, 180, 350, 230, 200, 280, 380, 400, 360, 300, 220, 200, 150, 40, 70, 180, 110, 200, 160, 200, 220], {
      type: "line",
      width: "100%",
      height: "226",
      lineColor: "#a5e1ff",
      fillColor: "rgba(241, 251, 255, 0.9)",
      lineWidth: 2,
      spotColor: "#a5e1ff",
      minSpotColor: "#bee3f6",
      maxSpotColor: "#a5e1ff",
      highlightSpotColor: "#80cff4",
      highlightLineColor: "#cccccc",
      spotRadius: 6,
      chartRangeMin: 0
    });
    
    $("#linechart-2").sparkline([[1,230],[2,230],[4,340],[5,120],[6,123],[8,145],[9,560],[10,12],[11,23],[12,256],[13,78],[14,236],[15,145]], {
      type: "line",
      width: "100%",
      height: "226",
      lineColor: "#a5e1ff",
      fillColor: "rgba(241, 251, 255, 0.9)",
      lineWidth: 2,
      spotColor: "#a5e1ff",
      minSpotColor: "#bee3f6",
      maxSpotColor: "#a5e1ff",
      highlightSpotColor: "#80cff4",
      highlightLineColor: "#cccccc",
      spotRadius: 6,
      chartRangeMin: 0
    });
  };
    
  
  $(document).ready(function() {
    $('.select2able').select2();
    /*
    # =============================================================================
    #   Sparkline Linechart JS
    # =============================================================================
    */

    var $alpha, $container, $container2, addEvent, buildMorris, checkin, checkout, d, date, handleDropdown, initDrag, m, now, nowTemp, timelineAnimate, y;
    
   
    /*
    # =============================================================================
    #   Navbar scroll animation
    # =============================================================================
    */

    $(".navbar.scroll-hide").mouseover(function() {
      $(".navbar.scroll-hide").removeClass("closed");
      return setTimeout((function() {
        return $(".navbar.scroll-hide").css({
          overflow: "visible"
        });
      }), 150);
    });
    $(function() {
      var delta, lastScrollTop;
      lastScrollTop = 0;
      delta = 50;
      return $(window).scroll(function(event) {
        var st;
        st = $(this).scrollTop();
        if (Math.abs(lastScrollTop - st) <= delta) {
          return;
        }
        if (st > lastScrollTop) {
          $('.navbar.scroll-hide').addClass("closed");
        } else {
          $('.navbar.scroll-hide').removeClass("closed");
        }
        return lastScrollTop = st;
      });
    });
    /*
    # =============================================================================
    #   Mobile Nav
    # =============================================================================
    */

    $('.navbar-toggle').click(function() {
      return $('body, html').toggleClass("nav-open");
    });
  

    /*
    # =============================================================================
    #   Bootstrap Tabs
    # =============================================================================
    */

    $("#myTab a:last").tab("show");
    /*
    # =============================================================================
    #   Bootstrap Popover
    # =============================================================================
    */

    $("#popover").popover();
    $("#popover-left").popover({
      placement: "left"
    });
    $("#popover-top").popover({
      placement: "top"
    });
    $("#popover-right").popover({
      placement: "right"
    });
    $("#popover-bottom").popover({
      placement: "bottom"
    });
    /*
    # =============================================================================
    #   Bootstrap Tooltip
    # =============================================================================
    */

    $("#tooltip").tooltip();
    $("#tooltip-left").tooltip({
      placement: "left"
    });
    $("#tooltip-top").tooltip({
      placement: "top"
    });
    $("#tooltip-right").tooltip({
      placement: "right"
    });
    $("#tooltip-bottom").tooltip({
      placement: "bottom"
    });
//date picker
    $('.datepicker').datepicker({
      format: "yyyy-mm-dd",
    });
    
    linechartResize();
    $(window).resize(function() {
      return linechartResize();
    });
    
    
  });

}).call(this);
