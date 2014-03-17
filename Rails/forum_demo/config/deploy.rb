require 'capistrano/ext/multistage'
# require 'rvm-capistrano'
require 'bundler/capistrano'

set :stages, %w(staging production)
set :default_stage, "production"

set :application, "forum_demo"
set :repository, "git://github.com/cisolarix/forum_demo.git"

set :deploy_via, :remote_cache
set :scm, :git
set :branch, "master"
set :scm_verbose, true
set :use_sudo,  false
set :user, "railsu"
set :group, "railsu"

# ssh_options[:keys] = ["/Users/cisolarix/Dropbox/sandbox/backend/ror/project/cisolarixkey.pem"]
