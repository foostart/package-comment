<!------------------------------------------------------------------------------
| List of elements in comment form
|------------------------------------------------------------------------------->
<?php
    global $counter;
    $nav = $items->toArray();
    $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
?>
<fieldset>
{!! Form::open(['route'=>['comments.postadd','id' => @$item->id ],'files'=>true,'method' => 'post'])  !!}
<h4>VIết Bình Luận...<span class="glyphicon glyphicon-pencil"></span></h4>
<div class="nd">
 <!--SAMPLE DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'comment_description',
            'value' => @$item->comment_description,
            'rows' => 0,
            'tinymce' => true,
            'errors' => $errors,
            ])
<!--/SAMPLE DESCRIPTION-->
</div>

<!--BUTTONS-->
    <div class='btn-form'>
        <!-- SAVE BUTTON -->
        {!! Form::submit(trans($plang_admin.'.buttons.send'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->
     <tbody>
    <fieldset class="rep" style="margin-top: 50px;">
    </fieldset>

{!! Form::close() !!}
</fieldset>
<div class="ht">
        @foreach($items as $item)
                <div style="width:100%; height: 30%; background: #EEEEEE; text-align: center; margin-top: 5px; opacity: 1; color: #000;-moz-border-radius-bottomleft:10px;
-webkit-border-bottom-left-radius:10px;">
                    <b>{!! $item->user_email !!}</b>
                    <p>{!! $item->comment_description !!}</p>
                    <a href="{!! URL::route('comments.add', [   'id' => $item->id,'_token' => csrf_token()])!!}"<i class="fa fa-edit f-tb-icon"></i></a><a href="{!! URL::route('comments.deletecomment', [   'id' => $item->id,'_token' => csrf_token()])!!}"class="margin-left-5 delete"><i class="fa fa-trash-o f-tb-icon"></i></a>
                </div>
        @endforeach
    </div>
<div class="paginator">
    {!! $items->appends($request->except(['page']) )->render() !!}
</div>
@section('footer_scripts')
    @parent
    {!! HTML::script('packages/foostart/package-comment/public/js/form-table.js')  !!}
@stop

<!------------------------------------------------------------------------------
| End list of elements in comment form
|------------------------------------------------------------------------------>