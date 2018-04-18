<!-- SAMPLE NAME -->
<div class="form-group">
    <?php $comment_name = $request->get('comment_titlename') ? $request->get('comment_name') : @$comment->comment_name ?>
    {!! Form::label($name, trans('comment::comment_admin.name').':') !!}
    {!! Form::text($name, $comment_name, ['class' => 'form-control', 'placeholder' => trans('comment::comment_admin.name').'']) !!}
</div>
<!-- /SAMPLE NAME -->