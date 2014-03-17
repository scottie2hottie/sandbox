filename = ARGV[0]

fh = open(filename)

while line = fh.gets
    next if /^\s*$/ =~ line
    next if /^#/ =~ line
    print line#, "\n"
end