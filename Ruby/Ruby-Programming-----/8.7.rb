# def fetch_and_downcase(arr, idx)
#     if str = arr[idx]
#         return str.downcase
#     end
# end

# arr = ['Foo', 'Bar', 'Baz']
# p fetch_and_downcase(arr, 2)

# hash = {0=>'Foo', 1=>'Bar', 2=>'Baz'}
# p fetch_and_downcase(hash, 2)
# p FileText.exist?("/usr/bin/ruby") #8.7.rb:12:in `<main>': uninitialized constant Object::FileText (NameError)
# p FileText.size("/usr/bin/ruby")

# p Math::PI
# p Math.sqrt(2)

# include Math
# p PI
# p sqrt(2)


module HelloModule
    Version = "1.0"
    def hello(name)
        print "hello, ", name, "\n"
    end
    def foo
        p self
    end
    module_function :hello
    module_function :foo
end

p HelloModule::Version
HelloModule::hello('Alice')

include HelloModule
p Version
p hello('cisolarix')

HelloModule::foo