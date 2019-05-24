@foreach($comments as $item)
<div class="row">
	<div class="col-md-12">
		<div class="card w-100">
			<div class="card-header">
				<i class="fas fa-arrow-right"></i> <a href="{{ route('users.show', $item->username) }}"><strong>{{ $item->username }}</strong></a>
			</div>
			<div class="card-body">
				<p class="lead">{{ $item->content }}</p>
			</div>
		</div>
	</div>
</div>
<br>
@endforeach