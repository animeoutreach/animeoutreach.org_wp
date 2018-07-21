<?php
class Extend_VC_Row{

    function __construct(){
        add_action('init', array($this, 'row_init'));

        if(defined('WPB_VC_VERSION') && version_compare( WPB_VC_VERSION, '4.4', '>=' )) {
            add_filter('vc_shortcode_output', array($this, 'vc_shortcode_output'),10,3);
        }

        add_filter( 'vc_shortcodes_css_class', array($this, 'custom_css_classes_for_vc'), 10, 2 );
    }

    
    // Filter to replace default css class names
    function custom_css_classes_for_vc( $class_string, $tag ) {
        if( $tag == 'vc_row' || $tag == 'vc_row_inner' ){  }
        if( $tag == 'vc_column' || $tag == 'vc_column_inner' ){  }
        return $class_string;
    }


    public function vc_shortcode_output($output, $obj, $attr){
        if($obj->settings('base')=='vc_row') {
            if( isset($attr['one_page_section'], $attr['one_page_label']) && $attr['one_page_section']=='yes' && !empty($attr['one_page_label']) ){
                $uniqid = "section-" . uniqid();
                $uniqid = isset( $attr['one_page_slug'] ) && !empty($attr['one_page_slug']) ? $attr['one_page_slug'] : $uniqid;
                $uniqid = str_replace("#", "", $uniqid);
                
                return "<div class='one-page-section' data-id='".esc_attr($uniqid)."' data-label='".esc_attr($attr['one_page_label'])."'></div>" . $output;
            }
        }
        else if($obj->settings('base')=='vc_column'){
            if( array_key_exists("vertical_align", $attr) && !empty($attr["vertical_align"]) && $attr["vertical_align"]!='none' ){
                $align = isset($attr["horizontal_align"]) && $attr["horizontal_align"]!='none' ? $attr["horizontal_align"] : 'left';
                return $output . "<div class='vc-col-option' data-valign='".$attr["vertical_align"]."' data-align='".$align."'></div>";
            }
        }
        else if($obj->settings('base')=='vc_column_inner'){
            if( array_key_exists("vertical_align", $attr) && !empty($attr["vertical_align"]) && $attr["vertical_align"]!='none' ){
                return $output . "<div class='vc-col-option' data-valign='".$attr["vertical_align"]."'></div>";
            }
        }
        else if($obj->settings('base')=='vc_custom_heading'){
            $after_text = $attr['after_text'];
            if( !empty($after_text) ){
                return str_replace(" style=", " data-text='".esc_attr($after_text)."' style=", $output);
            }
        }

        return $output;
    }



    public function row_init(){
        if( function_exists('vc_add_param') ){

            vc_add_param('vc_custom_heading', array(
                "type" => "textfield",
                "heading" => __("After Text", 'nrgbusiness'),
                "param_name" => "after_text",
                "value" => ""
            ));
            

            vc_add_param('vc_row', array(
                "type" => "dropdown",
                "heading" => __("One Page Section <small>(One page template only)</small>", 'nrgbusiness'),
                "param_name" => "one_page_section",
                "value" => array(
                        __("No", 'nrgbusiness') => "no",
                        __("Yes", 'nrgbusiness') => "yes",
                    )
            ));

            vc_add_param('vc_row', array(
                "type" => "textfield",
                "heading" => __("Section Label", 'nrgbusiness'),
                "param_name" => "one_page_label",
                "value" => "",
                "dependency" => Array("element" => "one_page_section", "value" => array("yes"))
            ));

            vc_add_param('vc_row', array(
                "type" => "textfield",
                "heading" => __("Section slug", 'nrgbusiness'),
                "description" => __("Don't need hash (#) tag at first. You can add a custom link with http protocol to redirect.", 'nrgbusiness'),
                "param_name" => "one_page_slug",
                "value" => "",
                "dependency" => Array("element" => "one_page_section", "value" => array("yes"))
            ));


            // Column
            vc_add_param('vc_column', array(
                "type" => "dropdown",
                "heading" => __("Horizontal Alignment", 'nrgbusiness'),
                "param_name" => "horizontal_align",
                "value" => array(
                        __("None", 'nrgbusiness') => "none",
                        __("Left", 'nrgbusiness') => "left",
                        __("Center", 'nrgbusiness') => "center",
                        __("Right", 'nrgbusiness') => "right"
                    )
            ));
            vc_add_param('vc_column', array(
                "type" => "dropdown",
                "heading" => __("Vertical Alignment", 'nrgbusiness'),
                "param_name" => "vertical_align",
                "value" => array(
                        __("None", 'nrgbusiness') => "none",
                        __("Top", 'nrgbusiness') => "top",
                        __("Middle", 'nrgbusiness') => "middle",
                        __("Bottom", 'nrgbusiness') => "bottom"
                    )
            ));

            // Inner Column
            vc_add_param('vc_column_inner', array(
                "type" => "dropdown",
                "heading" => __("Vertical Alignment", 'nrgbusiness'),
                "param_name" => "vertical_align",
                "value" => array(
                        __("None", 'nrgbusiness') => "none",
                        __("Top", 'nrgbusiness') => "top",
                        __("Middle", 'nrgbusiness') => "middle",
                        __("Bottom", 'nrgbusiness') => "bottom"
                    )
            ));
            
        }
    }
}

if( function_exists('vc_map') )
    new Extend_VC_Row();