<?php
    namespace App\Services;
    use Illuminate\Support\Facades\Http;

    class PaystackService
    {
        protected string $secretKey;
        protected string $baseUrl = 'https://api.paystack.co';

        public  function __construct() 
        {
            $this->secretKey = config('services.paystack.secret_key');
        }

        protected function client()
        {
             return Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Cache-Control' => 'no-cache',
            ])
            ->acceptJson()
            ->baseUrl($this->baseUrl);
        }

        public function initializeTransaction(array $data)
        {
            return $this->client()->post('/transaction/initialize', $data)->json();
        }

        public function verifyTransaction(string $reference)
        {
            return $this->client()->get("/transaction/verify/{$reference}")->json();
        }
    }
    
?>