# p 2*10
# p 2^10
# p 2**10
# p 2**3
# p 2**1000
# p 123_456
# p 0x123_456
# p 1_234.0e4
# p 10.divmod(3)
# p 1/0.0
# p 0/0.0
# include Math
# p PI
# p E

# p 10.to_f
# p 10.8.to_i
# p "123".to_i
# p "123".to_f
# p "123.3".to_f
# p 1.2.round
# p 1.5.round

# p 1.2.ceil
# p 1.2.floor


arr = []
# 10.times{|i|
#     arr << i
# }
# 2.upto(10) {|i|
#     arr << i
# }

# 2.step(10, 3) {|i| 
#     arr << i
# }

10.step(2, -4) {|i|
    arr << i
}
p arr