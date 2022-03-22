<?php

namespace App\NotionModels;

interface Htmlable
{
    public function toHtml(): string;
}
