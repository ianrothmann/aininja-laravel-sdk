<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaKeywordResult extends AINinjaResult
{
    public function getKeywords(): Collection
    {
        return collect(collect($this->result)->get('keywords') ?? []);
    }
}
