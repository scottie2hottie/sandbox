class StoreController < ApplicationController
  def index
    @products = Product.all

    if session[:count].nil?
      session[:count] = 0
    else
      session[:count] += 1
    end

    @show_visit_times = "这是您第" + session[:count].to_s + "次访问该页面" if session[:count] > 5
  end
end
