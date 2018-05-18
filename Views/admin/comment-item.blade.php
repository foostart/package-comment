@if(!empty($items) && (!$items->isEmpty()) )
<?php
    $withs = [
        'order' => '10%',
        'name' => '30%',
        'updated_at' => '25%',
        'operations' => '10%',
        'delete' => '10%',
        'status' => '15%',
    ];

    global $counter;
    $nav = $items->toArray();
    $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
?>
<caption>
    @if($nav['total'] == 1)
        {!! trans($plang_admin.'.descriptions.counter', ['number' => $nav['total']]) !!}
    @else
        {!! trans($plang_admin.'.descriptions.counters', ['number' => $nav['total']]) !!}
    @endif
</caption>

<table class="table table-hover" id="tbcomment">

    <thead>
        <tr style="height: 50px;">

            <!--ORDER-->
            <?php $name = 'comment_id' ?>
            <th class="hidden-xs" style='width:{{ $withs['order'] }}'>#
                <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                    @if($sorting['items'][$name] == 'asc')
                        <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                    @elseif($sorting['items'][$name] == 'desc')
                        <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                    @else
                         <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    @endif
                </a>
            </th>

            <!-- NAME -->
            <?php $name = 'comment_description' ?>

            <th class="hidden-xs" style='width:{{ $withs['name'] }}'>{!! trans($plang_admin.'.columns.description') !!}
                <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                    @if($sorting['items'][$name] == 'asc')
                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                    @elseif($sorting['items'][$name] == 'desc')
                        <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    @endif
                </a>
            </th>

            <!-- updated -->
            <?php $name = 'updated_at' ?>

            <th class="hidden-xs" style='width:{{ $withs['updated_at'] }}'>{!! trans($plang_admin.'.columns.updated_at') !!}
                <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                    @if($sorting['items'][$name] == 'asc')
                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                    @elseif($sorting['items'][$name] == 'desc')
                        <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    @endif
                </a>
            </th>
               
            <!--status-->
            <?php $name = 'comment_status' ?>

            <th class="hidden-xs" style='width:{{ $withs['status'] }}'>{!! trans($plang_admin.'.columns.status') !!}
                <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                    @if($sorting['items'][$name] == 'asc')
                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                    @elseif($sorting['items'][$name] == 'desc')
                        <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    @endif
                </a>
            </th>

            <!--OPERATIONS-->
            <th style='width:{{ $withs['operations'] }}'>
                <span class='lb-delete-all'>
                    {{ trans($plang_admin.'.columns.operations') }}
                </span>
                
                <div id="an" style="display: none;">
                {!! Form::submit(trans($plang_admin.'.buttons.delete'), array("class"=>"btn btn-danger pull-right delete btn-delete-all del-trash", 'name'=>'del-trash')) !!}
                {!! Form::submit(trans($plang_admin.'.buttons.delete'), array("class"=>"btn btn-warning pull-right delete btn-delete-all del-forever", 'name'=>'del-forever')) !!}
                </div>
                
            </th>

            <!--DELETE-->
            <th style='width:{{ $withs['delete'] }}'>
                <span class="del-checkbox pull-right">
                    <input type="checkbox" id="selecctall" onclick="checkAllCheckBox()"/>
                    <label for="del-checkbox"></label>
                </span>
            </th>

        </tr>

    </thead>

    <tbody>
        @foreach($items as $item)
            <tr>
                <!--COUNTER-->
                <td> {!! $item->comment_id !!} </td>

                <!--NAME-->
                <td> {!! $item->comment_description !!} </td>
                 
                <!--UPDATED AT-->
                <td> {!! $item->updated_at !!} </td>
                
                <!--STATUS-->
                <td style="text-align: center;">

                    <?php $status = config('package-comment.status'); ?>
                    @if($item->comment_status && (isset($status['list'][$item->comment_status])))
                        <i class="fa fa-circle" style="color:{!! $status['color'][$item->comment_status] !!}" title='{!! $status["list"][$item->comment_status] !!}'></i>
                    @else
                    <i class="fa fa-circle-o red" title='{!! trans($plang_admin.".labels.unknown") !!}'></i>
                    @endif
                </td>
                
                <!--OPERATOR-->
                <td>
                    <!--edit-->
                    <a href="{!! URL::route('comments.edit', [   'id' => $item->id,
                                                                '_token' => csrf_token()
                                                            ])
                            !!}">
                        <i class="fa fa-edit f-tb-icon"></i>
                    </a>

                    <!--copy-->
                    <a href="{!! URL::route('comments.copy',[    'cid' => $item->id,
                                                                '_token' => csrf_token(),
                                                            ])
                             !!}"
                        class="margin-left-5">
                        <i class="fa fa-files-o f-tb-icon" aria-hidden="true"></i>
                    </a>

                    <!--delete-->
                    <a href="{!! URL::route('comments.delete',[  'id' => $item->id,
                                                                '_token' => csrf_token(),
                                                              ])
                             !!}"
                       class="margin-left-5 delete">
                        <i class="fa fa-trash-o f-tb-icon"></i>
                    </a>

                </td>

                <!--DELETE-->
                <td>
                    <span class='box-item pull-right'>
                        <input type="checkbox" id="<?php echo $item->id ?>" name="ids[]" value="{!! $item->id !!}" onclick="checkedCheckBox()">
                        <label for="box-item"></label>
                    </span>
                </td>

            </tr>
        @endforeach
    </tbody>

</table>
<div class="paginator">
    {!! $items->appends($request->except(['page']) )->render() !!}
</div>
@else
    <!--SEARCH RESULT MESSAGE-->
    <span class="text-warning">
        <h5>
            {{ trans($plang_admin.'.descriptions.not-found') }}
        </h5>
    </span>
    <!--/SEARCH RESULT MESSAGE-->
@endif

@section('footer_scripts')
    @parent
    {!! HTML::script('packages/foostart/package-comment/public/js/form-table.js')  !!}
@stop
<script>
    function checkAllCheckBox() {
    var checkBox = document.getElementById("selecctall");
        var an = document.getElementById("an");
        if (checkBox.checked == true){
            an.style.display = "block";
        } else {
           an.style.display = "none";
        }
    }
    function checkedCheckBox(){
        var check = $("input[name='ids[]']:checked").length;
        if(check){
            $("#an").show();
        }else {
            $("#an").hide();
       }
   }
</script>