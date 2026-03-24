<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentPersonalityScriptGeneratorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        // Output fields are top-level in OutputState (not wrapped under 'output')
        return collect($this->result);
    }

    public function getExtraversionScript(): Collection
    {
        return collect($this->getFinalResult()->get('extraversion_script', []));
    }

    public function getOpennessScript(): Collection
    {
        return collect($this->getFinalResult()->get('openness_script', []));
    }

    public function getAgreeablenessScript(): Collection
    {
        return collect($this->getFinalResult()->get('agreeableness_script', []));
    }

    public function getConscientiousnessScript(): Collection
    {
        return collect($this->getFinalResult()->get('conscientiousness_script', []));
    }

    public function getScriptTitle(string $dimension): ?string
    {
        return $this->getScript($dimension)->get('title');
    }

    public function getScriptText(string $dimension): ?string
    {
        return $this->getScript($dimension)->get('script');
    }

    protected function getScript(string $dimension): Collection
    {
        return match ($dimension) {
            'extraversion' => $this->getExtraversionScript(),
            'openness' => $this->getOpennessScript(),
            'agreeableness' => $this->getAgreeablenessScript(),
            'conscientiousness' => $this->getConscientiousnessScript(),
            default => collect([]),
        };
    }
}
