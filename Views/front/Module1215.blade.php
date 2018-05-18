<div class="type-1215">
    <div class="container">
        <div class="row">
         <div id="swiper" class="swiper-container swiper-container-horizontal swiper-container-fade">
            <div class="swiper-wrapper">
                <div class="swiper-slide" data-swiper-autoplay="2000">
                    <a>
                        <img src="http://localhost/laravel/vendor/foostart/package-comment/public/images/banner_data-13.jpg" title="" alt="award">
                        <div class="slider_caption text ">
                            <h2>Living</h2>
                            <h3>Beautiful Home</h3>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide" data-swiper-autoplay="2000">
                    <a>
                        <img src="http://localhost/laravel/vendor/foostart/package-comment/public/images/banner_data-14.jpg" title="" alt="">
                        <div class="slider_caption text">
                            <h2>Living</h2>
                            <h3>Beautiful Home</h3>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide" data-swiper-autoplay="2000">
                    <a>
                        <img src="http://localhost/laravel/vendor/foostart/package-comment/public/images/banner_data-15.jpg" title="" alt="">
                        <div class="slider_caption text">
                            <h2>Living</h2>
                            <h3>Beautiful Home</h3>
                        </div>
                    </a>
                </div>
            </div>
            
            <div id="swiper_btn_prev" class="swiper_btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div id="swiper_btn_next" class="swiper_btn">
                <i class="fa fa-angle-right"></i>
            </div>
            <div id="swiper_btn_down" class="swiper_btn">
                <i class="fa fa-angle-down"></i>
            </div>
            
        </div>
    </div>
</div>
</div>

<script>
    var swiper = new Swiper('.swiper-container', {
        autoplay: {
            delay: 5000,
        },
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        speed: 2000,
        nextButton: '#swiper_btn_next',
        prevButton: '#swiper_btn_prev'

    });
    
</script>