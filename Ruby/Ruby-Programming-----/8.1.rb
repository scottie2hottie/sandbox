# arr = Array.new
# p arr

# arr = []
# str = "hello"
# p arr.class
# p str.class
# p arr.instance_of?(Array)
# p str.instance_of?(String)
# p arr.instance_of?(String)
# p str.instance_of?(Array)
# p str.is_a?(String)
# p str.is_a?(Object)

class HelloWorld
    def initialize(myName = 'ruby')
        @name = myName
    end
    def hello
        print "hello world, I'm ", @name, "\n"
    end
end


bob = HelloWorld.new('bob')
alice = HelloWorld.new('alice')
ruby = HelloWorld.new()

bob.hello
alice.hello
ruby.hello