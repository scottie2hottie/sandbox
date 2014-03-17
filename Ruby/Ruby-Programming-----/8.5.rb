class AccTest
    def pub
        puts "public"
    end
    public :pub

    def priv
        puts "private"
    end
    private :priv
end

acc = AccTest.new
acc.pub
acc.priv