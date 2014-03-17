def test_throw
    throw :test
end

puts "start"
catch(:test){
    puts "before test_throw"
    test_throw()
    puts "after test_throw"
}
puts "end"