<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentLearningDomainGeneratorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getPersonId(): ?string
    {
        return collect($this->getFinalResult())->get('person_id');
    }

    public function getGenerationSummary(): Collection
    {
        return collect(collect($this->getFinalResult())->get('generation_summary', []));
    }

    public function getLearningDomains(): Collection
    {
        return collect(collect($this->getFinalResult())->get('learning_domains', []));
    }

    public function getDomainCount(): int
    {
        return $this->getLearningDomains()->count();
    }
}
