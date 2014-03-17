arr = []

i = 0
for i in 1..100
    arr << i
    # i += 1
end

def belongs?(item, array)
    count = 0
    array.each { |e|  
        if item == e
            # return true
            # exit
            count += 1
        end
    }
    if count > 0
        return true
    else
        return false
    end
end

meta = []
new_arr = []
for j in 0...arr.length
    rd = rand(100)
    if !belongs?(rd, meta)
        meta << rd
        new_arr << arr[rd]
    else
        redo
    end
end


# p meta.length
p new_arr
# p new_arr.sort.size
# p arr.size
