class Order < ActiveRecord::Base
  PAYMENT_TYPES = ["信用卡", "网银", "邮局转账", "货到付款"]

  validates :name, :address, :email, presence: true
  validates :pay_type, inclusion: PAYMENT_TYPES

  has_many :line_items, dependent: :destroy

  def add_line_items_from_cart(cart)
    cart.line_items.each do |item|
      item.cart_id = nil
      line_items << item
    end
  end
end
