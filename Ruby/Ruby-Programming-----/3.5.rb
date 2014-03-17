filename = ARGV[0]
fh = open(filename)

while line = fh.gets
    print line #, "\n"
end
print "\n"
fh.close