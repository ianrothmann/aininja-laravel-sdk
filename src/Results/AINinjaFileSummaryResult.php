<?php

namespace IanRothmann\AINinja\Results;

class AINinjaFileSummaryResult extends AINinjaResult
{

    public function getSummary(): ?string
    {
        return $this->result['summary'] ?? null;
    }

    public function getComplement(): ?string
    {
        return $this->result['complement'] ?? null;
    }

}
