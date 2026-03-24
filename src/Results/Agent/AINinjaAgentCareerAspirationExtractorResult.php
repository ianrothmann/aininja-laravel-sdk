<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentCareerAspirationExtractorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getAspirations(): Collection
    {
        return collect(collect($this->getFinalResult())->get('aspirations', []));
    }

    public function getProfileId(): ?string
    {
        return collect($this->getFinalResult())->get('profile_id');
    }

    public function getAssessmentDateUsed(): ?string
    {
        return collect($this->getFinalResult())->get('assessment_date_used');
    }

    public function getVersion(): ?string
    {
        return collect($this->getFinalResult())->get('career_aspiration_extraction_version');
    }
}
