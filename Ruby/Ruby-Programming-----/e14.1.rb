email = "cisolarix@gmail.com"
%r|([^@]*)@([^@]*)| =~ email
p $1
p $2