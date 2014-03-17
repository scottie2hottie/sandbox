# p /Ruby/i =~ "ruby"
# p /Ruby/ =~ "Diamond"
# p /Ruby/ =~ "Yet another Ruby hacker"
# p /Yet another Ruby hacker/ =~ "Ruby"
names = ['xiaolin', 'lin', 'gaoye', 'sengang']
names.each{ |name|
    if /lin/ =~ name
        puts name
    end
}