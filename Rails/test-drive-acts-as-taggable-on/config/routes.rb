Taggable::Application.routes.draw do
  resources :articles
  get "tags/:tag", to: "articles#index", as: :tag
end
