<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaScoringGuideRefinementResult extends AINinjaResult
{
    /**
     * @return Collection<int, array{item_id: string, original_item: string, updated_item: string, update_reason: string, update_excerpts: string}>
     */
    public function getUpdates(): Collection
    {
        return collect($this->result['updated_items']);
    }
}
