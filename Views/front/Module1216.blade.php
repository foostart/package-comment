<div class="type-1216">
    <div class="row main">
        <div class="top-bar">
            <div class="top-links"> 
                <ul>
                    @foreach($items as $item)
                    <li>
                        <a href="#">{!!$item->comment_id!!}</a>
                        <div class="b">
                            <p class="c">{!!$item->comment_name!!}</p>
                            <p><i class="fa fa-map-marker"></i>{!! $item->comment_overview!!}</p>
                            <p><i class="fa fa-phone"></i>{!! $item->comment_description!!}</p>
                        </div>


                    </li>
                    @endforeach
                </ul>
                <div class="top-text">
                    <span class="text">No-pay consultation line</span><span> 0809-080-158</span>
                    <i class="fa fa-facebook"></i>  
                    <i class="fa fa-envelope email"></i> 
                    <i class="fa fa-pinterest prin"></i>  
                </div>
            </div>
        </div>
    </div>
</div>