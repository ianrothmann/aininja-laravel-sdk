<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaCompetencyMappingResult extends AINinjaResult
{
    public function getMappings(): Collection
    {
        return collect($this->result);
    }
}
