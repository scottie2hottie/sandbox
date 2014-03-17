list = [1, 3, 5, 7, 9]
sum = 0
list.each_with_index{|elem, i|
    print "the ", i+1, "th element is: ", elem, "\n"
    sum += elem
}
print "the sum is ", sum, "\n"