<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentDevelopmentActionProposalsGeneratorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getSummary(): Collection
    {
        return collect(collect($this->getFinalResult())->get('summary', []));
    }

    public function getProposals(): Collection
    {
        return collect(collect($this->getFinalResult())->get('proposals', []));
    }

    public function getProposalCount(): int
    {
        return $this->getProposals()->count();
    }
}
