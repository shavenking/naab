<?php

namespace App\NotionModels;

class Image implements Htmlable
{
    public string $url;

    public function toHtml(): string
    {
        return <<<HTML
<img src="{$this->url}" alt="{$this->url}">
HTML;
    }
}
