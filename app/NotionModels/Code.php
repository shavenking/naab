<?php

namespace App\NotionModels;

use Illuminate\Support\Collection;

class Code
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
}
