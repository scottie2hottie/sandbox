class PostsController < ApplicationController
  before_filter :find_board
  before_filter :authenticate_user!, except: [:show, :index]

  def index
    # @posts = Post.all

    # respond_to do |format|
    #   format.html # index.html.erb
    #   format.json { render json: @posts }
    # end
    # @board = Board.find_by_id(params[:board_id])
    redirect_to board_path(@board)
  end


  def show
    # @post = Post.find(params[:id])

    # respond_to do |format|
    #   format.html # show.html.erb
    #   format.json { render json: @post }
    # end
    # @board = Board.find_by_id(params[:board_id])
    @post = @board.posts.find(params[:id])

  end


  def new
    # @post = Post.new

    # respond_to do |format|
    #   format.html # new.html.erb
    #   format.json { render json: @post }
    # end
    # @board = Board.find_by_id(params[:board_id])
    @post = @board.posts.build
    # @post.save!
  end

  
  def edit
    # @post = Post.find(params[:id])
    # @board = Board.find_by_id(params[:board_id])
    # @post = @board.posts.find(params[:id])
    @post = current_user.posts.find(params[:id])
  end


  def create
    # @post = Post.new(params[:post])

    # respond_to do |format|
    #   if @post.save
    #     format.html { redirect_to @post, notice: 'Post was successfully created.' }
    #     format.json { render json: @post, status: :created, location: @post }
    #   else
    #     format.html { render action: "new" }
    #     format.json { render json: @post.errors, status: :unprocessable_entity }
    #   end
    # end
    # 
    # @board = Board.find_by_id(params[:board_id])
    @post = @board.posts.build(params[:post])
    @post.user_id = current_user.id
    respond_to do |format|
      if @post.save
        format.html {redirect_to board_post_path(@board, @post), notice: "Post created successfully."}
      else
        
      end
    end
  end


  def update
    # @post = Post.find(params[:id])

    # respond_to do |format|
    #   if @post.update_attributes(params[:post])
    #     format.html { redirect_to @post, notice: 'Post was successfully updated.' }
    #     format.json { head :no_content }
    #   else
    #     format.html { render action: "edit" }
    #     format.json { render json: @post.errors, status: :unprocessable_entity }
    #   end
    # end
    # @board = Board.find_by_id(params[:board_id])
    # @post = @board.posts.find(params[:id])
    @post = current_user.posts.find(params[:id])
    if @post.update_attributes(params[:post])
      respond_to do |format|
        format.html {redirect_to board_post_path(@board, @post), notice: "Post updated successfully."}
      end
    else
      
    end
  end


  def destroy
    #   @post = Post.find(params[:id])
    #   @post.destroy

    #   respond_to do |format|
    #     format.html { redirect_to posts_url }
    #     format.json { head :no_content }
    #   end
    # end
    # @board = Board.find(params[:board_id])
    # @post = @board.posts.find(params[:id])
    @post = current_user.posts.find(params[:id])
    if @post.destroy
      respond_to do |format|
        format.html {redirect_to board_posts_path(@board)}
      end
    else
      
    end
  end


  protected
  def find_board
    @board = Board.find(params[:board_id])
  end
end