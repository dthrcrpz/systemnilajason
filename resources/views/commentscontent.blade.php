@foreach($comments as $comment)
	@if($comment->hotel->id == session('id') || session('type') == 'superadmin')
		<a href="#" class="pull-right" onclick="deleteComment('{{ $comment->id }}')">Delete</a>
	@else

	@endif
	<h4>{{ $comment->name }} <small>{{ $comment->created_at }}</small></h4>
	<p>{{ $comment->body }}</p>
	<hr>
@endforeach