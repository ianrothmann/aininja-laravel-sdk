<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaMergedListResult extends AINinjaResult
{
    public function getResult(): Collection
    {
        return collect($this->result);
    }
}
