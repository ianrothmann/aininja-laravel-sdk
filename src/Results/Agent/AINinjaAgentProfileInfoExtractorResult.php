<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentProfileInfoExtractorResult extends AINinjaRunResult
{
    protected function getFinalResult()
    {
        return collect($this->result)->get('output', []);
    }

    public function getPersonProfileExtract(): Collection
    {
        return collect(collect($this->getFinalResult())->get('person_profile_extract', []));
    }

    public function getExtractionMeta(): Collection
    {
        return collect(collect($this->getFinalResult())->get('extraction_meta', []));
    }

    public function getInstrumentInterpretations(): Collection
    {
        return collect(collect($this->getFinalResult())->get('instrument_interpretations', []));
    }

    public function getIdentity(): Collection
    {
        return collect($this->getPersonProfileExtract()->get('identity', []));
    }

    public function getDemographics(): Collection
    {
        return collect($this->getPersonProfileExtract()->get('demographics', []));
    }

    public function getCareerSnapshot(): Collection
    {
        return collect($this->getPersonProfileExtract()->get('career_snapshot', []));
    }

    public function getExperience(): Collection
    {
        return collect($this->getPersonProfileExtract()->get('experience', []));
    }

    public function getQualifications(): Collection
    {
        return collect($this->getPersonProfileExtract()->get('qualifications', []));
    }

    public function getFirstName(): ?string
    {
        return collect($this->getIdentity()->get('first_name', []))->get('value');
    }

    public function getSurname(): ?string
    {
        return collect($this->getIdentity()->get('surname', []))->get('value');
    }

    public function getFullName(): ?string
    {
        return collect($this->getIdentity()->get('full_name', []))->get('value');
    }
}
