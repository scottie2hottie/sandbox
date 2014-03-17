class ArticlesController < ApplicationController
  before_action :require_login, only: [:new, :create, :edit, :update]

  def index
    @articles = Article.all
  end

  def show
    @article = Article.find(params()[:id])
    # @comment = @article.comments.new
    @comment = Comment.new
  end

  def new
    @article = Article.new
  end

  def create
    @article = Article.new(article_params)
    if @article.save
      flash.notice = "Article #{@article.title} created!"
      redirect_to article_path(@article)
    end
  end

  def destroy
    @article = Article.find(params[:id])
    @article.destroy
    flash.notice = "Article #{@article.title} deleted!"
    redirect_to articles_path
  end

  def edit
    @article = Article.find(params[:id])
  end

  def update
    @article = Article.find(params[:id])
    @article.update(article_params)
    flash.notice = "Article #{@article.title} updated!"
    redirect_to article_path @article
  end

  private
  def article_params
    params.require(:article).permit(:title, :body, :tags_list)
  end
end
