<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package noxiy
 */

get_header();

if (get_post_meta($post->ID, 'noxiy_meta_options', true)) {
    $noxiy_meta = get_post_meta($post->ID, 'noxiy_meta_options', true);
} else {
    $noxiy_meta = array();
}
if (is_array($noxiy_meta) && array_key_exists('site_layout', $noxiy_meta) && $noxiy_meta['layout_enable'] != 'no') {
    $site_layout = $noxiy_meta['site_layout'];
} else {
    $site_layout = noxiy_option('service_layout', 'right-sidebar');
}

if (is_array($noxiy_meta) && array_key_exists('site_layout', $noxiy_meta) && $noxiy_meta['site_layout'] != 'full-width') {
    $selected_sidebar = $noxiy_meta['site_sidebars'];
} else {
    $selected_sidebar = noxiy_option('service_sidebar', 'sidebar-1');
}

if ($site_layout == 'left-sidebar' && is_active_sidebar($selected_sidebar) || $site_layout == 'right-sidebar' && is_active_sidebar($selected_sidebar)) {
    $content_layout = 'col-lg-8 lg-mb-60';
} else {
    $content_layout = 'col-lg-12';
}

if (array_key_exists('breadcrumb_enable', $noxiy_meta)) {
    $enable_banner = $noxiy_meta['breadcrumb_enable'];
} else {
    $enable_banner = 'yes';
}

if (array_key_exists('section_padding', $noxiy_meta)) {
    $section_padding = $noxiy_meta['section_padding'];
} else {
    $section_padding = 'section-padding';
}
?>

<main id="primary" class="site-main">
    <?php
    if ($enable_banner == 'yes') :
        get_template_part('template-parts/theme-default/' . 'breadcrumb');
    endif;
    ?>
    <div class="<?php echo esc_attr($section_padding); ?>">
        <div class="container">
            <div class="row">
                <?php
                if ($site_layout == 'left-sidebar' && is_active_sidebar($selected_sidebar)) : ?>
                    <div class="col-lg-4 order-last order-lg-first">
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>
                <div class="<?php echo esc_attr($content_layout); ?>">
                    <div class="service-single">
                        <?php the_content(); ?>
                    </div>
                </div>

                <?php
                if ($site_layout == 'right-sidebar' && is_active_sidebar($selected_sidebar)) : ?>
                    <div class="col-lg-4">
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main><!-- #main -->

<?php

get_footer();