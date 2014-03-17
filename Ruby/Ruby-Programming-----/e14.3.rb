def word_capitalize(str)
    
    nstr = str.gsub(/[^-]*/) { |match|
        # print match, "\n"
        # match.capitalize
        match.capitalize
    }
    return nstr
end

p word_capitalize("X-MAILER")
p word_capitalize("in-reply-to")