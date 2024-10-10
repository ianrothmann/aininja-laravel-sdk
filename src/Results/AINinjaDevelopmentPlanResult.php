<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaDevelopmentPlanResult extends AINinjaResult
{
    public function getDevelopmentActions(): Collection
    {
        return collect($this->result['dev_actions']);
    }

    public function getCategories(): Collection
    {
        return collect($this->result['dev_actions'])->pluck('category_id')->unique();
    }
}
