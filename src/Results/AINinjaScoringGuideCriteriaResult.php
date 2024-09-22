<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaScoringGuideCriteriaResult extends AINinjaResult {

    /**
     * @return Collection<int, array{title: string, value: int, description: string, prerequisites?: array<int, array{question: string, definitions: string}>}>
     */
    public function getAnchors(): Collection
    {
        return collect($this->result['rubric']['anchors']);
    }
}
