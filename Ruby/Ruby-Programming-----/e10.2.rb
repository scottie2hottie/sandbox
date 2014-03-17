def fahr2cels(fahr = 0.0)
    return ((fahr.to_f)-32)*5/9
end

def cels2fahr(cels = 0.0)
    fahr = (cels.to_f)*9/5+32
    return fahr
end

# p fahr2cels(95)
print "cels", "\t", "fahr", "\n"
for i in 1..100
    print i, "\t", cels2fahr(i), "\n"
end