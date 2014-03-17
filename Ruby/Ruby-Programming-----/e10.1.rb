def cels2fahr(cels = 0.0)
    fahr = (cels.to_f)*9/5+32
    return fahr
end

p cels2fahr(35)
