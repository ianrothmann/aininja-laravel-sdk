<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaObservationResult extends AINinjaResult
{
    public function getObservations(): Collection
    {
        return collect($this->result['observations']);
    }
}
