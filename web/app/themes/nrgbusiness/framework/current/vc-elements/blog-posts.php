<?php

class WPBakeryShortCode_Nrgbusiness_Blog_Posts extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'count' => '3',
            'categories' => '',
            'extra_class' => ''
        ), $atts));

        $cats = array();
        if( !empty($categories) ){
            $exps = explode(",", $categories);
            foreach($exps as $val){
                if( (int)$val>-1 ){
                    $cats[]=(int)$val;
                }
            }
        }

        $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $count,
                        'ignore_sticky_posts' => true
                    );
        if(!empty($cats)){
            $args['category__in'] = $cats;
        }

        $items = '';
        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();

            $excerpt = wp_trim_words( wp_strip_all_tags(do_shortcode(get_the_content())), 10 );

            $img = '';
            if( has_post_thumbnail() ){
                $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'nrgbusiness-blog-thumb' );
                $img = !empty($img) ? $img[0] : '';
            }

            $postclass = implode(' ',get_post_class());
            $items .= "<div class='col-md-4 col-sm-4 post $postclass $extra_class'>
    <a href='".get_permalink()."'>".get_the_post_thumbnail( get_the_ID(), 'nrgbusiness-blog-thumb')."</a>
    <h5><a href='". get_permalink()."'>".get_the_title()."</a></h5>
    <p>".get_the_author()." | ". get_the_time('F d / Y')."</p>
    <a class='read-more red-blog' href='". get_permalink()."'>".esc_attr__('Read more', 'nrgbusiness')."<i class='fa fa-long-arrow-right'></i></a>
</div>";
}

        // reset query
        wp_reset_postdata();
       
        return "<div class='tt-blog-element $extra_class'>
                    $items
                </div>";
    }
}

vc_map( array(
    "name" => __('Blog Posts', 'nrgbusiness'),
    "description" => __("Only post type: post", 'nrgbusiness'),
    "base" => 'nrgbusiness_blog_posts',
    "icon" => "tt-icon blog",
    "content_element" => true,
    "category" => __('NRGBusiness', 'nrgbusiness'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => __("Posts Count", 'nrgbusiness'),
            "value" => '3'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "categories",
            "heading" => __("Categories", 'nrgbusiness'),
            "description" => __("Specify category Id or leave blank to display items from all categories.", 'nrgbusiness'),
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
));