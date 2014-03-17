names = ['awk', 'perl', 'python', 'ruby']
i = 0

print "break:\n"
names.each{|name|
    i += 1
    if i == 3
        break
    end
    p [ i, name ]
}
print "next:\n"
i = 0
names.each{|name|
    i += 1
    if i == 3
        next
    end
    p [ i, name ]
}
print "redo:\n"
i = 0
names.each{|name|
    i += 1
    if i == 3
        redo
    end
    p [ i, name ]
}