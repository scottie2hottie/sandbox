require 'redcarpet'
require 'active_support/core_ext'

Dir['./lib/*'].each { |f| require f }

# Debugging
set(:logging, ENV['RACK_ENV'] != 'production')

set :markdown_engine, :redcarpet
set :markdown, :layout_engine => :erb,
         :fenced_code_blocks => true,
         :lax_html_blocks => true,
         :renderer => Highlighter::HighlightedHTML.new

activate :directory_indexes
activate :toc
activate :highlighter
activate :i18n, mount_as_root: 'zh-CN'

#activate :api_docs,
  #default_class: 'Ember',
  #repo_url: 'https://github.com/emberjs/ember.js'

###
# Blog
###

activate :blog do |blog|
  blog.prefix = 'blog'
  blog.layout = 'layouts/blog'
  blog.summary_separator = %r{(<p>READMORE</p>)} # Markdown adds the <p>
  blog.tag_template = 'blog/tag.html'
end

page '/blog/feed.xml', layout: false

###
# Pages
###

page 'guides*', layout: :guide do
  @guides = data.guides
end

page 'bilingual_guides*', layout: :bilingual_guide do
  @bilingual_guides = data.guides
end

page 'community.html'

page 'index.html'

page '404.html', directory_index: false

# Don't build layouts standalone
ignore '*_layout.erb'

# Don't build API layouts
ignore 'api/class.html.erb'
ignore 'api/module.html.erb'

###
# Helpers
###

helpers do
  # Workaround for content_for not working in nested layouts
  def partial_for(key, partial_name=nil)
    @partial_names ||= {}
    if partial_name
      @partial_names[key] = partial_name
    else
      @partial_names[key]
    end
  end

  def rendered_partial_for(key)
    partial_name = partial_for(key)
    partial(partial_name) if partial_name
  end

  def link_to_page name, url
    path = request.path
    current = path =~ Regexp.new('^' + url[1..-1] + '.*\.html')

    if path == 'index.html' and name == 'blog'
      current = true
    end

    class_name = current ? ' class="active"' : ''

    "<li#{class_name}><a href=\"#{url}\">#{I18n.t("nav.#{name}", locale: 'zh-CN')}</a></li>"
  end

  def page_classes
    classes = super
    return 'not-found' if classes == '404'
    classes
  end
end
