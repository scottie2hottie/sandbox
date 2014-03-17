FactoryGirl.define do
  factory :user do
    name "Michael Hartl"
    email "mh@gmail.com"
    password "foobar"
    password_confirmation "foobar"
  end
end