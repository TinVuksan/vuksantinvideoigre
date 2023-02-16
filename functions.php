<?php
if ( ! function_exists( 'inicijaliziraj_temu' ) )
{
function inicijaliziraj_temu()
{
$locations = array(
    'primary' => "Glavni navigacijski navbar",
    'footer' => "Navbar za footer",
    'mobile-menu' => "Navbar za mobitel"
);
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');
register_nav_menus($locations);
add_theme_support( 'custom-background', apply_filters(
'test_custom_background_args', array(
'default-color' => 'ffffff',
'default-image' => '',
) ) );
add_theme_support( 'customize-selective-refresh-widgets' );
}
}
add_action( 'after_setup_theme', 'inicijaliziraj_temu' );

function __search_by_title_only( $search, $wp_query )
{
    global $wpdb;
 
    if ( empty( $search ) )
        return $search; // skip processing - no search term in query
 
    $q = $wp_query->query_vars;    
    $n = ! empty( $q['exact'] ) ? '' : '%';
 
    $search =
    $searchand = '';
 
    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
 
    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
 
    return $search;
}
add_filter( 'posts_search', '__search_by_title_only', 500, 2 );



//regsitracija sidebar-a
function widgeti()
{
 register_sidebar(
 array (
 'name' => 'Glavni sidebar',
 'id' => 'sidebar-1',
 'description' => 'Sidebar widget area',
 'before_widget' => '<ul class="social-list list-inline py-3 mx-auto">',
 'after_widget' => '</ul>',
 'before_title' => '',
 'after_title' => '',
 ),
 array(
    
 )
 );

 register_sidebar(
    array (
    'name' => 'Footer widget',
    'id' => 'footer-1',
    'description' => 'Footer widget area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ),
    array(
       
    )
    );
}
add_action( 'widgets_init', 'widgeti' );

//custom image sizes
add_image_size('blog-large', 800, 400, true);
add_image_size('blog-small', 300, 200, true);

//učitavanje CSS datoteke
function ucitaj_glavni_css()
{
 $version = wp_get_theme() -> get('Version');
 wp_enqueue_style( 'glavni-css', get_template_directory_uri() . '/style.css', array('bootstrap'), $version, 'all');
 wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1', 'all');
 wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css', '5.13.0', 'all');
 wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/css/main.css', array(), $version, 'all');
}
add_action( 'wp_enqueue_scripts', 'ucitaj_glavni_css' );

//učitavanje javascript datoteke
function ucitaj_glavni_js()
{
    
wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array(), '3.4.1', 'all', true);
wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), '1.16.0', 'all', true);
wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(), '4.4.1', 'all', true);
wp_enqueue_script('glavni-js', get_template_directory_uri() . '/js/scripts.js' , array('jquery'), '1.0', 'all', true);
wp_enqueue_script('sort', get_stylesheet_uri() . '/js/sorting.js', array(), '', true);

 
}
add_action( 'wp_enqueue_scripts', 'ucitaj_glavni_js', 1 );

