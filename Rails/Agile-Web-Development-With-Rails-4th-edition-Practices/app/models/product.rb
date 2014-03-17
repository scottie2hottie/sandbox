class Product < ActiveRecord::Base
  default_scope :order => 'title'
  attr_accessible :description, :image_url, :price, :title
  validates :title, :description, :image_url, :price, :presence => true
  validates :price, :numericality => {:greater_than_or_equal_to => 0.01}
  validates :title, :uniqueness => true, :length => {:minimum => 10}
  validates :image_url, :format => {
    :with => %r{\.(gif|png|jpg)$}i,
    :message => '必须是图片文件(gif|png|jpg)'
  }
  has_many :line_items
  before_destroy :ensure_not_referenced_by_any_line_item

  private
    def ensure_not_referenced_by_any_line_item
      if line_items.empty?
        return true
      else
        errors.add(:base, 'Line Items Present')
        return false
      end
    end
    
end
