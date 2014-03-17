ForumDemo::Application.routes.draw do
  devise_for :users

  root :to => 'boards#index'

  resources :boards do
    resources :posts
  end

  namespace :admin do
    resources :boards do
      resources :posts
    end
  end
  
end
