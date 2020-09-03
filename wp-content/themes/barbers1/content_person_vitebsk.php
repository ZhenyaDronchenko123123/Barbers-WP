<?php
$namevit = get_post_meta(get_the_ID(), 'personnamevitebsk', true );
$positionvit = get_post_meta(get_the_ID(), 'positionheldvitebsk', true );
$descriptvit = get_post_meta(get_the_ID(), 'descriptionofskillsvitebsk', true ); 
?>
<div class="item-master">
    <div class="wrapper">
        <div class="photo-person">
            <img src="<?php the_field('imagevitebsk'); ?>" alt="">
        </div>
        <div class="work-des">
            <div class="description">
                <h4><?=$namevit?></h4>
                <span><?=$positionvit?></span>
                <p><?=$descriptvit?></p>
            </div>
            <a href="https://n28956.yclients.com/company:30454/idx:0/master#1">Онлайн запись</a>
            <img src="<?php the_field('photosmallvitebsk'); ?>" alt="">
        </div>
    </div>
</div>     