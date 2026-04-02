<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentLearningActionsGeneratorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getPersonId(): ?string
    {
        return collect($this->getFinalResult())->get('person_id');
    }

    public function getRunDate(): ?string
    {
        return collect($this->getFinalResult())->get('run_date');
    }

    public function getWeeklyPlanSummary(): Collection
    {
        return collect(collect($this->getFinalResult())->get('weekly_plan_summary', []));
    }

    public function getWeeklyLearningActions(): Collection
    {
        return collect(collect($this->getFinalResult())->get('weekly_learning_actions', []));
    }

    public function getActionCount(): int
    {
        return $this->getWeeklyLearningActions()->count();
    }
}
