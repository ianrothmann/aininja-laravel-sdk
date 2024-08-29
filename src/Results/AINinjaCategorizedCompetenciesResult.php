<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaCategorizedCompetenciesResult extends AINinjaResult {

    public function getCompetenciesByCategory(): Collection
    {
        return collect(collect($this->result)->get('categories'));
    }

    public function getCategories(): Collection
    {
        return collect(collect($this->result)->get('categories'))->keys();
    }
}
