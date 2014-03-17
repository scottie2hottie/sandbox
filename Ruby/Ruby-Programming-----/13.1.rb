count = Hash.new {0}
while line = gets
    words = line.split
    words.each { |word|  
        count[word] += 1
    }
end


count.sort { |a, b|  
    a[1] <=> b[1]
}.each{ |key, value|
    print key, ":", value
    print "\n"
}