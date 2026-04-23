<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentAssessmentProfileUpdateResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getStatus(): ?string
    {
        return collect($this->getFinalResult())->get('status');
    }

    public function isOk(): bool
    {
        return $this->getStatus() === 'ok';
    }

    public function hasNoNewAssessment(): bool
    {
        return $this->getStatus() === 'no_new_assessment';
    }

    public function getAssessmentResolution(): Collection
    {
        return collect(collect($this->getFinalResult())->get('assessment_resolution', []));
    }

    public function getSummary(): Collection
    {
        return collect(collect($this->getFinalResult())->get('summary', []));
    }

    public function getSummaryHeadline(): ?string
    {
        return $this->getSummary()->get('headline');
    }

    public function getSummaryCounts(): Collection
    {
        return collect($this->getSummary()->get('counts', []));
    }

    public function getProfileFactualUpdates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('profile_factual_updates', []));
    }

    public function getQualificationUpdates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('qualification_updates', []));
    }

    public function getExperienceUpdates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('experience_updates', []));
    }

    public function getReplaceablePreferenceContextUpdates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('replaceable_preference_context_updates', []));
    }

    public function getStrengthUpdates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('strength_updates', []));
    }

    public function getDevelopmentAreaUpdates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('development_area_updates', []));
    }

    public function getAspirationUpdates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('aspiration_updates', []));
    }

    public function getDevelopmentActionProposalCandidates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('development_action_proposal_candidates', []));
    }

    public function getLearningContextCandidates(): Collection
    {
        return collect(collect($this->getFinalResult())->get('learning_context_candidates', []));
    }

    public function getWarnings(): Collection
    {
        return collect(collect($this->getFinalResult())->get('warnings', []));
    }

    public function hasWarnings(): bool
    {
        return $this->getWarnings()->isNotEmpty();
    }
}