//! IGRA CPT
function registriraj_videoigru_cpt() {
    $labels = array(
    'name' => _x( 'Igre', 'Post Type General Name', 'vuv' ),
    'singular_name' => _x( 'Igra', 'Post Type Singular Name', 'vuv' ),
    'menu_name' => __( 'Igre', 'vuv' ),
    'name_admin_bar' => __( 'Igre', 'vuv' ),
    'archives' => __( 'Igre arhiva', 'vuv' ),
    'attributes' => __( 'Atributi', 'vuv' ),
    'parent_item_colon' => __( 'Roditeljski element', 'vuv' ),
    'all_items' => __( 'Sve igre', 'vuv' ),
    'add_new_item' => __( 'Dodaj novu igru', 'vuv' ),
    'add_new' => __( 'Dodaj novu', 'vuv' ),
    'new_item' => __( 'Nova igra', 'vuv' ),
    'edit_item' => __( 'Uredi igru', 'vuv' ),
    'update_item' => __( 'Ažuriraj igru', 'vuv' ),
    'view_item' => __( 'Pogledaj igru', 'vuv' ),
    'view_items' => __( 'Pogledaj igre', 'vuv' ),
    'search_items' => __( 'Pretraži igre', 'vuv' ),
    'not_found' => __( 'Nije pronađeno', 'vuv' ),
    'not_found_in_trash' => __( 'Nije pronađeno u smeću', 'vuv' ),
    'featured_image' => __( 'Glavna slika', 'vuv' ),
    'set_featured_image' => __( 'Postavi glavnu sliku', 'vuv' ),
    'remove_featured_image' => __( 'Ukloni glavnu sliku', 'vuv' ),
    'use_featured_image' => __( 'Postavi za glavnu sliku', 'vuv' ),
    'insert_into_item' => __( 'Umentni', 'vuv' ),
    'uploaded_to_this_item' => __( 'Preneseno', 'vuv' ),
    'items_list' => __( 'Lista', 'vuv' ),
    'items_list_navigation' => __( 'Navigacija među igrama', 'vuv' ),
    'filter_items_list' => __( 'Filtriranje nastavnika', 'vuv' ),
    );
    $args = array(
    'label' => __( 'Igra', 'vuv' ),
    'description' => __( 'Igra post type', 'vuv' ),
    'labels' => $labels,
    'show_in_rest' => true,
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields'),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-groups',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => false,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
    );
    register_post_type( 'igra', $args );
    }
    add_action( 'init', 'registriraj_videoigru_cpt', 0 );

    function ns_reg_tag() {
        register_taxonomy_for_object_type('post_tag','igra');
    }
    add_action('init', 'ns_reg_tag');

    //! IGRE TAKSONOMIJE

    function registriraj_taksonomiju_žanr() {
		$labels = array(
		'name' => _x( 'Žanrovi', 'Taxonomy General Name',
		'vuv' ),
		'singular_name' => _x( 'Žanr', 'Taxonomy Singular Name',
		'vuv' ),
		'menu_name' => __( 'Žanrovi', 'vuv' ),
		'all_items' => __( 'Svi žanrovi', 'vuv' ),
		'parent_item' => __( 'Roditeljsko zvanje', 'vuv' ),
		'parent_item_colon' => __( 'Roditeljsko zvanje', 'vuv' ),
		'new_item_name' => __( 'Novi žanr', 'vuv' ),
		'add_new_item' => __( 'Dodaj novi žanr', 'vuv' ),
		'edit_item' => __( 'Uredi žanr', 'vuv' ),
		'update_item' => __( 'Ažuiriraj žanr', 'vuv' ),
		'view_item' => __( 'Pogledaj žanr', 'vuv' ),
		'separate_items_with_commas' => __( 'Odvojite žanrove sa zarezima', 'vuv' ),
		'add_or_remove_items' => __( 'Dodaj ili ukloni žanr', 'vuv' ),
		'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
		'popular_items' => __( 'Popularni žanrovi', 'vuv' ),
		'search_items' => __( 'Pretraga žanrova', 'vuv' ),
		'not_found' => __( 'Nema rezultata', 'vuv' ),
		'no_terms' => __( 'Nema žanrova', 'vuv' ),
		'items_list' => __( 'Lista žanrova', 'vuv' ),
		'items_list_navigation' => __( 'Navigacija', 'vuv' ),
		);
		$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		);
		register_taxonomy( 'zanr', array( 'igra' ), $args );
		}
		add_action( 'init', 'registriraj_taksonomiju_žanr', 0);

        function registriraj_taksonomiju_konzola() {
            $labels = array(
            'name' => _x( 'Konzole', 'Taxonomy General Name',
            'vuv' ),
            'singular_name' => _x( 'Konzola', 'Taxonomy Singular Name',
            'vuv' ),
            'menu_name' => __( 'Konzole', 'vuv' ),
            'all_items' => __( 'Sva Konzole', 'vuv' ),
            'parent_item' => __( 'Roditeljsko zvanje', 'vuv' ),
            'parent_item_colon' => __( 'Roditeljsko zvanje', 'vuv' ),
            'new_item_name' => __( 'Nova konzola', 'vuv' ),
            'add_new_item' => __( 'Dodaj konzolu', 'vuv' ),
            'edit_item' => __( 'Uredi konzolu', 'vuv' ),
            'update_item' => __( 'Ažuiriraj konzolu', 'vuv' ),
            'view_item' => __( 'Pogledaj konzolu', 'vuv' ),
            'separate_items_with_commas' => __( 'Odvojite konzole sa zarezima', 'vuv' ),
            'add_or_remove_items' => __( 'Dodaj ili ukloni konzole', 'vuv' ),
            'choose_from_most_used' => __( 'Odaberi među najčešće korištenima', 'vuv' ),
            'popular_items' => __( 'Popularne konzole', 'vuv' ),
            'search_items' => __( 'Pretraga', 'vuv' ),
            'not_found' => __( 'Nema rezultata', 'vuv' ),
            'no_terms' => __( 'Nema konzola', 'vuv' ),
            'items_list' => __( 'Lista konzola', 'vuv' ),
            'items_list_navigation' => __( 'Navigacija', 'vuv' ),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
            );
            register_taxonomy( 'konzola', array( 'igra' ), $args );
            }
            add_action( 'init', 'registriraj_taksonomiju_konzola', 0 );

    //! KONZOLA CPT
    function registriraj_konzolu_cpt() {
        $labels = array(
        'name' => _x( 'Konzole', 'Post Type General Name', 'vuv' ),
        'singular_name' => _x( 'Konzola', 'Post Type Singular Name', 'vuv' ),
        'menu_name' => __( 'Konzole', 'vuv' ),
        'name_admin_bar' => __( 'Konzole', 'vuv' ),
        'archives' => __( 'Konzole arhiva', 'vuv' ),
        'attributes' => __( 'Atributi', 'vuv' ),
        'parent_item_colon' => __( 'Roditeljski element', 'vuv' ),
        'all_items' => __( 'Sve konzole', 'vuv' ),
        'add_new_item' => __( 'Dodaj novu konzolu', 'vuv' ),
        'add_new' => __( 'Dodaj novu', 'vuv' ),
        'new_item' => __( 'Nova konzola', 'vuv' ),
        'edit_item' => __( 'Uredi konzolu', 'vuv' ),
        'update_item' => __( 'Ažuriraj konzolu', 'vuv' ),
        'view_item' => __( 'Pogledaj konzolu', 'vuv' ),
        'view_items' => __( 'Pogledaj konzole', 'vuv' ),
        'search_items' => __( 'Pretraži konzole', 'vuv' ),
        'not_found' => __( 'Nije pronađeno', 'vuv' ),
        'not_found_in_trash' => __( 'Nije pronađeno u smeću', 'vuv' ),
        'featured_image' => __( 'Glavna slika', 'vuv' ),
        'set_featured_image' => __( 'Postavi glavnu sliku', 'vuv' ),
        'remove_featured_image' => __( 'Ukloni glavnu sliku', 'vuv' ),
        'use_featured_image' => __( 'Postavi za glavnu sliku', 'vuv' ),
        'insert_into_item' => __( 'Umentni', 'vuv' ),
        'uploaded_to_this_item' => __( 'Preneseno', 'vuv' ),
        'items_list' => __( 'Lista', 'vuv' ),
        'items_list_navigation' => __( 'Navigacija među konzolama', 'vuv' ),
        'filter_items_list' => __( 'Filtriranje konzola', 'vuv' ),
        );
        $args = array(
        'label' => __( 'Konzola', 'vuv' ),
        'description' => __( 'Konzola post type', 'vuv' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-groups',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => false,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        );
        register_post_type( 'konzole', $args );
        }
        add_action( 'init', 'registriraj_konzolu_cpt', 0 );

    //! RECENZIJA CPT
    function registriraj_recenziju_cpt() {
    $labels = array(
    'name' => _x( 'Recenzije', 'Post Type General Name', 'vuv' ),
    'singular_name' => _x( 'Recenzija', 'Post Type Singular Name', 'vuv' ),
    'menu_name' => __( 'Recenzije', 'vuv' ),
    'name_admin_bar' => __( 'Recenzije', 'vuv' ),
    'archives' => __( 'Recenzije arhiva', 'vuv' ),
    'attributes' => __( 'Atributi', 'vuv' ),
    'parent_item_colon' => __( 'Roditeljski element', 'vuv' ),
    'all_items' => __( 'Sve recenzije', 'vuv' ),
    'add_new_item' => __( 'Dodaj novu recenziju', 'vuv' ),
    'add_new' => __( 'Dodaj novu', 'vuv' ),
    'new_item' => __( 'Nova recenzija', 'vuv' ),
    'edit_item' => __( 'Uredi recenziju', 'vuv' ),
    'update_item' => __( 'Ažuriraj recenziju', 'vuv' ),
    'view_item' => __( 'Pogledaj recenziju', 'vuv' ),
    'view_items' => __( 'Pogledaj recenzije', 'vuv' ),
    'search_items' => __( 'Pretraži recenzije', 'vuv' ),
    'not_found' => __( 'Nije pronađeno', 'vuv' ),
    'not_found_in_trash' => __( 'Nije pronađeno u smeću', 'vuv' ),
    'featured_image' => __( 'Glavna slika', 'vuv' ),
    'set_featured_image' => __( 'Postavi glavnu sliku', 'vuv' ),
    'remove_featured_image' => __( 'Ukloni glavnu sliku', 'vuv' ),
    'use_featured_image' => __( 'Postavi za glavnu sliku', 'vuv' ),
    'insert_into_item' => __( 'Umentni', 'vuv' ),
    'uploaded_to_this_item' => __( 'Preneseno', 'vuv' ),
    'items_list' => __( 'Lista', 'vuv' ),
    'items_list_navigation' => __( 'Navigacija među recenzijama', 'vuv' ),
    'filter_items_list' => __( 'Filtriranje recenzija', 'vuv' ),
    );
    $args = array(
    'label' => __( 'Recenzija', 'vuv' ),
    'show_in_rest' => true,
    'description' => __( 'Recenzija post type', 'vuv' ),
    'labels' => $labels,
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-groups',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => false,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
    );
    register_post_type( 'recenzija', $args );
    }
    add_action( 'init', 'registriraj_recenziju_cpt', 0 );



    function add_meta_box_podaci()
    {
    add_meta_box( 'vsmti_podaci', 'Podaci', 'html_meta_box_podaci', 'recenzija');
    }
    
    function dohvati_igre() {
        $args = array(
            'numberposts'      => 5,
		    'category'         => 0,
		    'orderby'          => 'date',
		    'order'            => 'DESC',
		    'include'          => array(),
		    'exclude'          => array(),
		    'meta_key'         => '',
		    'meta_value'       => '',
		    'post_type'        => 'igra',
		    'suppress_filters' => true,
        ); 
        $igre = get_posts($args);
        return $igre;
    
    }

    function html_meta_box_podaci()
    {
    //var_dump(get_post_meta(get_the_ID(), 'igra_select', true));
    $Igre_array = dohvati_igre();
    
    ?>
    <div class="container">
    <div class="form-group">
    <label for="select-igra">Odaberi igru: </label><br/>
    <select class = "form-control" id = "select-igra" name="igra_select">
    <?php

    foreach($Igre_array as $igra){
            
        echo  '<option value = "'.$igra->post_title.'" '.selected(get_post_meta(get_the_ID(), 'igra_select', true), $igra->post_title, false).'>'.$igra->post_title.'</option>';
      }

    ?>
    </select>
    </div><br/>
    </div>
    <?php
    }
    function spremi_podatak_recenzija($post_id)
    {
    $is_autosave = wp_is_post_autosave( $post_id );
     $is_revision = wp_is_post_revision( $post_id );
     $is_valid_igra_box = ( isset( $_POST[ 'igra_select' ] ) && wp_verify_nonce(
    	$_POST[ 'igra_select' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
     if ( $is_autosave || $is_revision || !$is_valid_igra_box) {
     return;
     }
    $igra_id = sanitize_text_field($_POST['igra_select']);
    if(!empty($_POST['igra_select']))
    {
    update_post_meta($post_id, 'igra_select', $igra_id);
    }
    else
    {
    delete_post_meta($post_id, 'igra_select');
    }
    }
    add_action( 'add_meta_boxes', 'add_meta_box_podaci' );
    add_action( 'save_post', 'spremi_podatak_recenzija' );
?>