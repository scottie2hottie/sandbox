class Micropost < ActiveRecord::Base
  belongs_to :user
  validates :content, :length => {:maximum => 10}
  attr_accessible :content, :user_id
end
