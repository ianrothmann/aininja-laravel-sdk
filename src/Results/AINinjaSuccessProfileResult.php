<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaSuccessProfileResult extends AINinjaResult
{
    public function getCompetencies(): Collection
    {
        return collect($this->result);
    }
}
