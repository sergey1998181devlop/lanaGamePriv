<?php

declare(strict_types=1);

namespace App\Http\Middleware;

class TruncateEmptyStringInHtml
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     */
    public function handle($request, \Closure $next)
    {
        /**
         * @var \Illuminate\Http\Response $response
         */
        $response = $next($request);
        $contentType = $response->headers->get('Content-Type');
        $content = $response->getContent();

        if ($content && $contentType && \mb_stripos($contentType, 'text/html') === 0) {
            $response->setContent($this->truncateEmptySymbols($content));
        }

        return $response;
    }

    /**
     * Remove insignificant empty symbols from html
     *
     * @param string $html
     *
     * @return string
     */
    private function truncateEmptySymbols(string $html): string
    {
        $html = \preg_replace('#\s\s+#', ' ', $html);
        $html = \preg_replace('#([\'"])\s*>\s+#', '$1>', $html);
        $html = \preg_replace('#>\s+<#', '><', $html);
        $html = \preg_replace('#(\S)\s+<#', '$1 <', $html);
        $html = \preg_replace('#>\s+(\S)<#', '> $1', $html);

        return $html;
    }
}
