<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentFittGrowInitialisationResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getProfileInfo(): Collection
    {
        return collect(collect($this->getFinalResult())->get('profile_info', []));
    }

    public function getProfileStrengths(): Collection
    {
        return collect(collect($this->getFinalResult())->get('profile_strengths', []));
    }

    public function getCareerAspirations(): Collection
    {
        return collect(collect($this->getFinalResult())->get('career_aspirations', []));
    }

    public function getDevelopmentAreas(): Collection
    {
        return collect(collect($this->getFinalResult())->get('development_areas', []));
    }

    public function getVideos(): Collection
    {
        return collect(collect($this->getFinalResult())->get('videos', []));
    }

    public function getVideoCount(): int
    {
        return $this->getVideos()->count();
    }
}
