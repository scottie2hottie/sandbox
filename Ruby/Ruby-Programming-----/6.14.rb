pattern = Regexp.new(ARGV[0])
filename = ARGV[1]

fh = open(filename)
max_matches = 2
match = 0
while line = fh.gets
    if match >= max_matches
        break
    end
    if pattern =~ line
        print line
        match += 1
    end
end
print "~", match, "~", "\n"