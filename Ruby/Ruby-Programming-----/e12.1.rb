str = "Ruby is an object oriented programming language"
#a
a = str.split(/\s/)
p a

#b
b = a.sort
p b

#c

#d
d = []
a.each { |e|  
    d << e.capitalize
}
p d

#e
    # p str.split(//)
str_splitted = str.split(//)
hash = {}
str_splitted.each { |e|  
    if hash.has_key?(e)
        hash[e] += 1
    else
        hash[e] = 1
    end
}
    # p hash

def print_star(key, value)
    print "'", key, "'", ":"
    value.times{
        print "*"
    }
    print "\n"
end

hash.each_pair { |name, val|  
    print_star(name, val)
}