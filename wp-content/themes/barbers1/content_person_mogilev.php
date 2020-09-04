<?php
$namemog = get_post_meta(get_the_ID(), 'personnamemogilev', true );
$positionmog = get_post_meta(get_the_ID(), 'positionheldmogilev', true );
$descriptmog = get_post_meta(get_the_ID(), 'descriptionofskillsmogilev', true ); 
?>
<div class="item-master">
    <div class="wrapper">
        <div class="photo-person">
            <img src="<?php the_field('imagemogilev'); ?>" alt="">
        </div>
        <div class="work-des">
            <div class="description">
                <h4><?=$namemog?></h4>
                <span><?=$positionmog?></span>
                <p><?=$descriptmog?></p>
            </div>
            <a href="https://n28956.yclients.com/company:84442/idx:0/master#1" target="_blank">Онлайн запись</a>
            <img src="<?php the_field('photosmallmogilev'); ?>" alt="">
        </div>
    </div>
</div>     