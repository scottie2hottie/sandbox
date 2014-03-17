arr = []

i = 0
for i in 1..100
    arr << i
    # i += 1
end

sum = 0
arr.each { |e|  
    sum += e
}

p sum