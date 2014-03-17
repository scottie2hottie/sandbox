arr = []

i = 0
for i in 1..100
    arr << i
    # i += 1
end

#creating new array
arr1 = []
for i in 0...arr.length
    if (arr[i] % 3) == 0
        arr1 << arr[i]
    end
end
#end creating new array

#without creating new array
arr.delete_if { |e|  
    e % 3 != 0
}
#end without creating new array
p arr
p arr1