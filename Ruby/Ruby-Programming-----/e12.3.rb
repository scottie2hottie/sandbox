def num2astrisk(times)
    num = times.to_i
    num.times{
        print "*"
    }
    print "\n"
end

num2astrisk("12")
num2astrisk("1234")