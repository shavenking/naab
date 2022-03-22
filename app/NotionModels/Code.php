<?php

namespace App\NotionModels;

use Illuminate\Support\Collection;

class Code implements Htmlable
{
    public string $language;

    /**
     * @var Collection<int, RichText>
     */
    public Collection $richTexts;

    public function plainText(): string
    {
        return $this->richTexts->implode('plainText');
    }

    public function toHtml(): string
    {
        return <<<HTML
<pre>
    <code class="language-{$this->language}">{$this->plainText()}</code>
</pre>
HTML;
    }
}
