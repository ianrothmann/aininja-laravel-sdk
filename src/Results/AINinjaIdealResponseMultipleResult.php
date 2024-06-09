<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaIdealResponseMultipleResult extends AINinjaResult
{
    public function getQuestions(): Collection
    {
        return collect(collect($this->result)->get('questions'));
    }
}
