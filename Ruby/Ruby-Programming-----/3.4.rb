filename = ARGV[0]
file = open(filename)
content = file.read
print content, "\n"
file.close