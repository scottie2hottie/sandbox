arr1 = [1, 2, 3, 4, 5]
arr2 = [10, 20, 30, 40, 50]
arr3 = [100, 200, 300, 400, 500]

i = 0
result = []
while i < arr1.length
    result << arr1[i] + arr2[i] + arr3[i]
    i += 1
end

p result