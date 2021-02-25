<?php

class Redirector
{
    const NEW_URL = "https://example.com";

    public function redirect()
    {
        ob_start();
        header("Location:{$this->getNewUrl()}", true, 301);
        ob_end_flush();
        exit();
    }

    private function getNewUrl(): string
    {
        $newUrl = self::NEW_URL;
        $currentUrl = $this->getCurrentUrl();
        $parsedUrl = parse_url($currentUrl);

        $path = $parsedUrl['path'];
        $path = str_replace('index.php', '', $path);
        $path = preg_replace('/(\/+)/','/', $path);
        $path = ltrim($path, '/');

        return "$newUrl/$path";
    }

    private function getCurrentUrl(): string
    {
        return "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
}

(new Redirector())->redirect();
