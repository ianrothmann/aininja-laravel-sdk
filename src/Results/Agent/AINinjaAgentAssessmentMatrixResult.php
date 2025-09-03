<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentAssessmentMatrixResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect(collect($this->result)->get('final_results'));
    }

    public function getMappings(): Collection
    {
        return collect($this->getFinalResult());
    }

    public function getCompetencyMappings(string $competency): Collection
    {
        $mappings = collect($this->getFinalResult())->get($competency, []);

        return collect($mappings);
    }

    public function getCompetencyNames(): Collection
    {
        return collect($this->getFinalResult())->keys();
    }

    public function getCompetenciesCount(): int
    {
        return collect($this->getFinalResult())->count();
    }

    public function hasCompetency(string $competency): bool
    {
        return collect($this->getFinalResult())->has($competency);
    }

    public function getWeightsForCompetency(string $competency): Collection
    {
        return collect($this->getFinalResult()
            ->get($competency, collect()))
            ->pluck('weight');
    }

    public function getDimensionsForCompetency(string $competency): Collection
    {
        return collect($this->getFinalResult()
            ->get($competency, collect()))
            ->pluck('dimension_name');
    }

    public function getMeasuresForCompetency(string $competency): Collection
    {
        return collect($this->getFinalResult()
            ->get($competency, collect()))
            ->pluck('measure_name');
    }
}
