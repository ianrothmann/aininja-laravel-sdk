<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaTagResult extends AINinjaResult
{
    public function getCategories(): Collection
    {
        return collect($this->result['output']);
    }

    public function getTagsForCategory($categoryId): Collection
    {
        return collect($this->getCategories()->firstWhere('category_id', $categoryId)['tag_ids'] ?? []);
    }
}
