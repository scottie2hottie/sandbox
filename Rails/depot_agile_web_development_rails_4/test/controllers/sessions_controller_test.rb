require 'test_helper'

class SessionsControllerTest < ActionController::TestCase
  test "should get new" do
    get :new
    assert_response :success
  end

  test "应该登录成功" do
    user1 = users(:one)
    post :create, name: user1.name, password: 'secret'
    assert_redirected_to admin_url
    assert_equal session[:user_id], user1.id
  end

  test "应该登录失败" do
    user1 = users(:one)
    post :create, name: user1.name, password: 'wrongpassword'
    assert_redirected_to login_url
  end
  
  test "应该退出成功" do
    delete :destroy
    assert_redirected_to store_url
    assert_equal session[:user_id], nil
  end
  
end
