<section class="reviews">
    <div class="container">
        <h2>Отзывы наших клиентов</h2>
        <div class="owl-carousel owl-theme">
            <?php
            try {
                $companyIds = [
                    'vitebsk' => 30454,
                    'gomel'   => 64564,
                    'mogilev' => 84442,
                ];

                $partnerToken = 'e6k37y8bza29scdnnw9h';
                $login        = 'Dronchenko123123123@gmail.com';
                $password     = 'LebroN123321';

                $yClients = new YClients($partnerToken, $login, $password);

                $comments = $yClients->getReviews('all' === $city ? array_values($companyIds) : [$companyIds[$city]]);

                foreach ($comments as $comment) {
                    ?>
                    <div class="item">
                        <?php if (!empty($comment['user_name'])): ?>
                            <h4>
                                Клиент: <?=$comment['user_name']?>
                            </h4>
                        <?php endif;?>
                        <?php if (!empty($comment['master']['name'])): ?>
                            <h4>
                                Сотрудник: <?=$comment['master']['specialization']?> <?=$comment['master']['name']?>
                            </h4>
                        <?php endif;?>
                        <span>
                            <?=DateTime::createFromFormat('Y-m-d H:i:s', $comment['date'])->format('j M Y')?>
                        </span>
                        <p>
                            <?=$comment['text']?>
                        </p>
                    </div>
                    <?php
                }
            } catch (Exception $exception) {
                // Don't fail if reviews not loaded.
                error_log($exception->getMessage());
            }
            ?>
        </div>
    </div>
</section>
