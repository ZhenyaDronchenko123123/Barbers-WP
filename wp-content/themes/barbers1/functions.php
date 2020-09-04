<?php
function barbers_scripts() {
	//main_css
	wp_enqueue_style( 'barbers-style', get_stylesheet_uri(),array(), '2');
	wp_style_add_data( 'barbers-style', 'rtl', 'replace' );
	//google_fonts
	wp_enqueue_style( 'barbers-roboto',  'https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
	wp_enqueue_style( 'barbers-robotobold',  'https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap');
	//style_own_carusel
	wp_enqueue_style( 'barbers-own-carusel',  get_template_directory_uri() .  '/libs/owncarusel2/assets/owl.carousel.min.css');
	wp_enqueue_style( 'barbers-own-carusel-def',  get_template_directory_uri() .  '/libs/owncarusel2/assets/owl.theme.default.min.css');
	//scripts_own_carusel
	wp_enqueue_script( 'barbers-own-jq', get_template_directory_uri() . '/libs/jquery/jquery-3.3.1.min.js', array());
	wp_enqueue_script( 'barbers-own-carusel-js', get_template_directory_uri() . '/libs/owncarusel2/owl.carousel.min.js', array('barbers-own-jq'));
	//mail_js
	wp_enqueue_script( 'barbers-script-main', get_template_directory_uri() . '/js/app.js');
}

add_action( 'wp_enqueue_scripts', 'barbers_scripts' );
//connecting reviews
add_action('init', 'register_post_home');
function register_post_home (){
$cptArgsHome = array(
	'labels'             => array(
		'name'               => 'Главная страница',
		'singular_name'      => 'Главная страница', 
		'add_new'            => 'Добавить страницу',
		'add_new_item'       => 'Добавить новую страницу',
		'edit_item'          => 'Редактировать страницу',
		'new_item'           => 'Новая страницу',
		'view_item'          => 'Посмотреть страницу',
		'search_items'       => 'Найти страницу',
		'not_found'          =>  'Страниц не найдено',
		'not_found_in_trash' => 'В корзине страниц не найдено',
		'parent_item_colon'  => '',
		'menu_name'          => 'Главная страница'
	  ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array('title')
	);
	register_post_type('home', $cptArgsHome );
}
add_theme_support ('post-thumbnails');
//connecting reviews
add_action('init', 'register_post_types');
function register_post_types(){
$cptArgsArray = array(
	'labels'             => array(
		'name'               => 'Отзывы',
		'singular_name'      => 'Отзыв', 
		'add_new'            => 'Добавить новый',
		'add_new_item'       => 'Добавить новый отзыв',
		'edit_item'          => 'Редактировать отзыв',
		'new_item'           => 'Новая отзыв',
		'view_item'          => 'Посмотреть отзыв',
		'search_items'       => 'Найти отзыв',
		'not_found'          =>  'Отзывов не найдено',
		'not_found_in_trash' => 'В корзине отзывов не найдено',
		'parent_item_colon'  => '',
		'menu_name'          => 'Отзывы'
	  ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array('title')
	);
	register_post_type('reviews', $cptArgsArray );
}
add_theme_support ('post-thumbnails');
//connecting slider person homel
add_action('init', 'register_post_person');
function register_post_person(){
$cptArgsPerson = array(
	'labels'             => array(
		'name'               => 'Сотрудники',
		'singular_name'      => 'Сотрудник', 
		'add_new'            => 'Добавить нового',
		'add_new_item'       => 'Добавить нового сотрудника',
		'edit_item'          => 'Редактировать сотрудника',
		'new_item'           => 'Новый сотрудник',
		'view_item'          => 'Посмотреть сотрудника',
		'search_items'       => 'Найти сотрудника',
		'not_found'          => 'Сотрудник не найден',
		'not_found_in_trash' => 'В корзине сотрудника не найдено',
		'parent_item_colon'  => '',
		'menu_name'          => 'Сотрудники Гомеля'
	  ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array('title','thumbnail')								
	);
	register_post_type('person', $cptArgsPerson );
}
add_theme_support ('post-thumbnails');
//connecting slider person mogilev
add_action('init', 'register_post_mogilev');
function register_post_mogilev(){
$cptArgsPersonModilev = array(
	'labels'             => array(
		'name'               => 'Сотрудники',
		'singular_name'      => 'Сотрудник', 
		'add_new'            => 'Добавить нового',
		'add_new_item'       => 'Добавить нового сотрудника',
		'edit_item'          => 'Редактировать сотрудника',
		'new_item'           => 'Новый сотрудник',
		'view_item'          => 'Посмотреть сотрудника',
		'search_items'       => 'Найти сотрудника',
		'not_found'          => 'Сотрудник не найден',
		'not_found_in_trash' => 'В корзине сотрудника не найдено',
		'parent_item_colon'  => '',
		'menu_name'          => 'Сотрудники Могилёва'
	  ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array('title','thumbnail')									
	);
	register_post_type('personmogilev', $cptArgsPersonModilev );
}
add_theme_support ('post-thumbnails');
//connecting slider person vitebsk
add_action('init', 'register_post_vitebsk');
function register_post_vitebsk(){
$cptArgsPersonVitebsk = array(
	'labels'             => array(
		'name'               => 'Сотрудники',
		'singular_name'      => 'Сотрудник', 
		'add_new'            => 'Добавить нового',
		'add_new_item'       => 'Добавить нового сотрудника',
		'edit_item'          => 'Редактировать сотрудника',
		'new_item'           => 'Новый сотрудник',
		'view_item'          => 'Посмотреть сотрудника',
		'search_items'       => 'Найти сотрудника',
		'not_found'          => 'Сотрудник не найден',
		'not_found_in_trash' => 'В корзине сотрудника не найдено',
		'parent_item_colon'  => '',
		'menu_name'          => 'Сотрудники Витебска'
	  ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array('title','thumbnail')									
	);
	register_post_type('personvitebsk', $cptArgsPersonVitebsk );
}
add_theme_support ('post-thumbnails');


//connecting slider teacher
add_action('init', 'register_post_teacher');
function register_post_teacher(){
$cptArgsCoursesTer = array(
	'labels'             => array(
		'name'               => 'Преподаватель',
		'singular_name'      => 'Преподаватель', 
		'add_new'            => 'Добавить преподавателя',
		'add_new_item'       => 'Добавить нового преподавателя',
		'edit_item'          => 'Редактировать преподавателя',
		'new_item'           => 'Новый преподаватель',
		'view_item'          => 'Посмотреть преподавателя',
		'search_items'       => 'Найти преподавателя',
		'not_found'          => 'Преподаватель не найден',
		'not_found_in_trash' => 'В корзине преподавателя не найдено',
		'parent_item_colon'  => '',
		'menu_name'          => 'Преподаватели'
	  ),
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => true,
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => null,
	'supports'           => array('title','thumbnail')								
	);
	register_post_type('teacher', $cptArgsCoursesTer );
}
add_theme_support ('post-thumbnails');

include ABSPATH . WPINC. '/YClients.php';


