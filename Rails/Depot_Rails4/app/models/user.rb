class User < ActiveRecord::Base
  validates :name, presence: true, uniqueness: true
  has_secure_password
  after_destroy :ensure_at_least_one_admin_exists


  private
    def ensure_at_least_one_admin_exists
      if User.count.zero?
        raise "can't delete the last admin"
      end
    end
end
