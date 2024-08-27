<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaThemeExtractionResult extends AINinjaResult
{
    public function getSummary(): ?string
    {
        return collect($this->result)->get('overall_summary');
    }

    public function getThemes(): ?Collection
    {
        return collect(collect($this->result)->get('themes'));
    }
}
