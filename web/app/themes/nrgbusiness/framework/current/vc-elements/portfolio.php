<?php

class WPBakeryShortCode_Nrgbusiness_Portfolio extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'title' => 'Latest works',
            'column' => '4',
            'count' => '8',
            'filter' => 'no',
            'load_more' => 'no',
            'categories' => ''
        ), $atts));


        // build category ids
        $cats = array();
        if( !empty($categories) ){
            $exps = explode(",", $categories);
            foreach($exps as $val){
                if( (int)$val>-1 ){
                    $cats[]=(int)$val;
                }
            }
        }


        // build query
        $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => $count,
                        'ignore_sticky_posts' => true
                    );
        if(!empty($cats)){
            $args['tax_query'] = array(
                                    'relation' => 'IN',
                                    array(
                                        'taxonomy' => 'portfolio_entries',
                                        'field' => 'id',
                                        'terms' => $cats
                                    )
                                );
        }

        
        $filter_html = '';
        $cat_array = array();
        $items = '';
        $encoded_args = serialize($args);
        $img = '';

        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();
            
            if( has_post_thumbnail() ){
                $img = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'nrgbusiness-project-img' );
            }


            $cats = '';
            $cat_titles = array();
            $terms = wp_get_post_terms(get_the_ID(), 'portfolio_entries');
            foreach ($terms as $term){
                $cat_title = $term->name;
                $cat_slug = $term->slug;

                $cat_titles []= $cat_title;
                if( $filter=='yes' && !in_array($term->term_id, $cat_array) ){
                    $filter_html .= "<button class='button' data-filter='.ftr-$cat_slug'>$cat_title</button>";
                    $cat_array[] = $term->term_id;
                }

                $cats .= "ftr-$cat_slug ";
            }

            $items .= "<a class='work-img $cats' href='".get_permalink()."' data-category='$cats'>
                            $img
                            <div class='work-description'>
                                <h5>".get_the_title()."</h5>
                                <p>".implode(', ', $cat_titles)."</p>
                            </div>
                        </a>";
            
        }
        // reset query
        wp_reset_postdata();

        if( $filter=='yes' ){
            $filter_html = "<div class='container'>
                                <div class='late'>
                                    <h3>$title</h3>
                                </div>
                                <div id='filters'>
                                    <button class='button actual' data-filter='*'>".__('all', 'nrgbusiness')."</button>
                                    $filter_html
                                </div>
                            </div>";
        }

        $load_more_link = '';
        if( $load_more=='yes' ){
            $load_more_link = "<div><a class='read-more view' href='#'>".__('View all works', 'nrgbusiness')." <i class='fa fa-long-arrow-right'></i></a></div>";
        }

        return "<div class='lates-work text-center' data-column='$column'>
                    $filter_html
                    <div class='container-fluid'>
                        <div class='row' >
                            <div class='isotope allmenu'>
                                <div class='grid'></div>
                                $items
                            </div>
                            <div class='folio-args'>$encoded_args</div>
                        </div>
                    </div>
                    $load_more_link
                </div>";
    }
}

vc_map( array(
    "name" => __('Portfolio', 'nrgbusiness'),
    "description" => __("post type: portfolio", 'nrgbusiness'),
    "base" => 'nrgbusiness_portfolio',
    "icon" => "tt-icon portfolio",
    "content_element" => true,
    "category" => __('NRGBusiness', 'nrgbusiness'),
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => __("Title", 'nrgbusiness'),
            "value" => 'Latest works',
            "holder" => 'div'
        ),
        array(
            "type" => "dropdown",
            "param_name" => "column",
            "heading" => __("Column", 'nrgbusiness'),
            "value" => array(
                "1 column" => "1",
                "2 columns" => "2",
                "3 columns" => "3",
                "4 columns" => "4",
                "5 columns" => "5",
                "6 columns" => "6"
            ),
            "std" => "4"
        ),
        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => __("Count (posts per page)", 'nrgbusiness'),
            "value" => '8'
        ),
        array(
            "type" => "dropdown",
            "param_name" => "filter",
            "heading" => __("Show Filter", 'nrgbusiness'),
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
            "std" => "no"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "load_more",
            "heading" => __("Show more button?", 'nrgbusiness'),
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
            "std" => "no"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "load_more",
            "heading" => __("Show more button?", 'nrgbusiness'),
            "value" => array(
                "No" => "no",
                "Yes" => "yes"
            ),
            "std" => "no"
        ),
        array(
            "type" => 'textfield',
            "param_name" => "categories",
            "heading" => __("Categories", 'nrgbusiness'),
            "description" => __("Specify category ID (multiple IDs with comma) or leave blank to display items from all categories.", 'nrgbusiness'),
            "value" => ''
        )
    )
));




add_action('wp_ajax_nrgbusiness_portfolio_posts', 'nrgbusiness_portfolio_posts_hook');
add_action('wp_ajax_nopriv_nrgbusiness_portfolio_posts', 'nrgbusiness_portfolio_posts_hook');

function nrgbusiness_portfolio_posts_hook(){
    $encoded_args = $_POST['folio_args'];
    $pager = $_POST['pager'];
    $args = unserialize($encoded_args);

    $args['paged'] = $pager;

    $posts_query = new WP_Query($args);

    if( $posts_query->have_posts() ){
        
        $items = '';
        $filter_html = '';
        $cat_array = array();

        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();

            $img = '';
            $img_full = '';
            if( has_post_thumbnail() ){
                $img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'folio-thumb' );
                $img_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                $img = !empty($img) ? $img[0] : '';
                $img_full = !empty($img_full) ? $img_full[0] : '';
            }


            $cats = '';
            $cat_titles = array();
            $terms = wp_get_post_terms(get_the_ID(), 'portfolio_entries');
            foreach ($terms as $term){
                $cat_title = $term->name;
                $cat_slug = $term->slug;

                $cat_titles []= $cat_title;
                if( !in_array($term->term_id, $cat_array) ){
                    $filter_html .= "<li data-value='ftr-$cat_slug'><a href='javascript:;'>$cat_title</a></li>";
                    $cat_array[] = $term->term_id;
                }

                $cats .= "ftr-$cat_slug ";
            }

            $items .= '<li class="'.$cats.'">
                            <div class="portfolio-image-block">
                                <a title="Portfolio image" href="'.get_permalink().'"><img src="'.$img.'" alt="portfolio image 1"></a>
                                <div class="portfolio-block-hover">
                                    <a title="'.esc_attr(get_the_title()).'" href="'.get_permalink().'" class="portfolio-title">'.get_the_title().'</a>
                                    <p>'.implode(', ', $cat_titles).'</p>
                                    <hr>
                                    <div class="zoom-link">
                                        <a title="Search Icon" href="'.$img_full.'"><i class="fa fa-search"></i></a>
                                        <a title="Link" href="'.get_permalink().'"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </li>';
        }

        echo json_encode( array(
                'result' => '1',
                'folio'  => $items,
                'filter' => $filter_html,
                'args'  => $args
            ) );
    }
    else{
        echo json_encode( array('result' => '0') );
        exit;
    }
    
    
    exit;
}
