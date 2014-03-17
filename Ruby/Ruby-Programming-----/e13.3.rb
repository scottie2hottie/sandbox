wday = Hash.new
# wday["monday"] = "星期一"
# wday["tuesday"] = "星期二"
# wday["wednesday"] = "星期三"
# wday["thursday"] = "星期四"
# wday["friday"] = "星期五"
# wday["saturday"] = "星期六"
# wday["sunday"] = "星期日"

wday["1"] = "monday"
wday["2"] = "tuesday"
wday["3"] = "wednesday"
wday["4"] = "thursday"
wday["5"] = "friday"
wday["6"] = "saturday"
wday["0"] = "sunday"

wday.each_pair { |name, val|  
    print "\"#{name}\" is #{val}"
    print "\n"
}