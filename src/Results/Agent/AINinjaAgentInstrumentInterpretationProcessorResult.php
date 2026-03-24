<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentInstrumentInterpretationProcessorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getInterpretations(): Collection
    {
        return collect(collect($this->getFinalResult())->get('interpretations', []));
    }

    public function getInterpretationByKey(string $key): ?Collection
    {
        $interpretation = $this->getInterpretations()
            ->first(fn ($item) => ($item['instrument_key'] ?? null) === $key);

        return $interpretation ? collect($interpretation) : null;
    }

    public function getInterpretationCount(): int
    {
        return $this->getInterpretations()->count();
    }
}
