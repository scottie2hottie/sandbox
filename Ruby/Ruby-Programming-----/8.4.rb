class RingArray < Array
    def [](i)
        idx = i % size
        super(idx)
    end
end
eto = RingArray['a', 'b', 'c']
p eto[4]
p eto[5]
p eto[6]