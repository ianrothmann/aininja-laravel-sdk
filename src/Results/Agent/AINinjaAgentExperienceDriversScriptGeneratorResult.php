<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentExperienceDriversScriptGeneratorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getTitle(): ?string
    {
        return collect($this->getFinalResult())->get('title');
    }

    public function getScript(): ?string
    {
        return collect($this->getFinalResult())->get('script');
    }

    public function getWordCount(): ?int
    {
        return collect($this->getFinalResult())->get('word_count');
    }

    public function getHiddenInterpretation(): Collection
    {
        return collect(collect($this->getFinalResult())->get('hidden_interpretation', []));
    }
}
