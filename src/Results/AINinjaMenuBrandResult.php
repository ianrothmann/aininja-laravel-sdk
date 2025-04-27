<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaMenuBrandResult extends AINinjaResult
{
    public function getTotalBrandCount(): int
    {
        return collect($this->result)->get('total_brands_found') ?? 0;
    }

    public function getTotalTrackedBrandSum(): int
    {
        return collect($this->result)->get('total_tracked_brands_found') ?? 0;
    }

    public function getOverallRepresentation(): float
    {
        return collect($this->result)->get('overall_representation') ?? 0.0;
    }

    public function getTrackedBrandCounts(): Collection
    {
        return collect(collect($this->result)->get('tracked_brands_found'));
    }

    public function getAllBrandsFound(): Collection
    {
        return collect(collect($this->result)->get('all_brands_found'));
    }

    public function hasErrors(): bool
    {
        return collect($this->result)->has('errors') && count($this->result['errors']) > 0;
    }

    public function getErrors(): Collection
    {
        return collect(collect($this->result)->get('errors'));
    }
}
