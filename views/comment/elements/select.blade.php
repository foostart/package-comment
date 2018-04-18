<!-- CATEGORY LIST -->
<div class="form-group">
    <?php $comment_name = $request->get('comment_titlename') ? $request->get('comment_name') : @$comment->comment_name ?>

    {!! Form::label('category_id', trans('comment::comment_admin.comment_categoty_name').':') !!}
    {!! Form::select('category_id', @$categories, @$comment->category_id, ['class' => 'form-control']) !!}
</div>
<!-- /CATEGORY LIST -->