# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the rake db:seed (or created alongside the db with db:setup).
#
# Examples:
#
#   cities = City.create([{ name: 'Chicago' }, { name: 'Copenhagen' }])
#   Mayor.create(name: 'Emanuel', city: cities.first)
admin = User.new(:email => "cisolarix@gmail.com", :password => "yuyouleon", :password_confirmation => "yuyouleon")
admin.is_admin = true
admin.save!

normal_user = User.new(:email => "doudou@dd.com", :password => "yuyouleon", :password_confirmation => "yuyouleon")
normal_user.save!

board = Board.create!(:name => "System announcement")
post = board.posts.build(:title => "This site has been shut down temporarily!!!", :content => "RT")
post.user_id = admin.id
post.save!


