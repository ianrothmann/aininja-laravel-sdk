<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentJobRoleCompetencyExtractorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getPositions(): Collection
    {
        return collect(collect($this->getFinalResult())->get('positions', []));
    }

    public function getPosition(int $positionId): ?Collection
    {
        return $this->getPositions()->first(function ($position) use ($positionId) {
            $pos = collect($position);

            return $pos->get('positionid') === $positionId;
        }) ? collect($this->getPositions()->first(function ($position) use ($positionId) {
            $pos = collect($position);

            return $pos->get('positionid') === $positionId;
        })) : null;
    }

    public function getPositionCompetencies(int $positionId): Collection
    {
        $position = $this->getPosition($positionId);

        return $position ? collect($position->get('competencies', [])) : collect([]);
    }

    public function getNewCompetencies(): ?Collection
    {
        $newCompetencies = collect($this->getFinalResult())->get('new_competencies');

        return $newCompetencies ? collect($newCompetencies) : null;
    }

    public function hasNewCompetencies(): bool
    {
        return $this->getNewCompetencies() !== null && $this->getNewCompetencies()->isNotEmpty();
    }

    public function getMasterCompetencyList(): Collection
    {
        return collect(collect($this->getFinalResult())->get('master_competency_list', []));
    }

    public function getCompetencyById(string $competencyId): ?Collection
    {
        $competency = $this->getMasterCompetencyList()->first(function ($comp) use ($competencyId) {
            $c = collect($comp);

            return $c->get('competency_id') === $competencyId;
        });

        return $competency ? collect($competency) : null;
    }

    public function getCompetenciesByPositionId(int $positionId): Collection
    {
        $competencyIds = $this->getPositionCompetencies($positionId);
        $competencies = collect([]);

        foreach ($competencyIds as $id) {
            $competency = $this->getCompetencyById($id);
            if ($competency) {
                $competencies->push($competency);
            }
        }

        return $competencies;
    }

    public function getTotalCompetenciesCount(): int
    {
        return $this->getMasterCompetencyList()->count();
    }

    public function getTotalNewCompetenciesCount(): int
    {
        return $this->hasNewCompetencies() ? $this->getNewCompetencies()->count() : 0;
    }

    public function getTotalPositionsCount(): int
    {
        return $this->getPositions()->count();
    }

    public function getCompetencyName(string $competencyId): ?string
    {
        $competency = $this->getCompetencyById($competencyId);

        return $competency ? $competency->get('name') : null;
    }

    public function getCompetencyDescription(string $competencyId): ?string
    {
        $competency = $this->getCompetencyById($competencyId);

        return $competency ? $competency->get('description') : null;
    }

    public function getCompetencySuccessCriteria(string $competencyId): Collection
    {
        $competency = $this->getCompetencyById($competencyId);

        return $competency ? collect($competency->get('success_criteria', [])) : collect([]);
    }

    public function getCompetencyEvidenceSpans(string $competencyId): Collection
    {
        $competency = $this->getCompetencyById($competencyId);

        return $competency ? collect($competency->get('evidence_spans', [])) : collect([]);
    }

    public function getCompetencySupportScore(string $competencyId): ?float
    {
        $competency = $this->getCompetencyById($competencyId);

        return $competency ? $competency->get('support_score') : null;
    }

    public function getCompetencyOverlapsWith(string $competencyId): Collection
    {
        $competency = $this->getCompetencyById($competencyId);

        return $competency ? collect($competency->get('overlaps_with', [])) : collect([]);
    }

    public function getCompetenciesByRole(string $roleName): Collection
    {
        return $this->getMasterCompetencyList()->filter(function ($competency) use ($roleName) {
            $comp = collect($competency);

            return $comp->get('role_name') === $roleName;
        });
    }

    public function getAllRoleNames(): Collection
    {
        return $this->getMasterCompetencyList()
            ->pluck('role_name')
            ->filter()
            ->unique()
            ->values();
    }

    public function getAverageSupportScore(): float
    {
        $scores = $this->getMasterCompetencyList()->pluck('support_score')->filter();

        return $scores->isEmpty() ? 0.0 : $scores->average();
    }

    public function getCompetenciesAboveThreshold(float $threshold): Collection
    {
        return $this->getMasterCompetencyList()->filter(function ($competency) use ($threshold) {
            $comp = collect($competency);

            return $comp->get('support_score', 0) >= $threshold;
        });
    }
}
