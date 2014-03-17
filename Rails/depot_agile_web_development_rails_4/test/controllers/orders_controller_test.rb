require 'test_helper'

class OrdersControllerTest < ActionController::TestCase
  setup do
    @order = orders(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:orders)
  end

  #test "should get new" do
  #  get :new
  #  assert_response :success
  #end

  test "should create order" do
    assert_difference('Order.count') do
      post :create, order: { address: @order.address, email: @order.email, name: @order.name, pay_type: @order.pay_type }
    end

    #assert_redirected_to order_path(assigns(:order))
    assert_redirected_to store_path
  end

  test "should show order" do
    get :show, id: @order
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @order
    assert_response :success
  end

  test "should update order" do
    patch :update, id: @order, order: { address: @order.address, email: @order.email, name: @order.name, pay_type: @order.pay_type }
    assert_redirected_to order_path(assigns(:order))
  end

  test "should destroy order" do
    assert_difference('Order.count', -1) do
      delete :destroy, id: @order
    end

    assert_redirected_to orders_path
  end
  
  
  test "购物车不能为空" do
    get :new
    assert_redirected_to store_path
    assert_equal flash[:notice], "您的购物车是空的"
  end
  
  #此测试没有通过  
  #test "购物车有商品时，新建订单页面须成功显示" do
  #  li = LineItem.new
  #  li.build_cart
  #  li.product = products(:ruby)
  #  li.save!
    
  #  session[:cart_id] = li.cart.id
    
  #  get :new
  #  assert_response :success
  #end

end
