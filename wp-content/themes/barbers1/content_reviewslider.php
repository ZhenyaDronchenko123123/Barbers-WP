<?php
$autorrev = get_post_meta(get_the_ID(), 'autorreviews', true );
$datarev = get_post_meta(get_the_ID(), 'datapublicationreviews', true );
$textrev = get_post_meta(get_the_ID(), 'textreviews', true ); 
?>          
<div class="item">
    <h4><?=$autorrev?></h4>
    <span><?=$datarev?></span>
    <p><?=$textrev?></p>
</div>