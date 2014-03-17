App.EditTodoView = Ember.TextField.extend({
  classNames: ['edit'],

  insertNewline: function() {
    this.get('controller').saveChanges();
  },
  focusOut: function() {
    this.get('controller').saveChanges();
  },
  didInsertElement: function() {
    this.$().focus();
  }
});