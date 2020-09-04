<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php bloginfo('barbers'); ?><?php wp_title('|Barbers Беларусь|Мужские парикмахерсккие'); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Barber's - сеть мужских парикмахерских Беларуси. Приходи к нам и ты получишь незабываемые ощущения от стрижки!">
	<meta name="Keywords" content="Barbers,barbers витебск,гомель, барберс,парикмахерская,парикмахерские,гомель"> 
    <meta name="robots" content="index,follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
        <section class="header">
            <div class="video">
                <video class="video__media" src="<? echo get_template_directory_uri()?>/video/video.mp4" autoplay muted loop></video>
            </div>
            <img class="img-mobile" src="<? echo get_template_directory_uri()?>/img/mobile-bg.jpg" alt="">
            <div class="wrapper">
                <div class="content">
                    <div class="top-content">
                        <div class="dropdown">
                            <button class="dropbtn">Города &nbsp;&nbsp;<svg width="20" height="10" version="1.1"
                                                                            id="Layer_1"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            x="0px" y="0px"
                                                                            viewBox="0 0 491.996 491.996"
                                                                            style="enable-background:new 0 0 491.996 491.996; font-weight: bold"
                                                                            xml:space="preserve"><g><g><path d="M484.132,124.986l-16.116-16.228c-5.072-5.068-11.82-7.86-19.032-7.86c-7.208,0-13.964,2.792-19.036,7.86l-183.84,183.848L62.056,108.554c-5.064-5.068-11.82-7.856-19.028-7.856s-13.968,2.788-19.036,7.856l-16.12,16.128c-10.496,10.488-10.496,27.572,0,38.06l219.136,219.924c5.064,5.064,11.812,8.632,19.084,8.632h0.084c7.212,0,13.96-3.572,19.024-8.632l218.932-219.328c5.072-5.064,7.856-12.016,7.864-19.224C491.996,136.902,489.204,130.046,484.132,124.986z" fill="#fff" /></g></g></svg></button>
                            <div class="dropdown-content">
                                <?php 
                                $argc = array( [
                                            'theme_location'  => '',
                                            'menu'            => '', 
                                            'container'       => false, 
                                            'container_class' => false, 
                                            'container_id'    => '',
                                            'menu_class'      => false, 
                                            'menu_id'         => '',
                                            'echo'            => true,
                                            'fallback_cb'     => 'wp_page_menu',
                                            'before'          => '',
                                            'after'           => '',
                                            'link_before'     => '',
                                            'link_after'      => '',
                                            'items_wrap'      => '<ul class="dropdown-content">%3$s</ul>',
                                            'depth'           => 0,
                                            'walker'          => '',
                                        ] );
                                wp_nav_menu( $args );?>
                            </div>
                        </div>
                        <ul>
                            <li class="number"><a href="tel:+375  (29)  510 - 50 - 10" itemprop="telephone">+375 (29) 510-50-10</a><a href="tel:+375  (29)  510 - 50 - 10" itemprop="telephone">+375 (29) 510-50-10</a></li>
                            <li><a href="">г. Гомель, ул. Кирова 22А</a></li>
                            <li><span>ПН-ВС: 10:00-21:00</span></li>
                        </ul>
                        <div class="button-item">
                            <a href="https://n28956.yclients.com/group:10610">Онлайн запись</a>
                            <div class="hamburger-menu">
                                <input id="menu__toggle" type="checkbox" />
                                <label class="menu__btn" for="menu__toggle">
                                    <span></span>
                                </label>
                                <ul class="menu__box">
                                    <li><a class="menu__item" href="<?=get_site_url(null, 'gomel')?>">Barber's Гомель</a></li>
                                    <li><a class="menu__item" href="<?=get_site_url(null, 'vitebsk')?>">Barber's Витебск</a></li>
                                    <li><a class="menu__item" href="<?=get_site_url(null, 'mogilev')?>">Barber's Могилёв</a></li>
                                    <li><a class="menu__item" href="<?=get_site_url(null, 'courses')?>">Академия Barber's</a></li>
                                    <li><a class="menu__item" href="https://www.kiviclean.by/">Чистка обуви Kivi Clean</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="logo">
                            <img src="<? echo get_template_directory_uri()?>/img/logo.png" alt="Логотип Barbers">
                        </div>
                        <div class="title">
                            <h1>Мы лучше знаем,<br>
                                что вам лучше</h1>
                            <p>Благодаря нам, люди увидят<br> тебя другим!</p>
                        </div>
                        <a href="#">Онлайн запись</a>
                    </div>
                </div>
            </div>
        </section>