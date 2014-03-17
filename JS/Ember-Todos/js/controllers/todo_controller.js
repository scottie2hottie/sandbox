App.TodoController = Ember.ObjectController.extend({
  isCompleted: function(key, value) {
    var model = this.get('model');

    if (value === undefined) {
      return model.get('isCompleted');
    } else {
      model.set('isCompleted', value).save();
      return value;
    }
  }.property('model.isCompleted'),
  isEditing: false,
  editTodo: function() {
    this.set('isEditing', true);
  },
  saveChanges: function() {
    this.set('isEditing', false);
    this.get('model').save();
  },
  removeTodo: function() {
    var model = this.get('model');
    model.deleteRecord();
    model.save();
  }
});