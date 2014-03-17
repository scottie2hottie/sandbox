require 'spec_helper'

describe "StaticPages" do
  # let(:base_title) {"Ruby on Rails Tutorial Sample App"}

  subject { page }

  shared_examples_for "all static pages" do
    it { should have_selector('h1', text: heading) }
    it { should have_selector('title', text: full_title(page_title)) }
  end

  describe "Home page" do
    before { visit root_path }
    let(:heading) {"Sample App"}
    let(:page_title) {""}

    it_should_behave_like "all static pages"
    it { should_not have_selector('title', text: '| Home') }
    # it { should have_content('Sample App') }
    # it { should have_selector('title', text: full_title("")) }
  end

  describe "Help Page" do
    before { visit help_path }
    let(:heading) {"help"}
    let(:page_title) {"Help"}

    it_should_behave_like "all static pages"
    # it { should have_content('help') }
    # it { should have_selector('title', text: full_title('Help')) }
  end

  describe "About us page" do
    before { visit about_path }
    let(:heading) { "About" }
    let(:page_title) {"About us"}

    it_should_behave_like "all static pages"
    # it { should have_content('About us') }
    # it { should have_selector('title', text: full_title("About us")) }
  end

  describe "Contact page" do
    before { visit contact_path }
    let(:heading) { "Contact" }
    let(:page_title) { "Contact us" }

    it_should_behave_like "all static pages"

    # it { should have_content("Contact us") }
    # it { should have_selector('title', text: full_title('Contact')) }
    # it { should have_selector('h1', text: 'Contact') }
  end

  it "should have right links on the layout" do
    visit root_path
    click_link "About"
      page.should have_selector 'title', text: full_title("About us")
    click_link "Contact"
      page.should have_selector 'title', text: full_title("Contact")
    click_link "News"
      # page.should have_selector 'title', text: full_title("About us")
    click_link "Home"
      page.should have_selector 'title', text: full_title("")
    click_link "Help"
      page.should have_selector 'title', text: full_title("Help")
    click_link "sample app"
      page.should have_selector 'title', text: full_title("")
    click_link "Sign in"
      # page.should have_selector 'title', text: full_title("About us")
    visit root_path
    click_link "Sign up now!"
      page.should have_selector 'title', text: full_title("Sign up")
      #http://stackoverflow.com/questions/5361916/my-rspec-test-wont-pass-michael-hartls-rails-tutorial
  end
end