class AddAccountToPosts < ActiveRecord::Migration
  def self.up
    change_table :posts do |t|
      t.integer :account_id
    end

    # first_user = Account.first
    # Post.all.each { |p|
    #   p.update_attributes(:account, first_user)
    # }
  end



  def self.down
    change_table :posts do |t|
      t.remove :account_id
    end
  end
end
