var JSTasker = {
  update_counter_span: function(task_category){
    // var list_item_count = $('div#tasks ul').children().not('li.completed').size();
    if (task_category === 'work') {
      var list_item_count = $('div#work_tasks ul').children().not('li.completed').size();
      $('div#work_tasks span#task_counter').text(list_item_count);
    } else if (task_category === 'personal') {
      var list_item_count = $('div#personal_tasks ul').children().not('li.completed').size();
      $('div#personal_tasks span#task_counter').text(list_item_count);
    } 
  },
  sort_tasks: function(task_category) {
    if (task_category === 'work') {
      if ($('div#work_tasks li').size() > 1) {
        $('div#work_tasks li.completed').fadeOut('slow', function(){
          $(this).detach().appendTo('div#work_tasks ul#task_list').hide().fadeIn(1000);
        });
      };
    } else if (task_category === 'personal') {
      if ($('div#personal_tasks li').size() > 1) {
        $('div#personal_tasks li.completed').fadeOut('slow', function(){
          $(this).detach().appendTo('div#personal_tasks ul#task_list').hide().fadeIn(1000);
        });
      };
    } 

  },
  update_page: function(task_category) {
    this.update_counter_span(task_category);
    this.sort_tasks(task_category)
  }
};

$(function(){
  $('#task_text').focus();
  JSTasker.update_page();

  $('form#add_task').on('submit', function(e){
    e.preventDefault();
    var input_ = $('#task_text'), select = $('select#task_category');
    var input_data = input_.val(), select_data = select.val();

    if (input_data !== '') {
      var list_item = "<li><span class='collapse'>-</span><span id='item'>" + input_data + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'>delete</a></span></li>";
      if (select_data === '1') {
        //personal tasks
        $(list_item).prependTo('div#personal_tasks ul#task_list').hide().fadeIn(1000);
        JSTasker.update_page('personal');
      } else if(select_data === '2') {
        //work tasks
        $(list_item).prependTo('div#work_tasks ul#task_list').hide().fadeIn(1000);
        JSTasker.update_page('work');
      }
      
      input_.val('').focus();
    };
  });

  $('div#work_tasks li').live('click', function(e){
    e.preventDefault();
    $(this).toggleClass('completed');
    JSTasker.update_page('work');
  });

  $('div#personal_tasks li').live('click', function(e){
    e.preventDefault();
    $(this).toggleClass('completed');
    JSTasker.update_page('personal');
  });

  $('li a').live('click', function(e){
    e.preventDefault();e.stopPropagation();
    var closest_li = $(this).closest('li');
    // console.log($.type(closest_li));
    closest_li.remove();
  });

  $('a#check_all').live('click', function(e){
    e.preventDefault();
    $('li').each(function(){
      $(this).addClass('completed');
    });
  });

  $('a#uncheck_all').live('click', function(e){
    e.preventDefault();
    $('li').each(function(){
      $(this).removeClass('completed');
    });
  });

  $('#task_list span.collapse').live('click', function(e){
    e.preventDefault();e.stopPropagation();
    var original_text = $(this).text();
    var new_text;
    if (original_text === '-') {
      new_text = '+';
      $(this).text(new_text);
      $(this).siblings('span#item').slideUp();
    } else if (original_text === '+') {
      new_text = '-';
      $(this).text(new_text);
      $(this).siblings('span#item').slideDown(1000, function(){
        $(this).css('display', '');
      });
    }
  });

});