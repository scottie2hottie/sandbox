arr = ["aa", 1, nil]
# item = arr[0]
arr.each { |e|  
    case e
    when String
        puts e, " is a String"
    when Numeric
        puts e, " is a Numeric"    
    else
        puts e, " is something"
    end
}