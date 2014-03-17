

def balanced?(arr)
    tmp_arr = []
    for i in 0...arr.length
        if arr[0] == ")" || arr[0] == "}"
            return false
            # return 1
            exit
        end
        tmp_arr << arr[i]
        # p tmp_arr
        # p tmp_arr[tmp_arr.length-1]
        # p paried?(arr[i], tmp_arr[tmp_arr.length-2])
        if paried?(arr[i], tmp_arr[tmp_arr.length-2])
            tmp_arr.pop
            tmp_arr.pop
        end
    end
    # p tmp_arr
    # p tmp_arr[tmp_arr.length-1]
    if tmp_arr.length == 0
        return true
        # return 2
    else
        return false
        # return 3
    end
end

def paried?(bracket, tail)
    case bracket
    when "("
        if tail == ")"
            return true
            # return 1
        else
            return false
            # return 2
        end
    when ")"
        if tail == "("
            return true
            # return 3
        else
            return false
            # return 4
        end
    when "{"
        if tail == "}"
            return true
            # return 5
        else
            return false
            # return 6
        end
    when "}"
        if tail =="{"
            return true
            # return 7
        else
            return false
            # return 8
        end
    else
        return false
        # return 9
    end
end

p balanced?(["(", "{", "}", "}", ")"])
p balanced?(["(", "{", "{", "}", "}", ")"])
p balanced?(["(", "{", "{", "(", "}", "}", ")"])
p balanced?(["(", "{", "{", "(", ")", "}", "}", ")"])
p balanced?(["(", "{", "{", "}", "(", ")", "}", "(", ")", ")"])
p balanced?(["(", "{", "{", "}", "(", "}", ")", ")"])