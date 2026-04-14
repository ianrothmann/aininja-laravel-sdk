<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentDevelopmentProposalMatcherResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getGoalMatches(): Collection
    {
        return collect(collect($this->getFinalResult())->get('goal_matches', []));
    }

    public function getUnmatchedGoalIds(): Collection
    {
        return collect(collect($this->getFinalResult())->get('unmatched_goal_ids', []));
    }

    public function getUnmatchedProposalIds(): Collection
    {
        return collect(collect($this->getFinalResult())->get('unmatched_action_ids', []));
    }

    public function getMatchCount(): int
    {
        return $this->getGoalMatches()->count();
    }
}
