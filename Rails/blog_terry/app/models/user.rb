class User < ActiveRecord::Base
  attr_accessible :hashed_password, :salt, :username, :password
  validates :username, presence: true

  def password
    @password
  end

  def password=(pass)
    return unless pass
    @password = pass
    generate_password(pass)
  end

  def self.authenticate(username, password)
    user = User.find_by_username(username)
    if user && Digest::SHA256.hexdigest(password + user.salt) == user.hashed_password
      user
    else
      false
    end
  end

  private
  def generate_password(pass)
    salt = Array.new(10){rand(1024).to_s(36)}.join
    self.salt, self.hashed_password = 
      salt, Digest::SHA256.hexdigest(pass + salt)
  end
end
