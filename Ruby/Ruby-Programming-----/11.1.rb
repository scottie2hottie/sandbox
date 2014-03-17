# arr = Array.new
# p arr
# arr = Array.new(5)
# p arr
# arr = Array.new(5, 1)
# p arr

# lang = %w(Ruby Perl Python)
# p lang

# color = {"a"=>"000", "b"=>"111", "c"=>"222"}
# p color.to_a


# text = "This is, a, test text example."
# p text.split(',')
# a = [1, 2, 3, 4, 5]
# a.reverse!
# a = [2, 4, 3, 5, 1]
# p a.sort

# p a

# a = [1, 2, 3, 4, 5]
# b = a.collect{|i|
#     i += 2
# }
# p b


=begin
a = "foo\nbar\nbaz"
b = a.collect{|i|
    i.upcase
}
p b
=end

list = ["a", "b", "c", "d"]
for i in 0...list.length
    print "the ", i+1, "th element is: ", list[i], "\n"
end