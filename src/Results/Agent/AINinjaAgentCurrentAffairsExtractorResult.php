<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentCurrentAffairsExtractorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getGeneratedAt(): ?string
    {
        return collect($this->getFinalResult())->get('generated_at');
    }

    public function getSummary(): Collection
    {
        return collect(collect($this->getFinalResult())->get('summary', []));
    }

    public function getIssues(): Collection
    {
        return collect(collect($this->getFinalResult())->get('issues', []));
    }

    public function getChanges(): Collection
    {
        return collect(collect($this->getFinalResult())->get('changes', []));
    }

    public function getAgentContext(): Collection
    {
        return collect(collect($this->getFinalResult())->get('agent_context', []));
    }

    public function getIssueCount(): int
    {
        return $this->getIssues()->count();
    }
}
