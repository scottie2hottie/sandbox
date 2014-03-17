App.Router.map(function() {
  this.resource('todos', {path: '/'}, function() {
    this.route('active');
    this.route('completed');
  });
});

App.TodosRoute = Ember.Route.extend({
  model: function() {
    return App.Todo.find();
  }
});

App.TodosIndexRoute = Ember.Route.extend({
  model: function() {
    return App.Todo.find();
  }
});

App.TodosActiveRoute = Ember.Route.extend({
  model: function(){
    return App.Todo.filter(function (todo) {
      if (!todo.get('isCompleted')) { return true; }
    });
  },
  renderTemplate: function(controller){
    this.render('todos/index', {controller: controller});
  }
});

App.TodosCompletedRoute = Ember.Route.extend({
  model: function(){
    return App.Todo.filter(function (todo) {
      if (todo.get('isCompleted')) { return true; }
    });
  },
  renderTemplate: function(controller){
    this.render('todos/index', {controller: controller});
  }
});