def sum_array(arr1 = [], arr2 = [])
    result = []
    arr1.zip(arr2) { |a, b|  
        result << a + b
    }
    return result
end

p sum_array([1, 2, 3], [4, 6, 8])