arr = []

i = 0
for i in 1..100
    arr << i
    # i += 1
end

# p arr.reverse
# p arr.sort { |a, b|  
#     b <=> a
# }

p arr.sort_by { |e|  
    -e
}