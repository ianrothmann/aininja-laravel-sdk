<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentDevelopmentGoalsGeneratorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getGenerationVersion(): ?string
    {
        return collect($this->getFinalResult())->get('development_goal_generation_version');
    }

    public function getDevelopmentGoals(): Collection
    {
        return collect(collect($this->getFinalResult())->get('development_goals', []));
    }

    public function getRejectedCandidateGoals(): Collection
    {
        return collect(collect($this->getFinalResult())->get('rejected_candidate_goals', []));
    }

    public function getGoalCount(): int
    {
        return $this->getDevelopmentGoals()->count();
    }
}
