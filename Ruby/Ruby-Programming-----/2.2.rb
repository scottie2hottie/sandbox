# print "<html><title>font size list</title>"
# print "<body>\n<p>\n"
font_table = {
    "normal" => "+0",
    "small"  => "-1",
    "big"    => "+1"
}
# font_table.each { |key, value|
#     print '<font size="', value, '">', key, '</font><br/>',"\n"
# }

# # print "</p></body></html>\n"

font_table.each{|key, value|
    # print key, value, "\n"
    print key, "\n"
    # print value, "\n"
}

# p font_table
# pp font_table