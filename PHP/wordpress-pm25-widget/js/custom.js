jQuery(document).ready(function($) {
  $('#checkPoint').on('click', function(e) {
    e.preventDefault();
    switchDisplayState();
  });

  var switchDisplayState = function() {
    var $checkPointTab = $("#checkPointTab");
    if ($checkPointTab.hasClass("show")) {
      $checkPointTab.removeClass("show").addClass("hide");
      // $checkPointTab.slideDown('100');
    } else{
      $checkPointTab.removeClass("hide").addClass("show");
      // $checkPointTab.slideUp('100');
    };
  };

});