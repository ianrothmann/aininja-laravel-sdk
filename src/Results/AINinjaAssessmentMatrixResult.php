<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaAssessmentMatrixResult extends AINinjaResult
{
    public function getMappings(): Collection
    {
        return collect($this->result);
    }
}
