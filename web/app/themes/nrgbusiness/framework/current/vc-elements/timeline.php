<?php

class WPBakeryShortCode_Timeline extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'image' => '',
            'date' => '',
            'title' => ''
        ), $atts));

        $image = $image != '' ? wp_get_attachment_image($image, 'project-img') : '';
        $content = wpb_js_remove_wpautop( $content, true );
        
        return "<div class='swiper-slide'>
                    <div class='story-d'>
                        <div class='story-description'>
                            <div class='story-image'>
                                $image
                                <p>$date</p>
                            </div>
                             <h6>$title</h6>
                            <div class='history-p'>
                                 $content
                            </div>
                        </div>
                        <div class='story-date'>
                            <p>$date</p>
                        </div>
                    </div>
                </div>";
    }
}

vc_map( array(
    "name" => __('Timeline', 'nrgbusiness'),
    "description" => __("Timeline", 'nrgbusiness'),
    "base" => 'timeline',
    "icon" => "tt-icon timeline",
    "content_element" => true,
    "as_child" => array('only' => 'timeline_carousel'),
    "category" => __('NRGBusiness', 'nrgbusiness'),
    'params' => array(
        array(
            "type" => 'attach_image',
            "param_name" => "image",
            "heading" => __("Image", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'textfield',
            "param_name" => "date",
            "heading" => __("Date", 'nrgbusiness'),
            "value" => '',
        ),
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => __("Title", 'nrgbusiness'),
            "value" => '',
            "holder" => 'div'
        ),
        array(
            "type" => 'textarea_html',
            "param_name" => "content",
            "heading" => __("Description", 'nrgbusiness'),
            "value" => ''
        )
    )
));