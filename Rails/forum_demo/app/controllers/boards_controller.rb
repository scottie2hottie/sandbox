class BoardsController < ApplicationController
  def index
    @boards = Board.all

    respond_to do |format|
      format.html # index.html.erb
      format.json { render json: @boards }
    end
  end

  def show
    @board = Board.find(params[:id])
    # @posts = @board.posts.paginate(page: params[:page], per_page: 5)
    @posts = @board.posts.recent.paginate(page: params[:page], per_page: 5)

    respond_to do |format|
      format.html # show.html.erb
      format.json { render json: @board }
    end
  end

end
