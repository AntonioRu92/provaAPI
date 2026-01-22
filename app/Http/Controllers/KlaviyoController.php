<?php

namespace App\Http\Controllers;

use App\Services\KlaviyoClient;
use Illuminate\Http\Request;

class KlaviyoController extends Controller
{
    protected KlaviyoClient $klaviyo;

    public function __construct(KlaviyoClient $klaviyo)
    {
        $this->klaviyo = $klaviyo;
    }

    /**
     * Example endpoint to demonstrate calling Klaviyo with Http::withToken().
     * Visit /klaviyo/test to trigger.
     */
    public function sendTest(Request $request)
    {
        // Simple example payload for a "track" call — adapt to your needs.
        $payload = [
            'event' => 'Test Event',
            'properties' => [
                'sample' => 'value',
            ],
        ];

        $response = $this->klaviyo->post('track', $payload);

        return response()->json([
            'status' => $response->status(),
            'body' => $response->json(),
        ], $response->status());
    }
}
