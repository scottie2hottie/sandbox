str = "oop is ugly, so damn ugly"

nstr = str.gsub(/ugly/) {|matched|
    'simple'
}

p nstr