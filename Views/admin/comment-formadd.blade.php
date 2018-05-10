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
            'label' => trans($plang_admin.'.labels.description'),
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
    <fieldset class="rep" style="margin-top: 50px;">
    <div class="ht">
        <ul>
        @foreach($items as $item)
        <p>------------------------------------------------------------------------------------------------------------------------------</p>
            <li>
                <img src="../../../../../public/img/1.png" alt="Avatar" class="avatar"/>
                <div>
                    <b>{!! $item->user_email !!}</b>
                    <p>{!! $item->comment_description !!}</p>
                    <a href="{!! URL::route('comments.add', [   'id' => $item->id,'_token' => csrf_token()])!!}"<i class="fa fa-edit f-tb-icon"></i></a><a href="{!! URL::route('comments.deletecomment', [   'id' => $item->id,'_token' => csrf_token()])!!}"class="margin-left-5 delete"><i class="fa fa-trash-o f-tb-icon"></i></a><a id="btn"> <i class="fa fa-reply"></i></a>   
                </div>
                <!--REPLY-->
                <fieldset>
                    {!! Form::open(['route'=>['comments.postadd','id' => @$item->id ],'files'=>true,'method' => 'post'])  !!}
                    <div id="nd" style="display: none;">
                     <!--SAMPLE DESCRIPTION-->
                                @include('package-category::admin.partials.textarea', [
                                'name' => 'rep_name',
                                'label' => trans($plang_admin.'.labels.description'),
                                'value' => @$item->rep_name,
                                'rows' => 0,
                                'tinymce' => true,
                                'errors' => $errors,
                                ])
                    <!--/SAMPLE DESCRIPTION-->
                    </div>
                    <!--BUTTONS-->
                        <div id='btn-form' style="display: none;">
                            <!-- SAVE BUTTON -->
                            {!! Form::submit(trans($plang_admin.'.buttons.send'), array("class"=>"btn btn-info pull-right ")) !!}
                            <!-- /SAVE BUTTON -->
                        </div>
                        <!--/BUTTONS-->
                        <fieldset id="ndrep" style="margin-top: 50px; display: none;">
                        <div id="ht">
                            <ul>
                                <p>------------------------------------------------------------------------------------------------------------------------------</p>
                                <li>
                                    <div>
                                        <b></b>
                                        <p></p>
                                    </div>
                                </li>
                                </ul>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                    </fieldset>
                <!--/REPLY-->
            </li>
        @endforeach
        </ul>
    </div>
    </fieldset>
{!! Form::close() !!}
</fieldset>
<div class="paginator">
    {!! $items->appends($request->except(['page']) )->render() !!}
</div>
@section('footer_scripts')
    @parent
    {!! HTML::script('packages/foostart/package-comment/public/js/form-table.js')  !!}
@stop
<script>
        document.getElementById("btn").onclick = function () {
        document.getElementById("btn-form").style.display = 'block';
        document.getElementById("ht").style.display = 'block';
        document.getElementById("nd").style.display = 'block';
        document.getElementById("ndrep").style.display = 'block';
        };
</script>

<!------------------------------------------------------------------------------
| End list of elements in comment form
|------------------------------------------------------------------------------>