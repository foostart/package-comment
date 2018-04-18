
@if( ! $comments->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('comment::comment_admin.order') }}</td>
            <th style='width:10%'>Comment ID</th>
            <th style='width:50%'>Comment title</th>
            <th style='width:20%'>{{ trans('comment::comment_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $comments->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($comments as $comment)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <td>{!! $comment->comment_id !!}</td>
            <td>{!! $comment->comment_name !!}</td>
            <td>
                <a href="{!! URL::route('admin_comment.edit', ['id' => $comment->comment_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_comment.delete',['id' =>  $comment->comment_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
 <span class="text-warning">
	<h5>
		{{ trans('comment::comment_admin.message_find_failed') }}
	</h5>
 </span>
@endif
<div class="paginator">
    {!! $comments->appends($request->except(['page']) )->render() !!}
</div>