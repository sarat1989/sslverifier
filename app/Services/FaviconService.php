<?php

namespace App\Services;

use simplehtmldom\HtmlWeb;

class FaviconService
{
    /**
     * Get the favicon URL of a website.
     *
     * @param string $url
     * @return string|null
     */
    public function getFaviconUrl(string $url): ?string
    {
        try {
            $htmlWeb = new HtmlWeb();
            $html = $htmlWeb->load($url);

            $faviconElement = $html->find('link[rel="icon"], link[rel="shortcut icon"], link[rel="apple-touch-icon"]', 0);

            if ($faviconElement) {
		    //return $this->getAbsoluteUrl($url, $faviconElement->getAttribute('href'));
		    return $faviconElement->getAttribute('href');
            }
        } catch (\Exception $e) {
            // Handle exception
        }

        return null;
    }

    /**
     * Convert relative URL to absolute URL.
     *
     * @param string $baseUrl
     * @param string $url
     * @return string
     */
    private function getAbsoluteUrl(string $baseUrl, string $url): string
    {
        $parsedUrl = parse_url($baseUrl);

        if (strpos($url, '//') === 0) {
            return $parsedUrl['scheme'] . ':' . $url;
        }

        if (strpos($url, '/') === 0) {
            return $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $url;
        }

        return rtrim($baseUrl, '/') . '/' . ltrim($url, '/');
    }
}

