<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaScoringGuideCriteriaResult extends AINinjaResult
{
    /**
     * @return Collection<int, array{
     *     id: int,
     *     item: string,
     *     anchors: array<int, array{
     *         value: int,
     *         name: string,
     *         description: string,
     *         criteria: array<int, string>,
     *         examples: array<int, string>
     *     }>,
     *     guidelines: string
     * }>
     */
    public function getItems(): Collection
    {
        return collect($this->result['rubric']['items']);
    }
}
