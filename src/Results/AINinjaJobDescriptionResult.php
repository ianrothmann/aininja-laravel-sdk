<?php

namespace IanRothmann\AINinja\Results;

class AINinjaJobDescriptionResult extends AINinjaResult
{
    public function getSummary(): ?string
    {
        return $this->result['summary'] ?? null;
    }

    public function getEducationRequirements(): ?string
    {
        return $this->result['requirements_education'] ?? null;
    }

    public function getExperienceRequirements(): ?string
    {
        return $this->result['requirements_experience'] ?? null;
    }

    public function getSkillsRequirements(): ?string
    {
        return $this->result['requirements_skills'] ?? null;
    }

    public function getOtherRequirements(): ?string
    {
        return $this->result['requirements_other'] ?? null;
    }
}
