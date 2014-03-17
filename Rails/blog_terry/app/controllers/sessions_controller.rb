class SessionsController < ApplicationController
  # login page
  def new
  end

  # login logic
  def create
    @user = User.authenticate(params[:username], params[:password]);    
    if @user
      flash[:notice] = "Welcome #{@user.username}"
      session[:user_id] = @user.id
      redirect_to posts_path
    else
      flash[:notice] = "Login failed."
      redirect_to new_session_path
    end
  end
end
