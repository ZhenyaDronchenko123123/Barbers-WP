<?php get_header();?>
<?php the_post();?>
<?php the_content();?>
	<main id="primary" class="site-main">
	    <section class="second-block">
            <div class="container">
                <h2>О нас</h2>
                <div class="about-us">
                    <div class="text">
                        <p>Барберс — это мастера, любящие и преданные своей профессии, проверенные средства для волос и бороды, спокойная атмосфера.<br><br> Наш клиент — это мужчина, знающий толк в хорошей косметике, приятной компании, идеальной стрижке и имеющий вкус — это самое главное. Вкус определяет выбор. И не важно сколько он зарабатывает или во что одет — для нас он в первую очередь друг. <br><br> Мы не бар и не кофейня, но мы разбираемся в хорошем кофе и виски — все что Вам нужно спрашивайте у любого из персонала.</p>
                    </div>

                    <div class="photo">
                        <img src="<? echo get_template_directory_uri()?>/img/second.jpg" alt="Бритьё">
                    </div>
                </div>
                <div class="statistics">
                    <div class="item">
                        <h4>5</h4>
                        <span>лет на рынке</span>
                    </div>
                    <div class="item">
                        <h4>3</h4>
                        <span>филиала</span>
                    </div>
                    <div class="item">
                        <h4>22</h4>
                        <span>мастера своего дела</span>
                    </div>
                    <div class="item">
                        <h4>2500</h4>
                        <span>довольных клиентов в месяц</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="certificate-block">
            <div class="overlay"></div>
            <img src="<? echo get_template_directory_uri()?>/img/sertificate.jpg" alt="">
            <div class="sertif-content">
                <h5>Подарочные сертификаты</h5>
                <p>На любую из услуг Барберс Вы можете приобрести подарочный сертификат или абонемент - отличный подарок для любого мужчины.</p>
            </div>
        </section>
        <?php $city = 'all'; include 'content_reviewslider.php' ?>
        <section class="sign-up">
            <div class="overlay"></div>
            <img src="<? echo get_template_directory_uri()?>/img/record.jpg" alt="">
            <div class="sign-up-content">
                <h5>Записаться на стрижку</h5>
                <p>В нашем Barbers Вы легко можете записаться на стрижку к любому мастеру в удобные для Вас время и дату</p>
                <a href="https://n28956.yclients.com/group:10610">Онлайн запись</a>
            </div>
        </section>
        <section class="discover">
            <div class="container">
                <h2>Обучение в Barbers</h2>
                <div class="wrapper">
                    <div class="photo-person">
                        <img src="<? echo get_template_directory_uri()?>/img/detalis.jpg" alt="">
                    </div>
                    <div class="details">
                        <p>Выездные обучающие семинары от Барберс — прокачай свой коллектив по части мужских стрижек!
                            <br>
                            <br>
                            Только практикующие мастера с программой без лишней «воды».</p>
                        <a href="<?=get_site_url(null, 'courses')?>">Узнать подробности</a>
                    </div>
                </div>
            </div>
        </section>
        <section style="display: none">
            <div class="container">
                <div class="gallery">
                    <h2>Галерея</h2>
                </div>
                <div class="gallery-item">
                    <div class="col-1">
                        <div class="photo large">
                            <img src="<? echo get_template_directory_uri()?>/img/big-first.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="photo col-2-child"><img src="src/img/first-small-top.jpg" alt=""></div>
                        <div class="photo col-2-child"><img src="src/img/second-small-top.jpg" alt=""></div>
                    </div>
                    <div class="photo large">
                        <img src="src/img/big-first.jpg" alt="">
                    </div>
                    <div class="col-2">
                        <div class="photo col-2-child"><img src="src/img/col2-top.jpg" alt=""></div>
                        <div class="photo col-2-child"><img src="src/img/col2-bt.jpg" alt=""></div>
                    </div>
                </div>
            </div>
        </section>
		<?php
get_footer();

