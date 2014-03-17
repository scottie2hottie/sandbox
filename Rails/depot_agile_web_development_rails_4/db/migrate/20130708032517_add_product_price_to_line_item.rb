class AddProductPriceToLineItem < ActiveRecord::Migration
  def up
    add_column :line_items, :price, :decimal, precision: 8, scale: 2
    
    say_with_time "Adding price to line_items" do
      #LineItem.reset_column_information
      LineItem.all.each do |i|
        i.update_attributes price: i.product.price
      end
    end
  end
  
  def down
    remove_column :line_items, :price
  end
end
