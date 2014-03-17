pattern = Regexp.new(ARGV[0])
filename = ARGV[1]
fh = open(filename)

while line = fh.gets
    if pattern =~ line
        print line
    end
end
print "\n"
fh.close