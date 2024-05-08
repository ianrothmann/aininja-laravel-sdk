<?php

namespace IanRothmann\AINinja\Results;

class AINinjaCandidateStrengthShortcomingResult extends AINinjaResult
{
    public function getStrengths(): ?string
    {
        return $this->result['strengths'] ?? null;
    }

    public function getShortcomings(): ?string
    {
        return $this->result['shortcomings'] ?? null;
    }
}
