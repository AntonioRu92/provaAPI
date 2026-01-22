<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KlaviyoClient
{
    protected ?string $token;
    protected string $baseUri;

    public function __construct()
    {
        $this->token = config('services.klaviyo.private_api_key') ?? env('KLAVIYO_PRIVATE_API_KEY');

        if (empty($this->token)) {
            throw new \RuntimeException('KLAVIYO_PRIVATE_API_KEY non impostata. Aggiungi KLAVIYO_PRIVATE_API_KEY al file .env o in config/services.php');
        }

        $base = config('services.klaviyo.base_uri', env('KLAVIYO_BASE_URI', 'https://a.klaviyo.com/api'));
        $this->baseUri = rtrim($base, '/');
    }

    /**
     * Make a POST request to Klaviyo using the private API key.
     * Uses Http::withToken(...) as requested.
     */
    public function post(string $path, array $data = [])
    {
        $url = $this->buildUrl($path);

        return Http::withToken($this->token)
            ->acceptJson()
            ->post($url, $data);
    }

    public function identify(array $profile): \Illuminate\Http\Client\Response
    {
        return $this->post('profiles', $profile)->throw();
    }

    public function track(array $event): \Illuminate\Http\Client\Response
    {
        return $this->post('events', $event)->throw();
    }

    protected function buildUrl(string $path): string
    {
        $path = ltrim($path, '/');
        return $this->baseUri . '/' . $path;
    }
}
