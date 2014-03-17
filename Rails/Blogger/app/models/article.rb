class Article < ActiveRecord::Base
	has_many :comments
  has_many :taggings
  has_many :tags, through: :taggings

  def tags_list
    self.tags.collect do |tag|
      tag.name
    end.join(", ")
  end

  def tags_list=(tags_string)
    tag_names = tags_string.split(",").collect { |t| t.strip.downcase }.uniq
    tags = tag_names.collect { |t| Tag.find_or_create_by(name: t) }
    self.tags = tags
  end
end
