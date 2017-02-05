<?php
    function dd($var) {
        die(var_dump($var));
    }

    function fetchPosts(array $args = ['post_type' => 'any'])
    {
        $query = new WP_Query($args);
        if ( !$query->have_posts() ){
            return false;
        }
        return $query->posts;
    }

    function getLastPostsCategory(array $categories = [])
    {
        $available_categories = get_categories();
        if (!$categories) {
            $categories = $available_categories;
        } else {
            $categories = array_filter($available_categories, function($category) use ($categories) {
                $cat_name = $category->name;
                return in_array($cat_name, $categories);
            });
        }

        $posts = [];
        foreach ($categories as $category) {
            $args = array(
                'cat' => $category->term_id,
                'post_type' => 'post',
                'posts_per_page' => '1');

            $posts[$category->name] = (fetchPosts($args))[0];
        }
        return $posts;
    }

    function wpb_custom_new_menu() {
        register_nav_menu('main-menu',__( 'Main Menu' ));
        register_nav_menu('top_right',__( 'Top Right' ));
    }
    add_action( 'init', 'wpb_custom_new_menu' );

    function getMenuIdFromLocation($menu_location) {
        $locations = get_nav_menu_locations();
        return $locations[$menu_location];
    }

    function getMenuStructureObjectById($menu_ID) {
        $wp_menu_items = wp_get_nav_menu_items($menu_ID);
        $menu_items = [];
        foreach ($wp_menu_items as $wp_menu_item) {
            $menu_item = [
                'title' => $wp_menu_item->title,
                'url' => $wp_menu_item->url,
                'parent' => $wp_menu_item->menu_item_parent,
                'ID' => $wp_menu_item->ID,
                'children' => []
            ];
            $menu_items[$wp_menu_item->ID] = $menu_item;
        }
        return $menu_items;
    }

    function structureMenuItems($menuItems) {
        $newMenuItems = [];

        foreach ($menuItems as $ID => $menuItem) {
            if ($menuItem['parent'] == 0) {
                $newMenuItems[$ID] = structureMenuItem($menuItems, $menuItem);
            }
        }
        return $newMenuItems;
    }

    function structureMenuItem($menuItems, $currentItem) {
        foreach ($menuItems as $ID => $menuItem) {
            if ($menuItem['parent'] == $currentItem['ID'])
            {
                $currentItem['children'][$menuItem['ID']] = structureMenuItem($menuItems, $menuItem);
            }
        }

        return $currentItem;
    }

    function children(array $menu_items) {
        foreach ($menu_items as $menu_item) {
            if($menu_item['parent']) {
                $menu_items[$menu_item['parent']]['children'][] = $menu_item['ID'];
            }
        }
        return $menu_items;
    }
?>