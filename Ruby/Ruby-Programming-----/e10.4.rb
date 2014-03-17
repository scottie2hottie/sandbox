def prime?(num)
    if num.is_a?(Integer)
        for i in 2..(num-1)
            rs = num%i
            if rs == 0
                # p "num is not a prime"
                return false
                exit
            end
            if i == (num-1)
                # p "num is a prime"
                return true
            end
        end
    else
        p "please specify an integer."
    end
end

p prime?(79)
p prime?(4)

