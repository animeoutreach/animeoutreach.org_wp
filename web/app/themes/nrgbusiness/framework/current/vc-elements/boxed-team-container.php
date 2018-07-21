<?php


class WPBakeryShortCode_Boxed_Team_Carousel extends WPBakeryShortCodesContainer{
    protected function content($atts, $content=NULL){
        extract(shortcode_atts(array(
            'number' => 3,
            'extra_class' => ""
        ), $atts));

        $result = '';

        $result = '<div class="boxed-team-carousel swiper-container '.$extra_class.'" data-mode="horizontal" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="'.$number.'" data-loop="0" data-space-between="30" data-centered="0">
                        <div class="swiper-wrapper">
                            '.do_shortcode($content).'
                        </div>
                        <div class="pagination swiper-pagination ts-pagination hide"></div>
                    </div>';

        return $result;
    }
}


vc_map( array(
    "name" => __("Boxed Team Carousel", 'nrgbusiness'),
    "description" => __("Boxed Team Slider Container", 'nrgbusiness'),
    "show_settings_on_create" => true,
    'is_container' => true,
    "content_element" => true,
    "as_parent" => array("only" => "boxed_team"),
    "base" => "boxed_team_carousel",
    "icon" => "tt-icon boxed-team-container",
    "category" => __('NRGBusiness', 'nrgbusiness'),
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("How many member displays?", 'nrgbusiness'),
            "param_name" => "number",
            "value" => array(
                    __("One", 'nrgbusiness') => "1",
                    __("Two", 'nrgbusiness') => "2",
                    __("Three", 'nrgbusiness') => "3",
                    __("Four", 'nrgbusiness') => "4",
                    __("Five", 'nrgbusiness') => "5"
                )
        ),
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