<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentAssessmentMatrixResult extends AINinjaRunResult
{
    public function getMappings(): Collection
    {
        return collect($this->result);
    }

    public function getCompetencyMappings(string $competency): Collection
    {
        $mappings = collect($this->result)->get($competency, []);

        return collect($mappings);
    }

    public function getCompetencyNames(): Collection
    {
        return collect($this->result)->keys();
    }

    public function getCompetenciesCount(): int
    {
        return collect($this->result)->count();
    }

    public function hasCompetency(string $competency): bool
    {
        return collect($this->result)->has($competency);
    }

    public function getWeightsForCompetency(string $competency): Collection
    {
        return collect($this->result)
            ->get($competency, [])
            ->pluck('weight');
    }

    public function getDimensionsForCompetency(string $competency): Collection
    {
        return collect($this->result)
            ->get($competency, [])
            ->pluck('dimension_name');
    }

    public function getMeasuresForCompetency(string $competency): Collection
    {
        return collect($this->result)
            ->get($competency, [])
            ->pluck('measure_name');
    }
}
