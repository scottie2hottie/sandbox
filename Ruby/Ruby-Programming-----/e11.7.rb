arr = []

i = 0
for i in 1..100
    arr << i
    # i += 1
end

result = []
10.times{|i|
    result << arr[i*10, 10]
}
p result