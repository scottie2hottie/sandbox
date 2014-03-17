require 'test_helper'

class CartTest < ActiveSupport::TestCase
  # test "the truth" do
  #   assert true
  # end
  
  def new_cart_with_one_product(product_name)
    cart = Cart.create
    cart.add_product(products(product_name).id, products(product_name).price)
    cart
  end
  
  test "添加不同的产品到购物车，车内产品种类数量会增加" do
    cart = new_cart_with_one_product(:one)
    assert_equal 1, cart.line_items.size
    
    cart.add_product(:two, products(:two).price)
    assert_equal 2, cart.line_items.size
    
    cart.add_product(:ruby, products(:ruby).price)
    assert_equal 3, cart.line_items.size
  end
  
  test "添加相同的产品到购物车，车内产品种类数量不变" do
    cart = new_cart_with_one_product(:one)
    assert_equal 1, cart.line_items.size
    
    cart.add_product(products(:one).id, products(:one).price)
    cart.add_product(products(:one).id, products(:one).price)
    cart.add_product(products(:one).id, products(:one).price)
    #assert_equal 2, cart.line_items.size
    
  end
end
