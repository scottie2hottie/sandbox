class StoreController < ApplicationController
  include CurrentCart
  before_action :set_cart
  skip_before_action :authorize
  
  def index
    @products = Product.order(:title)
    @counter = increment_counter()
  end
  
  protected
  def increment_counter
    if session[:counter].nil?
      session[:counter] = 1
    else
      session[:counter] += 1
    end
    session[:counter]
  end
end
