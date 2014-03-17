// App.Store = DS.Store.extend({
//   adapter: 'DS.FixtureAdapter'
// });

App.Store = DS.Store.extend({
  adapter: 'App.LSAdapter'
});

App.LSAdapter = DS.LSAdapter.extend({
  namespace: "todos-emberjs"
});