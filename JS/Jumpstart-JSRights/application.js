// $(function(){
//   var back_to_top = "<a href='#top'>Back to Top</a>";
//   $('div.article').append(back_to_top);
//   var toc = "<h2 id='toc'><a name='toc'>Table of Contents</a></h2>";
//   $('h1').after(toc);
//   $('h2:first').after("<ul id='toc'></ul>");
//   $('div.article h2').each(function(){
//     var text = $(this).text();
//     var slug = text.trim().toLowerCase().replace(' ', '_');
//     var list_item = "<li><a href='#" + slug + "'>" + text + "</a></li>";
//     $('ul#toc').append(list_item);
//     var target_anchor = "<a name='" + slug + "'></a>";
//     $(this).before(target_anchor);



//     var toggle_link = $("<a href='#'>(hide)</a>");
//     $(this).after(toggle_link);
//     toggle_link.on('click', function(e){
//       e.preventDefault();
//       $(this).siblings('p').toggle();
//       var new_text = $(this).text() === '(hide)' ? "(show)" : "(hide)";
//       $(this).text(new_text);
//     });
//   });
// });

$.fn.tableOfContents = function(header){
  var back_to_top = "<a href='#top'>Back to Top</a>";
  this.append(back_to_top);
  var toc = "<h2 id='toc'><a name='toc'>Table of Contents</a></h2>";
  header.after(toc);
  $('h2:first').after("<ul id='toc'></ul>");
  this.find('h2').each(function(){
    var text = $(this).text();
    var slug = text.trim().toLowerCase().replace(' ', '_');
    var list_item = "<li><a href='#" + slug + "'>" + text + "</a></li>";
    $('ul#toc').append(list_item);
    var target_anchor = "<a name='" + slug + "'></a>";
    $(this).before(target_anchor);
    var toggle_link = $("<a href='#'>(hide)</a>");
    $(this).after(toggle_link);
    toggle_link.on('click', function(e){
      e.preventDefault();
      $(this).siblings('p').toggle();
      var new_text = $(this).text() === '(hide)' ? "(show)" : "(hide)";
      $(this).text(new_text);
    });
  });
};


$(function(){
  $("div.article").tableOfContents($('h1'));
});