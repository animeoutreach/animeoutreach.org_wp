<?php

class WPBakeryShortCode_Price_Table extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'title' => '',
            'color' => '',
            'price' => '',
            'per_year'=> 'per year',
            'icon_type' => 'icon_font',
            'image' => '',
            'icon' => '',
            'button_text' => 'Get It Now',
            'link' => '#',
            'extra_class' => ''
        ), $atts));

        $content = wpb_js_remove_wpautop( $content, true );

        if($icon_type == 'icon_image') {
            $image = wp_get_attachment_image($image, 'thumb');
        }

        $image_src = $icon_type == 'icon_font' ? "<i class='$icon pt-icon'></i>" : $image;

        $colorbg = $color != '' ? " style='background:$color'" : '';
        $colortx = $color != '' ? " style='color:$color'" : '';
        
        return "<div class='year-price $extra_class' data-color='$color'>
                    <div$colorbg class='overlay'></div>
                    <h6 class='user'>$title</h6>
                    <h3$colortx class='price-number'>$price</h3>
                    <p$colortx class='per-year'>$per_year</p>
                    $image_src
                    $content
                    <div$colorbg>
                        <a class='read-more' href='$link'>$button_text <i class='fa fa-long-arrow-right'></i></a>
                    </div>
                </div>";
    }
}

vc_map( array(
    "name" => __('Price Table Column', 'nrgbusiness'),
    "description" => __("A column of price table", 'nrgbusiness'),
    "base" => 'price_table',
    "icon" => "tt-icon price-table",
    "content_element" => true,
    "category" => __('NRGBusiness', 'nrgbusiness'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => __("Title", 'nrgbusiness'),
            "value" => '',
            "holder" => 'div'
        ),
        array(
            'type' => 'colorpicker',
            "param_name" => "color",
            "heading" => __("Color", 'nrgbusiness'),
            "value" => '',
        ),
        array(
            "type" => 'textfield',
            "param_name" => "price",
            "heading" => __("Price", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'textfield',
            "param_name" => "per_year",
            "heading" => __("Per Year", 'nrgbusiness'),
            "value" => 'per year'
        ),
        array(
            'type' => 'dropdown',
            "param_name" => "icon_type",
            "heading" => __("Icon Type", 'nrgbusiness'),
            "value" => array(
                "Icon font" => "icon_font",
                "Icon image" => "icon_image"
            ),
            "std" => "icon_font",
        ),
        array(
            'type' => 'attach_image',
            "param_name" => "image",
            "heading" => __("Image Image", 'nrgbusiness'),
            "value" => '',
            "dependency" => Array("element" => "icon_type", "value" => array("icon_image"))
        ),
        array(
            'type' => 'iconpicker',
            "param_name" => "icon",
            "heading" => __("Icon", 'nrgbusiness'),
            "description" => "",
            "value" => '',
            'std' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            "std" => "fa fa-adjust",
            "dependency" => Array("element" => "icon_type", "value" => array("icon_font"))
        ),
        array(
            "type" => 'textarea_html',
            "param_name" => "content",
            "heading" => __("Description", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'textfield',
            "param_name" => "button_text",
            "heading" => __("Button Text", 'nrgbusiness'),
            "value" => 'Get It Now'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "link",
            "heading" => __("Button Link", 'nrgbusiness'),
            "value" => '#'
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => __("Extra Class", 'nrgbusiness'),
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nrgbusiness'),
        )
    )
));