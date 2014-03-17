class Admin::BoardsController < ApplicationController
  layout 'admin'
  before_filter :require_is_admin

  def index
    @boards = Board.all

    respond_to do |format|
      format.html # index.html.erb
      format.json { render json: @boards }
    end
  end

  def show
    @board = Board.find(params[:id])
    @posts = @board.posts.all

    respond_to do |format|
      format.html # show.html.erb
      format.json { render json: @board }
    end
  end

  def new
    @board = Board.new

    respond_to do |format|
      format.html # new.html.erb
      format.json { render json: @board }
    end
  end

  def edit
    @board = Board.find(params[:id])
  end

  def create
    @board = Board.new(params[:board])

    respond_to do |format|
      if @board.save
        # format.html { redirect_to admin_board_path(@board), notice: 'Board was successfully created.' }
        format.html { redirect_to board_path(@board), notice: 'Board was successfully created.' }
        format.json { render json: @board, status: :created, location: @board }
      else
        format.html { render action: "new" }
        format.json { render json: @board.errors, status: :unprocessable_entity }
      end
    end
  end

  def update
    @board = Board.find(params[:id])

    respond_to do |format|
      if @board.update_attributes(params[:board])
        # format.html { redirect_to admin_board_path(@board), notice: 'Board was successfully updated.' }
        format.html { redirect_to board_path(@board), notice: 'Board was successfully updated.' }
        format.json { head :no_content }
      else
        format.html { render action: "edit" }
        format.json { render json: @board.errors, status: :unprocessable_entity }
      end
    end
  end

  def destroy
    @board = Board.find(params[:id])
    @posts = @board.posts
    # if @board.posts.destroy  #此处看板的所属帖子没有删除成功, 原因？
    if @posts.each { |post| post.destroy }
      @board.destroy
      respond_to do |format|
        format.html { redirect_to admin_boards_url }
        format.json { head :no_content }
      end
    else
      put "failed"
    end

  end
end
