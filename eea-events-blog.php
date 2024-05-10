<?php

/*
  Plugin Name:      Event Espresso - Front Page Events
  Plugin URI:       http://espressothemes.com/front-page-events/
  Description:      Injects events into your main blog query.
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

// add events into main blog query.
add_action('pre_get_posts', 'espresso_integrate_events_with_posts', 10);
function espresso_integrate_events_with_posts($WP_Query)
{

        /**
         * don't inject on post list posts.
         */
    if (is_admin()) {
       return;
    }

    if (
        $WP_Query instanceof WP_Query
            && $WP_Query->is_main_query()
            && ($WP_Query->is_feed
                || $WP_Query->is_posts_page
                || ($WP_Query->is_home
                    && ! $WP_Query->is_page
                )
            )
    ) {
        // if post_types ARE present and 'post' is not in that array, then get out!
        if (isset($WP_Query->query_vars['post_type']) && $post_types = (array) $WP_Query->query_vars['post_type']) {
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
