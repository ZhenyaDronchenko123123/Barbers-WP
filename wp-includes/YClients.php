<?php

class YClients
{
    /**
     * One day.
     */
    private const CACHE_TTl = 86400;

    /** @var string */
    private $partnerToken;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    public function __construct(string $partnerToken, string $login, string $password)
    {
        $this->partnerToken = $partnerToken;
        $this->login        = $login;
        $this->password     = $password;
    }

    public function getReviews(array $companyIds, int $amount = 10): array
    {
        $cacheKey = sprintf('reviews_companies_%s_amount_%d', implode('_', $companyIds), $amount);

        return $this->cached($cacheKey, self::CACHE_TTl, function () use ($companyIds, $amount) {
            $reviews = [];

            foreach ($companyIds as $companyId) {
                $commentsResponse = wp_remote_get("https://api.yclients.com/api/v1/comments/${companyId}/", [
                    'headers' => [
                        'Content-Type'  => 'application/json',
                        'Authorization' => "Bearer {$this->partnerToken}, User {$this->getUserToken()}",
                    ],
                ]);
                $commentsBody     = json_decode(wp_remote_retrieve_body($commentsResponse), true);

                $reviews = array_merge($reviews, $commentsBody);
            }

            /**
             * Filter reviews where words amount greater than 6.
             */
            $reviews = array_filter($reviews, static function (array $review) {
                $spacesCount = substr_count($review['text'], ' ');

                return $spacesCount > 6;
            });

            if (count($companyIds) > 1) {
                usort($reviews, static function (array $a, array $b) {
                    return strtotime($b['date']) <=> strtotime($a['date']);
                });
            }

            return array_slice($reviews, 0, $amount);
        });
    }

    private function getUserToken(): string
    {
        static $userToken;

        if (null === $userToken) {
            $userTokenResponse = wp_remote_post('https://api.yclients.com/api/v1/auth', [
                'headers'     => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => "Bearer {$this->partnerToken}",
                ],
                'body'        => json_encode([
                    'login'    => $this->login,
                    'password' => $this->password,
                ]),
                'data_format' => 'body',
            ]);
            $userTokenBody     = json_decode(wp_remote_retrieve_body($userTokenResponse), true);

            $userToken = $userTokenBody['user_token'];
        }

        return $userToken;
    }

    private function cached(string $cacheKey, int $ttl, callable $dataFunction)
    {
        $cacheFilePath = WPCACHEHOME . DIRECTORY_SEPARATOR . $cacheKey . '.json';

        if (file_exists($cacheFilePath) && (time() - filemtime($cacheFilePath)) < $ttl) {
            try {
                return json_decode(file_get_contents($cacheFilePath), true);
            } catch (Exception $exception) {
                unlink($cacheFilePath);
            }
        }

        $result = $dataFunction();

        file_put_contents($cacheFilePath, json_encode($result));

        return $result;
    }
}
