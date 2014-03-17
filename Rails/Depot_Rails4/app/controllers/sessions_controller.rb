class SessionsController < ApplicationController
  skip_before_action :authorize


  def create
    user = User.find_by(name: params[:name])
    if user && user.authenticate(params[:password])
      session[:user_id] = user.id
      redirect_to admin_url
    else
      redirect_to login_url, alert: "Username or password is not correct, please try again"
    end
  end

  def destroy
    session[:user_id] = nil
    redirect_to store_url, notice: "Logged out!"
  end
end
