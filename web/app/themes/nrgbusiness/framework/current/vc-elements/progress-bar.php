<?php

class WPBakeryShortCode_Progress_Bar extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "desc"     => "",
            "precentage"     => "",
            "pre_color" =>"",
            "bg_color" => "",
            "extra_class" => ""
        ), $atts ) );

        $pre_color = $pre_color != '' ? " style='color:$pre_color'" : '';
        $bg_color = $bg_color != '' ? " background:$bg_color;" : '';

        $result = "<div class='sk-describe time-line $extra_class'>
                            <div class='skill'>
                                <div style='$bg_color' class='timer-wrapper'>
                                    <h3$pre_color class='timer countto' data-to='$precentage' data-speed='3000'>$precentage</h3>
                                </div>
                            </div>
                            <h5>$desc</h5>
                    </div>";

        return $result;

    }
}

vc_map( array(
    "name" => __("Progress Bar", 'nrgbusiness'),
    "description" => __("Show Process", 'nrgbusiness'),
    "base" => 'progress_bar',
    "class" => "",
    "icon" => "tt-icon progress-bar",
    "category" => __('NRGBusiness', 'nrgbusiness'),
    "show_settings_on_create" => true,
    "params" => array(
        array(
            'type' => 'textfield',
            "param_name" => "desc",
            "heading" => __("Description", 'nrgbusiness'),
            "value" => '',
            "holder" => 'div'
        ),
        array(
            'type' => 'textfield',
            "param_name" => "precentage",
            "heading" => __("Precentage", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            'type' => 'colorpicker',
            "param_name" => "pre_color",
            "heading" => __("Precentage color", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            'type' => 'colorpicker',
            "param_name" => "bg_color",
            "heading" => __("Precentage background color", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => __("Extra Class", 'nrgbusiness'),
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nrgbusiness'),
        )

    )
) );