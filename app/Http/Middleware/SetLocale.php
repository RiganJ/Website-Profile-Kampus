<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    protected array $wordReplacements = [];

    protected array $phraseReplacements = [];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', 'id');

        if (! in_array($locale, ['id', 'en'], true)) {
            $locale = 'id';
        }

        App::setLocale($locale);
        App::setFallbackLocale('id');

        $response = $next($request);

        if ($locale === 'en' && $this->isHtmlResponse($response)) {
            $content = $response->getContent();
            $content = $this->translateHtml($content);
            $response->setContent($content);
        }

        return $response;
    }

    protected function isHtmlResponse(Response $response): bool
    {
        return $response->headers->has('content-type')
            && Str::contains($response->headers->get('content-type'), 'text/html');
    }

    protected function translateHtml(string $html): string
    {
        $replacements = trans('content.replacements');

        if (! is_array($replacements) || $replacements === []) {
            return $html;
        }

        uksort($replacements, fn (string $a, string $b): int => strlen($b) <=> strlen($a));
        $this->prepareReplacements($replacements);

        $html = str_replace('<html lang="id">', '<html lang="en">', $html);
        $html = str_replace("<html lang='id'>", "<html lang='en'>", $html);

        $html = $this->translateTextNodes($html, $replacements);

        return $html;
    }

    protected function prepareReplacements(array $replacements): void
    {
        $this->wordReplacements = [];
        $this->phraseReplacements = [];
        foreach ($replacements as $source => $target) {
            if (! is_string($source) || $source === '' || ! is_string($target)) {
                continue;
            }

            if (! str_contains($source, ' ') && preg_match('/^[\pL\pN-]+$/u', $source)) {
                $this->wordReplacements[$source] = $target;
                continue;
            }

            $this->phraseReplacements[$source] = $target;
        }

        if ($this->wordReplacements !== []) {
            uksort($this->wordReplacements, fn (string $a, string $b): int => strlen($b) <=> strlen($a));
        }
    }

    protected function translateTextNodes(string $html, array $replacements): string
    {
        $protectedBlocks = [];
        $html = preg_replace_callback('/<(script|style)\b[^>]*>.*?<\/\1>/is', function (array $match) use (&$protectedBlocks): string {
            $key = '___FDK_PROTECTED_BLOCK_'.count($protectedBlocks).'___';
            $protectedBlocks[$key] = $match[0];

            return $key;
        }, $html);

        $parts = preg_split('/(<[^>]+>)/', $html, -1, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($parts as $index => $part) {
            if ($part === '' || str_starts_with($part, '<')) {
                continue;
            }

            $parts[$index] = $this->translateTextSegment($part, $replacements);
        }

        $html = implode('', $parts);

        foreach ($protectedBlocks as $key => $block) {
            $html = str_replace($key, $block, $html);
        }

        return $html;
    }

    protected function translateTextSegment(string $text, array $replacements): string
    {
        if (trim($text) !== '') {
            preg_match('/^\s*/', $text, $leading);
            preg_match('/\s*$/', $text, $trailing);

            $text = ($leading[0] ?? '')
                .preg_replace('/\s+/u', ' ', trim($text))
                .($trailing[0] ?? '');
        }

        if ($this->phraseReplacements !== []) {
            $text = strtr($text, $this->phraseReplacements);
        }

        if ($this->wordReplacements !== []) {
            $text = preg_replace_callback('/[\pL\pN-]+/u', function (array $match): string {
                return $this->wordReplacements[$match[0]] ?? $match[0];
            }, $text);
        }

        return $text;
    }
}
