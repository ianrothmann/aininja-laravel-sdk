<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentDevelopmentAreasExtractorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getDevelopmentAreas(): Collection
    {
        return collect(collect($this->getFinalResult())->get('development_areas', []));
    }

    public function getRejectedThemes(): Collection
    {
        return collect(collect($this->getFinalResult())->get('rejected_candidate_themes', []));
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
        return collect($this->getFinalResult())->get('development_area_extraction_version');
    }
}
