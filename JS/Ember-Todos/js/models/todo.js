App.Todo = DS.Model.extend({
  title: DS.attr('string'),
  isCompleted: DS.attr('boolean')
});

App.Todo.FIXTURES = [
{
  id: '1',
  title: "learn ember js",
  isCompleted: true
},{
  id: '2',
  title: "practice ember js",
  isCompleted: false
},{
  id: '3',
  title: "build ambitious web app",
  isCompleted: false
}];