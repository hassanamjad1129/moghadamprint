@extends('customer.layouts.master')
@section('content')
    
        <link rel="stylesheet" type="text/css"  href='/assets/css/carouFredSel.css' />
        <link rel="stylesheet" type="text/css"  href='/assets/css/prettyPhoto.css' />        
<style>
/* PORTFOLIO */

.filters-button-group
{
    text-align: right;
    display: block;
    margin-bottom: 50px;
      display: flex;
    justify-content: center;
}

.filters-button-group .button
{
    display: inline-block;
    transition: color .2s linear;
}

.filters-button-group .button.is-checked
{
    color: #FD3137;  
}

.filters-button-group .button:hover
{
    color: #FD3137;
    cursor: pointer;
}

.filters-button-group .button:after
{
    content: "\2022";
    display: inline-block;
    margin: 0 20px;
    color: #e2dfd9;
}

.filters-button-group .button:last-child:after
{
    content: '';
    display: none;
}

.grid 
{
    width: 100%;
    margin: 0 auto;
    overflow: hidden;
    position: relative;
    display: block;
}

.grid-item 
{
    float: right;
    font-size: 0;
    line-height: 0;
    box-sizing:border-box;
    -moz-box-sizing:border-box;
    -webkit-box-sizing:border-box;
  position:relative !important;
  top:auto !important;
  left:auto !important
}

#content .grid-item img 
{
    display: block;
    width: 100%;
    height: auto;
    max-height: none;
    max-width: none;
}


.grid-item.p_two_third
{
    width: 886px;
}

.grid-item.p_one
{
    width: 1329px;
}

.portfolio-text-holder
{
    position: absolute;
    top: 30px;
    left: 30px;
    bottom: 30px;
    right: 30px;
    z-index: 1;
    font-size: 20px;
    background-color: white;
    text-align: center;   
    display: none;    
}
.portfolio-text-holder p{
    margin-top:60px !important    
  }
  .portfolio-text-holder p:nth-child(2){
    color:#777
  }
.grid-item a:hover
{
    color: #191919;
}

div.pp_default .pp_loaderIcon
{
    display: none !important;
}
</style>
 <div class="body-wrapper">     
    <div id="content" class="site-content">
                <article>
                    <div class="content-1330 center-relative">
                        <div class="clear"></div>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <div class="button-group filters-button-group">
                            <div class="button is-checked" data-filter="*">همه</div>
                            @foreach($categories as $category)
                              <div class="button" data-filter=".{{ 'cat-'.$category->id }}">{{ $category->name }}</div>
                            @endforeach
                        </div>
                        <div class="grid" id="portfolio">
                            <div class="grid-sizer"></div>
                            @foreach($galleries as $gallery)
                            <div class="col-md-3 grid-item element-item p_one_third {{ "cat-".$gallery->category_id }}">
                                <a href="#">
                                    <img src="{{ asset($gallery->picture) }}" style="width:100%" alt="">
                                  @if($gallery->title1)  
                                  <div class="portfolio-text-holder">
                                        <p>{{ $gallery->title1 }}</p>
                                        <p>{{ $gallery->title2 }}</p>
                                    </div>
                                  @endif
                                </a>
                            </div>
                            @endforeach
                            
                        </div>
                        <div class="clear"></div>
                    </div>
                </article>
            </div>
</div>
@endsection
@section('extraScripts')
       <script src='/assets/js/jquery.fitvids.js'></script>
        <script src='/assets/js/jquery.smartmenus.min.js'></script>        
        <script src='/assets/js/imagesloaded.pkgd.js'></script>        
        <script src='/assets/js/isotope.pkgd.js'></script>        
        <script src='/assets/js/jquery.carouFredSel-6.0.0-packed.js'></script>
        <script src='/assets/js/jquery.mousewheel.min.js'></script>
        <script src='/assets/js/jquery.touchSwipe.min.js'></script>
        <script src='/assets/js/jquery.easing.1.3.js'></script>
        <script src='/assets/js/jquery.prettyPhoto.js'></script>        
        <script src='/assets/js/jquery.ba-throttle-debounce.min.js'></script> 
<script>
//Portfolio

    var grid = jQuery('.grid').imagesLoaded(function () {
        grid.isotope({
            itemSelector: '.grid-item',
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });

        // bind filter button click
        jQuery('.filters-button-group').on('click', '.button', function () {
            var filterValue = jQuery(this).attr('data-filter');
            grid.isotope({filter: filterValue});
            grid.on('arrangeComplete', function () {
                jQuery(".grid-item:visible a[rel^='prettyPhoto']").prettyPhoto({
                    slideshow: false, /* false OR interval time in ms */
                    overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
                    default_width: 1280,
                    default_height: 720,
                    deeplinking: false,
                    social_tools: false,
                    iframe_markup: '<iframe src ="{path}" width="{width}" height="{height}" frameborder="no" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',
                    changepicturecallback: function () {
                        if (!is_touch_device()) {
                            var ua = navigator.userAgent.toLowerCase();
                            if (!(ua.indexOf("safari/") !== -1 && ua.indexOf("windows") !== -1 && ua.indexOf("chrom") === -1))
                            {
                                jQuery("html").getNiceScroll().remove();
                                jQuery("html").css("cssText", "overflow: hidden !important");
                            }
                        }
                    },
                    callback: function () {
                        if (!is_touch_device()) {
                            var ua = navigator.userAgent.toLowerCase();
                            if (!(ua.indexOf("safari/") !== -1 && ua.indexOf("windows") !== -1 && ua.indexOf("chrom") === -1))
                            {
                                jQuery("html").niceScroll({cursorcolor: "#b1b1b1", scrollspeed: 100, mousescrollstep: 80, cursorwidth: "12px", cursorborder: "none", cursorborderradius: "0px"});
                            }
                        }
                    }
                });

            });
        });


        // change is-checked class on buttons
        jQuery('.button-group').each(function (i, buttonGroup) {
            var $buttonGroup = jQuery(buttonGroup);
            $buttonGroup.on('click', '.button', function () {
                $buttonGroup.find('.is-checked').removeClass('is-checked');
                jQuery(this).addClass('is-checked');
            });
        });


        //Fix for portfolio item text
        jQuery('.portfolio-text-holder').each(function () {
            jQuery(this).find('p').css('margin-top', jQuery(this).height() / 2);
        });

        //Fix for portfolio hover text fade in/out
        jQuery('.grid-item a').hover(function () {
            jQuery(this).find('.portfolio-text-holder').fadeIn('fast');
        }, function () {
            jQuery(this).find('.portfolio-text-holder').fadeOut('fast');
        });
    });


  
</script>
@endsection