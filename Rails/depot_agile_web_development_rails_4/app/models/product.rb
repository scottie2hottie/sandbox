class Product < ActiveRecord::Base
  validates :title, :image_url, :description, presence: true
  validates :price, numericality: { greater_than_or_equal_to: 0.01 }
  validates :title, uniqueness: true
  validates :image_url, allow_blank: false, format: {
    with: %r{\.(gif|jpg|jpeg|png|bmp)\Z}i,
    format: "必须是图片文件"
  }
  
  has_many :line_items
  has_many :orders, through: :line_items
  before_destroy :ensure_not_referenced_by_any_line_item
  
  def self.latest
    Product.order(:updated_at).last
  end
  
  private
  def ensure_not_referenced_by_any_line_item
    if line_items.empty?
      return true
    else
      errors.add(:base, "还有 line items 存在")
      return false
    end
  end
end
