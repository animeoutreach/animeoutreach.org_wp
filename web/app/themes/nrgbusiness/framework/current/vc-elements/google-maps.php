<?php

class WPBakeryShortCode_Google_Map extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "lat" => '55.6468',
            "lng" => '37.581',
            "color" => '',
            "zoom" => '10',
            "map_height" => '400',
            "marker" => ''
        ), $atts ) );

        wp_enqueue_script( 'google-map', '//maps.googleapis.com/maps/api/js?sensor=false&amp;language=en');
        wp_enqueue_script( 'google-map-config', get_template_directory_uri() . '/framework/current/vc-elements/google-maps.js', false, false, true );

        $image_src = !empty($marker) ? wp_get_attachment_image_src($marker, 'thumbnail') : '';
        $marker = !empty($image_src) ? $image_src[0] : '';

        $map_height = abs($map_height) . "px";

        $result = "<div id='tt-google-map' style='height:$map_height' class='tt-google-map' data-lat='$lat' data-lng='$lng' data-color='$color' data-zoom='$zoom' data-marker='$marker'>
                     <div id='gmap_content'>
                        <div class='gmap-item'>". $content ."</div>
                    </div>
        </div>";

        return $result;
    }
}

vc_map( array(
    "name" => __("Google Map", 'nrgbusiness'),
    "description" => __("Google Maps Latitude, Longitude", 'nrgbusiness'),
    "base" => "google_map",
    "class" => "",
    "icon" => "tt-icon google-maps",
    "category" => __('NRGBusiness', 'nrgbusiness'),
    "show_settings_on_create" => true,
    "front_enqueue_js" => 'http://maps.googleapis.com/maps/api/js?sensor=false&amp;language=en',
    "params" => array(
        array(
            'type' => 'textfield',
            "param_name" => "lat",
            "heading" => __("Latitude", 'nrgbusiness'),
            "value" => '55.6468'
        ),
        array(
            'type' => 'textfield',
            "param_name" => "lng",
            "heading" => __("Longitude", 'nrgbusiness'),
            "value" => '37.581'
        ),
        array(
            'type' => 'colorpicker',
            "param_name" => "color",
            "heading" => __("Hue Color", 'nrgbusiness'),
            "value" => '',
        ),
        array(
            'type' => 'textfield',
            "param_name" => "zoom",
            "heading" => __("Zoom", 'nrgbusiness'),
            "value" => '10',
            "desc"  => 'Zoom levels 0 to 18'
        ),
        array(
            'type' => 'textfield',
            "param_name" => "map_height",
            "heading" => __("Height", 'nrgbusiness'),
            "value" => '400'
        ),
        array(
            'type' => 'attach_image',
            "param_name" => "marker",
            "heading" => __("Marker Image", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            'type' => 'textarea_html',
            "param_name" => "content",
            "heading" => __("Content", 'nrgbusiness'),
            "value" => ''
        )

    )
) );