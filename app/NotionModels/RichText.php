<?php

namespace App\NotionModels;

class RichText implements Htmlable
{
    public string $plainText;

    public function toHtml(): string
    {
        $plainText = nl2br(htmlspecialchars($this->plainText));

        return <<<HTML
<span>$plainText</span>
HTML;
    }
}
