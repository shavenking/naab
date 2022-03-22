<?php

namespace App\NotionModels;

use Illuminate\Support\Collection;

class Paragraph implements Htmlable
{
    /**
     * @var Collection<int, RichText>
     */
    public Collection $richTexts;

    public function toHtml(): string
    {
        $richTexts = $this->richTexts->map(function (RichText $richText) {
            return $richText->toHtml();
        })->join('');

        return <<<HTML
<p>$richTexts</p>
HTML;
    }

    public function plainText(): string
    {
        return $this->richTexts->implode('plainText');
    }
}
