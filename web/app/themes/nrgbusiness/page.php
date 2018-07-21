<?php get_header(); ?>
    
    <?php get_template_part("tpl", "page-title"); ?>
    <div class="blog blog-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="row">
                    <?php if ( have_posts() ) : ?>
                        <?php
                        // Start the loop.
                        while ( have_posts() ) : the_post();

                            the_content();

                        endwhile;

                    // If no content, include the "No posts found" template.
                    else :
                        get_template_part( 'content', 'none' );
                    endif;

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        print "<div class='clearfix'></div>";
                        comments_template();
                    endif;
                    ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>