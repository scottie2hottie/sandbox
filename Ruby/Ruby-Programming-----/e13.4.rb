str = "bl blue wh white \nr red"

def str2hash(str)
    str_splitted = str.split(/\s+/)
    hash = Hash.new
    key = []
    value =[]
    str_splitted.each_with_index{|item, idx|
        # print item, idx
        # print "\n"
        if idx%2 == 0 
            key << item
        else
            value << item
        end
    }

    key.size.times{ |i|
        hash.store(key[i], value[i])
    }
    return hash
end



p str2hash(str)