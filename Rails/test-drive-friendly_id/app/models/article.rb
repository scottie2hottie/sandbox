class Article < ActiveRecord::Base
  #def to_param
  #  "#{id} #{name}".parameterize
  #end
  extend FriendlyId
  friendly_id :name, use: :slugged
end
