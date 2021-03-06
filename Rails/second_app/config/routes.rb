SecondApp::Application.routes.draw do

  # get "users/new"
  resources :users

  root to: "static_pages#home"

  # get "static_pages/home"
  # get "static_pages/help"
  # get "static_pages/about"
  # get "static_pages/contact"
  
  match '/home', to: 'static_pages#home'
  match '/help', to: 'static_pages#help'
  match '/about', to: 'static_pages#about'
  match '/contact', to: 'static_pages#contact'

  match '/signup', to: 'users#new'
end
