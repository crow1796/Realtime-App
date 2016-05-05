@extends('layout.layout', ['title' => $title])
@section('content')
	<div class="newsfeed-container" ng-controller="newsfeedController as newsfeedVm">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				{!! Form::open(['method' => 'POST', 'class' => 'form', 'ng-submit' => 'newsfeedVm.processPost()']) !!}
					<div class="form-group">
						{!! Form::textarea('post_content', null, ['class' => 'form-control', 'placeholder' => 'Post Something...', 'rows' => 5, 'ng-model' => 'newsfeedVm.postContent']) !!}					
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-primary btn-md">Post <span class="fa fa-edit"></span></button>
					</div>
					<hr/>
				{!! Form::close() !!}
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="posts-container">
					<div class="post" ng-repeat="post in newsfeedVm.posts" ng-controller="singlePostController as postVm">
						<div class="poster-name">
							<img src="{{ url('/images/thumbnail.jpg') }}" alt="Thumbnail" class="img-responsive img-thumbnail user-thumbnail">
							<div class="post-info">
								<strong>@{{ post.posted_by }}</strong>
								<div>
									<small diff-for-humans date="@{{ post.created_at }}">@{{ post.diff_for_humans }}</small>
								</div>
							</div>	
						</div>
						<div class="post-content">
							@{{ post.post_content }}
						</div>
						<div class="post-buttons text-right">
							<small class="pull-left post-likes">24 likes</small>
							<button class="btn btn-link btn-md post-start-like" type="button">
								<span class="fa fa-thumbs-up"></span> Like
							</button>
							<button class="btn btn-md btn-link post-start-comment" type="button">
								<span class="fa fa-comment"></span> Comment
							</button>
						</div>
						<div class="post-comments-container">
							<div class="comment" ng-repeat="singleComment in post.comments">
								<img src="{{ url('/images/thumbnail.jpg') }}" alt="Thumbnail" class="img-responsive img-thumbnail user-thumbnail">
								<div class="comment-info">
									<strong>@{{ singleComment.by }}</strong>
									<div class="comment-content">
										@{{ singleComment.comment }}
									</div>
								</div>
								<hr>
							</div>
						</div>
						<div class="post-comment">
							{!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Comment here...', 'ng-model' => 'postVm.comment', 'ng-keypress' => 'postVm.sendComment($index)']) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection