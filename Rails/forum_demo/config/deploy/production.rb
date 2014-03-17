# set :application, "forum_demo"
# set :domain, "rix.im"
# set :repository, "git://github.com/cisolarix/forum_demo.git"
# set :deploy_to, "/home/railsu/forum_demo"

# role :app, domain
# role :web, domain
# role :db, domain, :primary => true

# set :deploy_via, :remote_cache
# set :deploy_env, "production"
# set :rails_env, "production"
# set :scm, :git
# set :branch, "master"
# set :scm_verbose, true
# set :use_sudo,  false
# set :user, "railsu"
# set :group, "railsu"

# default_environment["path"] = "/opt/ree/bi"


server "rix.im", :app, :web, :db, :primary => true
set :deploy_to, "/home/railsu/project/forum_demo"
