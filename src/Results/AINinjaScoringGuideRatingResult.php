<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaScoringGuideRatingResult extends AINinjaResult {

    /**
     * @return Collection<string, Collection<int, array{
     *     id: string,
     *     rating: int,
     *     reason: string,
     *     questions: array<int, array{
     *         question: string,
     *         answer: string,
     *         reason: string
     *     }>
     * }>>
     */
    public function getResultsById(): Collection
    {
        return collect($this->result)
            ->keyBy('id');
    }
}
