arr = []

i = 0
for i in 1..100
    arr << i
    # i += 1
end

arr.collect! { |e|  
    e *= 100
}
p arr