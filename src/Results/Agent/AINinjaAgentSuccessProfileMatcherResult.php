<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentSuccessProfileMatcherResult extends AINinjaRunResult
{
    public function getFinalMatches(): Collection
    {
        return collect(collect($this->result)->get('final_matches', []));
    }

    public function getMatchesForPerson(string $personId): Collection
    {
        return $this->getFinalMatches()
            ->filter(fn ($match) => ($match['personid'] ?? null) === $personId)
            ->values();
    }

    public function getMatchCount(): int
    {
        return $this->getFinalMatches()->count();
    }
}
