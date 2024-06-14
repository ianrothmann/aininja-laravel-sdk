<?php

namespace IanRothmann\AINinja\Results;

class AINinjaInterviewRequirementsResult extends AINinjaResult
{
    public function getTitle(): ?string
    {
        return $this->result['title'] ?? null;
    }

    public function getSummary(): ?string
    {
        return $this->result['summary'] ?? null;
    }

    public function getRequirements(): ?string
    {
        return $this->result['requirements'] ?? null;
    }
}
