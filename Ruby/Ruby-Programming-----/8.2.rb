class HelloWorld
    @@count = 0

    def HelloWorld.count
        @@count
    end
    def initialize(myName = 'ruby')
        @name = myName
    end
    def hello
        @@count += 1
        print "hello world, I'm ", @name, "\n"
    end
end


bob = HelloWorld.new('bob')
alice = HelloWorld.new('alice')
ruby = HelloWorld.new()

p HelloWorld.count
bob.hello
alice.hello
ruby.hello
p HelloWorld.count
