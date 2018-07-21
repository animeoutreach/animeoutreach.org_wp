<?php

class WPBakeryShortCode_Project_Logo extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'logo' => '',
            'image' => '',
            'title' => '',
            'description' => '',
            'link' => '#',
            'extra_class' => ''
        ), $atts));

        $image = $image != '' ? wp_get_attachment_image($image, 'project-img') : '';

        $logo = $logo != '' ? wp_get_attachment_image($logo) : '';    

        return "<div class='project-desk $extra_class'>
                    <a href='$link'><div class='project-mon'>
                        $image
                        <div class='logo-ds'>
                            <h5>$title</h5>
                            <p>$description</p>
                        </div>
                    </div>
                    </a>
                    <p class='logo-d'>
                        $logo
                    </p>
                </div>";
    }
}

vc_map( array(
    "name" => __('Project with Logo', 'nrgbusiness'),
    "description" => __("Project with Logo", 'nrgbusiness'),
    "base" => 'project_logo',
    "icon" => "tt-icon project-logo",
    "content_element" => true,
    "category" => __('NRGBusiness', 'nrgbusiness'),
    'params' => array(
        array(
            "type" => 'attach_image',
            "param_name" => "logo",
            "heading" => __("Logo", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'attach_image',
            "param_name" => "image",
            "heading" => __("Image", 'nrgbusiness'),
            "value" => ''
        ),
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => __("Project Name", 'nrgbusiness'),
            "value" => 'Project Name',
            "holder" => 'div'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "description",
            "heading" => __("Description", 'nrgbusiness'),
            "value" => 'Project Description'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "link",
            "heading" => __("Link", 'nrgbusiness'),
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