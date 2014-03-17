lines_total = 0
words_total = 0
chars_total = 0
ARGV.each { |file|  
    begin
        input = open(file)
        lines = 0
        words = 0
        chars = 0
        while line = input.gets
            lines += 1
            chars += line.size
            line.sub!(/^\s+$/, "")
            arr = line.split(/\s+/).size
            words += arr.size
        end
        input.close
        printf("%8d %8d %8d %s\n", lines, words, chars, file)
        lines_total += lines
        words_total += words
        chars_total += chars
    rescue Exception => e
        print e.message, "\n"
    end
}
printf("%8d %8d %8d %s\n", lines_total, words_total, chars_total, "total")