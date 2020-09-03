<?php
$name = get_post_meta(get_the_ID(), 'personname', true );
$position = get_post_meta(get_the_ID(), 'positionheld', true );
$descript = get_post_meta(get_the_ID(), 'descriptionofskills', true ); 
?>
<div class="item-master">
    <div class="wrapper">
        <div class="photo-person">
            <img src="<?php the_field('image'); ?>" alt="">
        </div>
        <div class="work-des">
            <div class="description">
                <h4><?=$name?></h4>
                <span><?=$position?></span>
                <p><?=$descript?></p>
            </div>
            <a href="https://n28956.yclients.com/company:64564/idx:0/master#1">Онлайн запись</a>
            <img src="<?php the_field('photosmall'); ?>" alt="">
        </div>
    </div>
</div>     
