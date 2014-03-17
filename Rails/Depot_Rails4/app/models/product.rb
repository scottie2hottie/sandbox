class Product < ActiveRecord::Base
	has_many :line_items
  has_many :orders, through: :line_items
	before_destroy :ensure_not_referenced_by_line_items

	validates :title, :description, :image_url, presence: true
	validates :price, numericality: { greater_than_or_equal_to: 0.01 }
	validates :title, uniqueness: true
	validates :image_url, allow_blank: true, format: {
		with: %r{\.(gif|jpg|jpeg|png)\Z}i,
		message: "must be gif,jpg,png file"
	}

  def self.latest
    Product.order(:updated_at).last
  end

  private
  	def ensure_not_referenced_by_line_items
  		if line_items.any?
  			# errors.add(:base, '有订单项引用此产品')	#中文不行？
  			errors.add(:base, 'Line Items present')
  			return false
  		else
  			return true
  		end
  	end
end