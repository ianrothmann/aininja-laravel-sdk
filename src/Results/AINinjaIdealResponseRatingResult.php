<?php

namespace IanRothmann\AINinja\Results;

class AINinjaIdealResponseRatingResult extends AINinjaResult
{
    public function getScore(): ?int
    {
        return $this->result['score'] ?? null;
    }

    public function getReason(): ?string
    {
        return $this->result['reason'] ?? null;
    }
}
