<?php
/**
 *Template Name: Шаблон витебска
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Barber's - сеть мужских парикмахерских Беларуси. Приходи к нам и ты получишь незабываемые ощущения от стрижки!">
	<meta name="Keywords" content="Barbers,barbers витебск,витебск, барберс,парикмахерская,парикмахерские витебск"> 
    <meta name="robots" content="index,follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body>
    <section class="header">
        <div class="video">
            <video class="video__media" src="<? echo get_template_directory_uri()?>/video/video.mp4" autoplay muted loop></video>
        </div>
        <img class="img-mobile" src="<? echo get_template_directory_uri()?>/img/mobile-bg.jpg" alt="">
        <div class="wrapper">
            <div class="content">
                <div class="top-content">
                    <div class="dropdown">
                        <button class="dropbtn">Витебск&nbsp;<svg width="20" height="10" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 491.996 491.996" style="enable-background:new 0 0 491.996 491.996; font-weight: bold" xml:space="preserve"><g><g><path d="M484.132,124.986l-16.116-16.228c-5.072-5.068-11.82-7.86-19.032-7.86c-7.208,0-13.964,2.792-19.036,7.86l-183.84,183.848L62.056,108.554c-5.064-5.068-11.82-7.856-19.028-7.856s-13.968,2.788-19.036,7.856l-16.12,16.128c-10.496,10.488-10.496,27.572,0,38.06l219.136,219.924c5.064,5.064,11.812,8.632,19.084,8.632h0.084c7.212,0,13.96-3.572,19.024-8.632l218.932-219.328c5.072-5.064,7.856-12.016,7.864-19.224C491.996,136.902,489.204,130.046,484.132,124.986z" fill="#fff" /></g></g></svg></button>
                        <div class="dropdown-content">
                            <?php 
                            $argc = array( [
                                'theme_location'  => '',
                                'menu'            => '', 
                                'container'       => false, 
                                'container_class' => '', 
                                'container_id'    => '',
                                'menu_class'      => '', 
                                'menu_id'         => '',
                                'echo'            => false,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '%3$s',
                                'depth'           => 0,
                                'walker'          => '',
                            ] );    
                            wp_nav_menu( $args );?>
                        </div>
                    </div>
                    <ul>
                        <li class="number"><a href="tel:+375  (29)  510 - 50 - 10" itemprop="telephone"><?php the_field('toptellvitebsk'); ?></a><a href="tel:+375  (29)  510 - 50 - 10" itemprop="telephone"><?php the_field('bttellvitebsk'); ?></a></li>
                        <li><a href=""><?php the_field('adressvitebsk'); ?></a></li>
                        <li><span>ПН-ВС: 10:00-21:00</span></li>
                    </ul>
                    <div class="button-item">
                        <a href="https://n28956.yclients.com/company:30454/idx:0/master#1" target:"_blank";>Онлайн запись</a>
                        <div class="hamburger-menu">
                            <input id="menu__toggle" type="checkbox" />
                            <label class="menu__btn" for="menu__toggle">
                                <span></span>
                            </label>
                            <ul class="menu__box">
                            
                                    <li><a class="menu__item" href="http://barbers-by.preview-domain.com/gomel/">Barber's Гомель</a></li>
                                    <li><a class="menu__item" href="http://barbers-by.preview-domain.com/vitebsk/">Barber's Витебск</a></li>
                                    <li><a class="menu__item" href="http://barbers-by.preview-domain.com/mogilev/">Barber's Могилёв</a></li>
                                    <li><a class="menu__item" href="http://barbers-by.preview-domain.com/courses/">Академия Barber's</a></li>
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
                        <h1><?php the_field('taglinevitebsk'); ?></h1>
                        <p><?php the_field('textvitebsk'); ?></p>
                    </div>
                    <a href="https://n28956.yclients.com/company:30454/idx:0/master#1" target:"_blank";>Онлайн запись</a>
                </div>
            </div>
        </div>
    </section>
	<section class="second-block">
            <div class="container">
                <h2>О нас</h2>
                <div class="about-us">
                    <div class="text">
                        <p><?php the_field('textaboutusvitebsk'); ?></p>
                    </div>
                    <div class="photo">
                        <img src="<?php the_field('photoaboutusvitebsk'); ?>" alt="Бритьё">
                    </div>
                </div>
                <div class="statistics">
                    <div class="item">
                        <h4><?php the_field('yearsvitebsk'); ?></h4>
                        <span>лет на рынке</span>
                    </div>
                    <div class="item">
                        <h4><?php the_field('branchvitebsk'); ?></h4>
                        <span>филиала</span>
                    </div>
                    <div class="item">
                        <h4><?php the_field('mastersvitebsk'); ?></h4>
                        <span>мастера своего дела</span>
                    </div>
                    <div class="item">
                        <h4><?php the_field('clientvitebsk'); ?></h4>
                        <span>довольных клиентов в месяц</span>
                    </div>
                </div>
            </div>
        </section>
       <section class="gall">
            <div class="container">
                <h2>Галерея</h2>
                <?php echo do_shortcode('[insta-gallery id="0"]'); ?>
            </div>
        </section>
        <section class="prise-section">
            <div class="container">
                <h2>Цены и услуги</h2>
                <div class="prise-cont">
                    <div class="image-block">
                        <img src="<?php the_field('photovitebsk'); ?>" alt="">
                    </div>
                    <div class="prise-block">
                        <div class="top-block">
                            <h5>
                            <?php the_field('strizvitebsk'); ?>
                            </h5>
                            <ul>
                                <li>Мужская стрижка<span><?php the_field('menpricevitebsk'); ?></span></li>
                                <li>Детская стрижка<span><?php the_field('childprisevitebsk'); ?></span></li>
                                <li>Бритье головы<span><?php the_field('shavingheadvitebsk'); ?></span></li>
                                <li>Укладка<span><?php the_field('stylingvitebsk'); ?></span></li>
                                <li>Камуфляж седины<span><?php the_field('grayhairvitebsk'); ?></span></li>
                            </ul>
                        </div>
                        <div class="bottom-block">
                            <h5>
                                Акции
                            </h5>
                            <ul>
                                <li>Стрижка + борода<span><?php the_field('haircutbeardvitebsk'); ?></span></li>
                                <li>Стрижка + гладкое бритье<span><?php the_field('haircutbeardglvitebsk'); ?></span></li>
                                <li>Отец + сын<span><?php the_field('fathersonvitebsk'); ?></span></li>
                                <li>Стрижка для студентов<span><?php the_field('studentsvitebsk'); ?></span></li>
                            </ul>
                            <p>*стоимость стрижки может отличаться от класса мастера.</p>
                        </div>
                    </div>
                    <div class="prise-block">
                        <div class="top-block">
                            <h5>
                                Борода
                            </h5>
                            <ul>
                                <li>Стрижка бороды  <span><?php the_field('beardtrimvitebsk'); ?></span></li>
                                <li>Бритьё  <span><?php the_field('shavingvitebsk'); ?></span></li>
                                <li>Камуфляж бороды  <span><?php the_field('camouflagevitebsk'); ?></span></li>
                                <li>Стрижка усов <span><?php the_field('mustachetrimvitebsk'); ?></span></li>
                            </ul>
                        </div>
                        <div class="bottom-block">
                            <h5>
                                Дополнительные услуги
                            </h5>
                            <ul>
                                <li>Коррекция воском<span><?php the_field('correctionvitebsk'); ?></span></li>
                            </ul>
                            <p>*стоимость стрижки может отличаться от класса мастера.</p>
                        </div>
                    </div>
                    <div class="image-block">
                        <img src="<?php the_field('photoprisebtvitebsk'); ?>" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
            <h2>Наши мастера</h2>
                <div class="owl-carousel owl-theme">
                <?php
                        global $post;
                        $args = array(
                            'post_type' => 'personvitebsk',
                            'publish' => true
                        );
                        $slider_vitebsk = get_posts($args);
                        foreach ($slider_vitebsk as $post){
                            include( get_template_directory() . '/content_person_vitebsk.php');
                        }
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
        <section class="certificate-block">
            <div class="overlay"></div>
            <img src="<? echo get_template_directory_uri()?>/img/sertificate.jpg" alt="">
            <div class="sertif-content">
                <h5><?php the_field('titlevitebsk'); ?></h5>
                <p><?php the_field('serdescriptvitebsk'); ?></p>
            </div>
        </section>
        <section class="reviews">
            <div class="container">
                <h2>Отзывы наших клиентов</h2>
                <div class="owl-carousel owl-theme">
                    <?php
                        global $posts;
                        $args = array(
                            'post_type' => 'reviews',
                            'publish' => true
                        );
                        $slider_review = get_posts($args);
                        foreach ($slider_review as $post){
                            include( get_template_directory() . '/content_reviewslider.php');
                        }
                        wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
        <section class="sign-up">
            <div class="overlay"></div>
            <img src="<? echo get_template_directory_uri()?>/img/record.jpg" alt="">
            <div class="sign-up-content">
                <h5><?php the_field('titleblocktitlevitebsk'); ?></h5>
                <p><?php the_field('destitvitebsk'); ?></p>
                <a href="https://n28956.yclients.com/company:30454/idx:0/master#1" target:"_blank">Онлайн запись</a>
            </div>
        </section>
        <section class="discover">
            <div class="container">
                <h2>Обучение в Barbers</h2>
                <div class="wrapper">
                    <div class="photo-person">
                        <img src="<?php the_field('barbertrainingvitebsk'); ?>" alt="">
                    </div>
                    <div class="details">
                        <p><?php the_field('learningdescriptionvitebsk'); ?></p>
                        <a href="http://barbers-by.preview-domain.com/courses/" target:"_blank">Узнать подробности</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer">
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d142.35451474049077!2d30.205085679086!3d55.18900284026772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46c573e30008ee6f%3A0x7d0a3b13ed3b1c89!2z0JHQsNGA0LHQtdGA0YjQvtC_IEJhcmJlclMgKNCR0LDRgNCx0LXRgNGBKQ!5e0!3m2!1sru!2sby!4v1596473043068!5m2!1sru!2sby" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="bg-cl">
                <img src="<? echo get_template_directory_uri()?>/img/footer.jpg" alt="">
                <div class="overlay"></div>
                <div class="block-cn">
                    <div class="contact">
                        <h5>Мужской салон «Barbers»</h5>
                        <span><?php the_field('adressvitebsk'); ?></span>
                        <a href="tel:+375298518081"><?php the_field('toptellvitebsk'); ?></a>
                        <a href="tel:+375298518081"><?php the_field('bttellvitebsk'); ?></a>
                        <span class="time-work">ПН-ВС: 10:00-21:00</span>

                        <div class="social">
                            <div>
                                <a href="https://instagram.com/barbersvtb?igshid=yzcbihbii88x" target="_blank">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.0448 0H5.95519C2.67144 0 0 2.67144 0 5.95519V16.0449C0 19.3285 2.67144 22 5.95519 22H16.0449C19.3285 22 22 19.3285 22 16.0449V5.95519C22 2.67144 19.3285 0 16.0448 0V0ZM11 17.0154C7.683 17.0154 4.98453 14.317 4.98453 11C4.98453 7.683 7.683 4.98453 11 4.98453C14.317 4.98453 17.0154 7.683 17.0154 11C17.0154 14.317 14.317 17.0154 11 17.0154ZM17.1593 6.40317C16.179 6.40317 15.3818 5.6059 15.3818 4.62568C15.3818 3.64546 16.179 2.84802 17.1593 2.84802C18.1395 2.84802 18.9369 3.64546 18.9369 4.62568C18.9369 5.6059 18.1395 6.40317 17.1593 6.40317Z" fill="white"/>
                                        <path d="M11.0001 6.27441C8.39448 6.27441 6.27441 8.39431 6.27441 11.0001C6.27441 13.6058 8.39448 15.7258 11.0001 15.7258C13.6059 15.7258 15.7258 13.6058 15.7258 11.0001C15.7258 8.39431 13.6059 6.27441 11.0001 6.27441Z" fill="white"/>
                                        <path d="M17.1596 4.1377C16.8907 4.1377 16.6719 4.35657 16.6719 4.62546C16.6719 4.89435 16.8907 5.11322 17.1596 5.11322C17.4287 5.11322 17.6476 4.89451 17.6476 4.62546C17.6476 4.3564 17.4287 4.1377 17.1596 4.1377Z" fill="white"/>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="https://vk.com/barbersvtb" target="_blank">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.5981 0H1.40498C0.628749 0 0 0.628749 0 1.40343V20.5966C0 21.3713 0.628749 22 1.40498 22H20.5966C21.3713 22 22 21.3713 22 20.5966V1.40343C22.0016 0.627196 21.3728 0 20.5981 0ZM18.2492 13.4055C18.6513 13.8154 19.5238 14.5031 19.3655 15.2033C19.2195 15.846 18.2601 15.6116 17.3286 15.6489C16.2652 15.6939 15.6349 15.7172 14.9953 15.2033C14.6941 14.9596 14.5171 14.6708 14.2284 14.3479C13.966 14.056 13.6353 13.5328 13.1851 13.553C12.3763 13.5934 12.6293 14.7205 12.3421 15.489C7.84616 16.1969 6.04065 13.4195 4.44782 10.7244C3.67624 9.41881 2.56157 6.61506 2.56157 6.61506L5.74102 6.60419C5.74102 6.60419 6.76099 8.45939 7.03112 8.93755C7.26088 9.3443 7.51394 9.66721 7.77475 10.0305C7.99365 10.3317 8.33985 10.9216 8.71865 10.8735C9.33498 10.7943 9.44676 8.4035 9.06485 7.60243C8.91271 7.27796 8.54788 7.16463 8.17063 7.05441C8.29793 6.25023 11.7366 6.08256 12.2924 6.70666C13.0997 7.6133 11.7335 10.1376 12.8389 10.8735C14.3914 10.06 15.7172 6.65387 15.7172 6.65387L19.44 6.67716C19.44 6.67716 18.8578 8.51838 18.2477 9.33498C17.8922 9.81314 16.7123 10.8781 16.7589 11.6683C16.7961 12.294 17.7556 12.9025 18.2492 13.4055Z" fill="white"/>
                                    </svg>
                                </a>
                            </div>
                            <div>
                                <a href="viber://add?number=375298518081" href="viber://chat?number=+375298518081" target="_blank">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.4825 0H5.5C2.47937 0 0 2.47937 0 5.51746V16.5C0 19.5206 2.47937 22 5.5 22H16.4825C19.5206 22 22 19.5206 22 16.4825V5.51746C22 2.47937 19.5206 0 16.4825 0ZM10.4063 4.52222C10.4413 3.98095 10.9476 4.17302 11.2095 4.1381C14.4921 4.24286 17.3206 7.19365 17.2857 10.3714C17.2857 10.6857 17.3905 11.1397 16.919 11.1397C16.4651 11.1397 16.5873 10.6683 16.5349 10.354C16.0984 6.98413 14.527 5.39524 11.1048 4.87143C10.8254 4.83651 10.3889 4.88889 10.4063 4.52222ZM15.3127 10.5111C14.7889 10.581 14.8937 10.127 14.8413 9.83016C14.4921 7.76984 13.7587 7.01905 11.646 6.56508C11.3317 6.49524 10.8429 6.54762 10.9302 6.07619C11 5.62222 11.4365 5.77937 11.7683 5.81429C13.881 6.05873 15.6095 7.85714 15.5921 9.83016C15.5571 10.0397 15.6968 10.4413 15.3127 10.5111ZM14.0032 9.42857C14.0032 9.70794 13.9683 9.96984 13.654 10.0048C13.427 10.0397 13.2873 9.84762 13.2524 9.62064C13.1651 8.78254 12.7111 8.27619 11.8381 8.13651C11.5762 8.10159 11.3317 8.01429 11.454 7.66508C11.5413 7.4381 11.7508 7.40317 11.9778 7.40317C12.9206 7.38571 14.0032 8.48571 14.0032 9.42857ZM17.3206 15.8714C16.954 16.8667 15.7143 17.8794 14.6492 17.8619C14.4921 17.827 14.1952 17.7746 13.9333 17.6698C9.25397 15.6968 5.84921 12.4492 3.92857 7.80476C3.28254 6.25079 3.96349 4.92381 5.5873 4.4C5.88413 4.29524 6.16349 4.29524 6.46032 4.4C7.15873 4.64444 8.92222 7.03651 8.95714 7.73492C8.99206 8.27619 8.60794 8.57302 8.24127 8.81746C7.5254 9.28889 7.5254 9.88254 7.83968 10.5635C8.52064 12.0651 9.69048 13.1127 11.2095 13.7762C11.7508 14.0206 12.2921 14.0032 12.6587 13.4444C13.3222 12.4492 14.1429 12.5016 15.0333 13.1127C15.4873 13.427 15.9413 13.7238 16.3603 14.0556C16.9365 14.527 17.6698 14.9111 17.3206 15.8714Z" fill="white"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="app">
                        <h5>Наше приложение:</h5>
                        <a href="https://play.google.com/store/apps/details?id=com.yclients.mobile.g10610" target="_blank"><img src="<? echo get_template_directory_uri()?>/img/google.jpg" alt=""></a>
                        <a href="https://apps.apple.com/us/app/barbers-%D1%81%D1%82%D1%80%D0%B8%D0%B6%D0%BA%D0%B8-%D0%B8-%D0%B1%D1%80%D0%B8%D1%82%D1%8C%D1%91/id1351063163?l=ru&ls=1" target="_blank"><img src="<? echo get_template_directory_uri()?>/img/app.jpg" alt=""></a>
                        <a class="online" href="https://n28956.yclients.com/company:30454/idx:0/master#1" target:"_blank">Онлайн запись</a>
                    </div>
                </div>
            </div>
        </section>
        <?php wp_footer(); ?>
    </body>
</html>