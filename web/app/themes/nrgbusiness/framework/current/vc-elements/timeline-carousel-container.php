<?php


class WPBakeryShortCode_Timeline_Carousel extends WPBakeryShortCodesContainer{
    protected function content($atts, $content=NULL){
        extract(shortcode_atts(array(
            'extra_class' => ""
        ), $atts));

        $result = '';


        $result = '<div class="swiper-container '.$extra_class.'" data-mode="horizontal" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="3" data-md-slides="3" data-lg-slides="3" data-loop="0">
                        <div class="swiper-wrapper">
                            '.do_shortcode($content).'
                        </div>
                        <div class="pagination swiper-pagination hidden"></div>
                   </div>';

        return "<div class='timeline-carousel-wrapper history'>$result</div>";
    }
}


vc_map( array(
    "name" => __("Timeline Carousel", 'nrgbusiness'),
    "description" => __("Timeline Container", 'nrgbusiness'),
    "show_settings_on_create" => true,
    'is_container' => true,
    "content_element" => true,
    "as_parent" => array("only" => "timeline"),
    "base" => "timeline_carousel",
    "icon" => "tt-icon timeline-carousel",
    "category" => __('NRGBusiness', 'nrgbusiness'),
    "params" => array(
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => __("Extra Class", 'nrgbusiness'),
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nrgbusiness'),
        )
    ),
    "js_view" => 'VcColumnView'
));