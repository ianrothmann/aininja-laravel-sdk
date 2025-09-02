<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentProfilePictureResult;

class ProfilePictureAgent extends AINinjaAgent
{
    protected function getEndpoint(): string
    {
        return '/agent_profile_picture_processor';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentProfilePictureResult::class;
    }

    public function getMocked(): array
    {
        return [
            'image_url' => 'https://example.com/generated-profile-picture.jpg',
        ];
    }

    public function imageUrl(string $imageUrl): self
    {
        $this->setInputParameter('image_url', $imageUrl);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'image_url' => 'required|url',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentProfilePictureResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentProfilePictureResult
    {
        return parent::retrieveRunResult($run);
    }
}
