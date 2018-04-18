
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('comment::comment_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_comment_category','method' => 'get']) !!}

        <!--TITLE-->
		<div class="form-group">
            {!! Form::label('comment_category_name',trans('comment::comment_admin.comment_category_name_label')) !!}
            {!! Form::text('comment_category_name', @$params['comment_category_name'], ['class' => 'form-control', 'placeholder' => trans('comment::comment_admin.comment_category_name')]) !!}
        </div>

        {!! Form::submit(trans('comment::comment_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>




