#find system imagemagick commadn location
if File.exists?('/usr/local/bin/identify') && File.exists?('/usr/local/bin/convert')
  Paperclip.options[:command_path] = '/usr/local/bin'
elsif File.exists?('/usr/bin/identify') && File.exists?("/usr/bin/convert")
  Paperclip.options[:command_path] = "/usr/path"
end


Paperclip.interpolates :year do |attachment, style|
  attachment.instance.created_at.strftime("%Y")
end

Paperclip.interpolates :month do |attachment, style|
  attachment.instance.created_at.strftime("%m")
end

if File.exists?("/usr/local/bin/pandoc")
  PandocRuby.bin_path = '/usr/local/bin'
elsif File.exists?("/usr/bin/pandoc")
  PandocRuby.bin_path = '/usr/bin'
end
  
  