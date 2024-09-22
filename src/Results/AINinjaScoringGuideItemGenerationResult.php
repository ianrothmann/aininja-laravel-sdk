<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaScoringGuideItemGenerationResult extends AINinjaResult {

    public function getItems(): Collection
    {
        return collect($this->result['items']);
    }

}
