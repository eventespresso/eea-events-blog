<?php
/*
  Plugin Name:      Front Page Events by Espresso Themes
  Plugin URI:       http://espressothemes.com/front-page-events/
  Description:      Injects events into your main blog query. Created for Barista by Event Espresso but also works great with themes from EspressoThemes.com.
  Version:          1.0.0
  Author:           Seth Shoultes
  Author URI:       http://eventespresso.com
  License:          GPL
  Copyright         (c) 2008-2018 Event Espresso  All Rights Reserved.
  */

/**
 * Adds events to your main blog query.
 *
 * @since      %VER%
 * @package    EE_Saas_Solution
 * @subpackage admin, templates
 * @author     Darren Ethier
 */

require 'plugin_update_check.php';
$MyUpdateChecker = new PluginUpdateChecker_2_0 (
    'https://kernl.us/api/v1/updates/5a1399aaf5827e0dd3e5fd56/',
    __FILE__,
    'eea-events-blog',
    1
);

//add events into main blog query.
add_action('pre_get_posts', 'integrate_events_with_posts', 10);
function integrate_events_with_posts($WP_Query){

        /**
         * don't inject on post list posts.
         */
        if (is_admin()) {
           return;
        }

        if ($WP_Query instanceof WP_Query
            && $WP_Query->is_main_query()
            && ($WP_Query->is_feed
                || $WP_Query->is_posts_page
                || ($WP_Query->is_home
                    && ! $WP_Query->is_page
                )
            )
        ) {
            //if post_types ARE present and 'post' is not in that array, then get out!
            if (isset($WP_Query->query_vars['post_type']) && $post_types = (array)$WP_Query->query_vars['post_type']) {
                if (! in_array('post', $post_types)) {
                    return;
                }
            } else {
                $post_types = array('post');
            }

            if (! in_array('espresso_events', $post_types)) {
                $post_types[] = 'espresso_events';
                $WP_Query->set('post_type', $post_types);
            }
            return;
        }
    }