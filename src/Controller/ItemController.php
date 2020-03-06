<?php
    namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;

    class ItemController {
        public function index() {
            return new Response('<html><body>HALLO</body></html>');
        }
    }