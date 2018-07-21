<?php

class WPBakeryShortCode_Boxed_Team extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'title' => '',
            'position' => '',
            'image' => '',
            'link_facebook' => '',
            'link_twitter' => '',
            'link_google_plus' => '',
            'link_linkedin' => '',
            'icon_color' => ''
        ), $atts));

        $thumb = $image != '' ? wp_get_attachment_image($image, 'nrgbusiness-member') : '';

        
        $thumb = str_replace(' class="', ' class="member ', $thumb);

        $socials = array('facebook', 'twitter', 'google_plus', 'linkedin');
        $icons = '';
        foreach($socials as $social) {
            $var = 'link_'.$social;
            if(isset($$var) && $$var != '') {
                $social = str_replace("_", "-", $social);
                $icons .= "<a class='member-social' href='${$var}'><i class='fa fa-$social' style='color: $icon_color;'></i></a>";
            }
        }
        return "<div class='swiper-slide'>
                    <div class='team-member'>
                        <div class='soc-net'>
                            $icons
                        </div>
                        $thumb
                        <h5>$title</h5>
                        <p>$position</p>
                    </div>
                </div>";
    }
}

vc_map( array(
    "name" => __('Boxed team', 'nrgbusiness'),
    "description" => __("Boxed team", 'nrgbusiness'),
    "base" => 'boxed_team',
    "icon" => "tt-icon boxed-team",
    "content_element" => true,
    "as_child" => array("only" => "boxed_team_carousel"),
    "category" => __('NRGBusiness', 'nrgbusiness'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => __("Name", 'nrgbusiness'),
            "value" => 'BENJAMIN THOMAS',
            "holder" => 'div'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "position",
            "heading" => __("Position", 'nrgbusiness'),
            "value" => 'Creative Director'
        ),
        array(
            "type" => 'attach_image',
            "param_name" => "image",
            "heading" => __("Image", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'textfield',
            "param_name" => "link_facebook",
            "heading" => __("Facebook URL (optional)", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'textfield',
            "param_name" => "link_twitter",
            "heading" => __("Twitter URL (optional)", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'textfield',
            "param_name" => "link_google",
            "heading" => __("Google+ URL (optional)", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'textfield',
            "param_name" => "link_linkedin",
            "heading" => __("Linkedin URL (optional)", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            'type' => 'colorpicker',
            "param_name" => "icon_color",
            "heading" => __("Social Icon Color", 'nrgbusiness'),
            "value" => '',
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