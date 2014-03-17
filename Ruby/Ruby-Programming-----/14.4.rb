str ="http://www.google.com/reader/"
%r|http://([^/]*)/| =~ str
p $1