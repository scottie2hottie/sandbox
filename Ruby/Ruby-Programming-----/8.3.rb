class String
    def count_word
        arr = self.split(/\s+/)
        return arr.size
    end
end

str = "I'm just a test string."
p str.count_word