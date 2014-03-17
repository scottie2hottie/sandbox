require 'test_helper'

class ProductTest < ActiveSupport::TestCase
  fixtures :products

  test "product attributes must not be empty" do
  	product = Product.new
  	assert product.invalid?
  	assert product.errors[:title].any?
  	assert product.errors[:description].any?
  	assert product.errors[:image_url].any?
  	assert product.errors[:price].any?
  end

  test "product price must be positive" do
  	product = Product.new(title: "lorem ipsum", image_url: "asdf.jpg", description: "well.")
  	product.price = -1
		assert product.invalid?
		assert_equal product.errors[:price], ["must be greater than or equal to 0.01"]

  	product.price = 0
		assert product.invalid?
		assert_equal product.errors[:price], ["must be greater than or equal to 0.01"]

  	product.price = 1
		assert product.valid?
  end

  def new_product(image_url)
    Product.new(title: "asdf", description: "sdfdsf", price: 1, image_url: image_url)
  end

  test "image url" do
    ok = %w{fred.gif fred.jpg fred.png FRED.JPG FRED.Jpg http://a.b.c/x/y/z/fred.gif}
    bad = %w{fred.doc fred.gif/more fred.gif.more}
    ok.each do |name|
      assert new_product(name).valid?, "#{name} should be valid"
    end

    bad.each do |name|
      assert new_product(name).invalid?, "#{name} should not be valid"
    end
  end

  test "product not valid when title not unique" do
    product = Product.new(title: products(:one).title, description: "123", price: 1, image_url: "adf.jpg")
    assert product.invalid?
    assert_equal ["has already been taken"], product.errors[:title]
  end

  test "product not valid when title not unique - i18n" do
    product = Product.new(title: products(:one).title, description: "123", price: 1, image_url: "adf.jpg")
    assert product.invalid?
    assert_equal [I18n.translate('errors.messages.taken')], product.errors[:title]
  end

end
