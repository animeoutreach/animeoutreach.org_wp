<?php

// Parent 
class WPBakeryShortCode_Slider_Navigation extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'count' => '4',
            'style' => 'brand',
            'extra_class' => ''
        ), $atts));
        $styleclass = 'brand-color';
        if($style != 'brand') {
            $styleclass = 'transparent';
        }
        $column = 'column-'.(12/(int)$count);
        return "<div class='banner-navigation $styleclass clearfix $column $extra_class'>".do_shortcode($content)."</div>";
    }
}

vc_map( array(
    "name" => __('Slider navigation', 'nrgbusiness'),
    "description" => __("External Revolution slideshow navigator container", 'nrgbusiness'),
    "base" => 'slider_navigation',
    "icon" => "tt-icon slider-external-navigation",
    "category" => __('NRGBusiness', 'nrgbusiness'),
    'is_container' => true,
    "content_element" => true,
    "show_settings_on_create" => true,
    "as_parent" => array("only" => "slider_navigation_el"),
    "params" => array(
        array(
            "type" => 'dropdown',
            "param_name" => "count",
            "heading" => __("Column number", 'nrgbusiness'),
            "value" => array(
                "2 columns" => "2",
                "3 columns" => "3",
                "4 columns" => "4",
                "6 columns" => "6"
            ),
            "std" => "4"
        ),
        array(
            "type" => 'dropdown',
            "param_name" => "style",
            "heading" => __("Design Style", 'nrgbusiness'),
            "value" => array(
                "Brand coloured" => "brand",
                "Transparent centered + Brand border bottom" => "transparent",
            ),
            "std" => "brand"
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


// Child element
class WPBakeryShortCode_Slider_Navigation_El extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'icon_type' => 'icon_font',
            'icon' => 'fa fa-smile-o',
            'image' => '',
            'title' => '',
            'description' => '',
            'extra_class' => ''
        ), $atts));

        $thumb = "<span class='element-icon $icon'></span>";
        if($icon != 'icon') {
            $thumb = $image != '' ? wp_get_attachment_image($image, 'member') : $thumb;
        }

        return "<div class='banner-nav-item'>
            $thumb
            <h3>$title</h3>
            <p>$description</p>
        </div>";
    }
}

vc_map( array(
    "name" => __('Slider navigation element', 'nrgbusiness'),
    "description" => __("Slider external navigation element", 'nrgbusiness'),
    "base" => 'slider_navigation_el',
    "icon" => "tt-icon slider-external-navigation",
    "as_child" => array("only" => "slider_navigation"),
    "show_settings_on_create" => true,
    "category" => __('NRGBusiness', 'nrgbusiness'),
    "params" => array(
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
            "value" => "fa fa-adjust",
            'std' => '', // default value to backend editor admin_label
            'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            "std" => "fa fa-adjust",
            "dependency" => Array("element" => "icon_type", "value" => array("icon_font"))
        ),
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => __("Title", 'nrgbusiness'),
            "value" => 'Service Title',
            "holder" => 'div'
        ),
        array(
            "type" => 'textarea',
            "param_name" => "description",
            "heading" => __("Description", 'nrgbusiness'),
            "value" => 'Magni dolores eos qui ratione kavo uptatem sequi nescin.',
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