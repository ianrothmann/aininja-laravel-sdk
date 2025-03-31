<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use IanRothmann\AINinja\Processors\AINinjaProcessor;
use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentFeedbackVideoResult;
use IanRothmann\AINinja\Results\AINinjaTLDRResult;

class GenerateFeedbackVideoAgent extends AINinjaAgent
{
    //use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/agent_video_feedback';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentFeedbackVideoResult::class;
    }

    public function getMocked(): array
    {
        return [
            'feedback' => 'This is a feedback',
            'script' => 'This is a script',
            'video_url' => 'https://www.w3schools.com/html/mov_bbb.mp4'
        ];
    }

    public function withPersonContext(string $context): self
    {
        $this->setInputParameter('context', strip_tags($context));

        return $this;
    }

    public function addAdditionalContext(string $context): self
    {
        $this->addToInputArray('additional', strip_tags($context));

        return $this;
    }

    public function additionalContextDescribedBy(string $context): self
    {
        $this->setInputParameter('additional_context_description', strip_tags($context));

        return $this;
    }

    public function addExtraContentDescription(string $content): self
    {
        $this->addToInputArray('extra_descriptions', strip_tags($content));

        return $this;
    }

    public function onPrimaryContent(string $content): self
    {
        $this->setInputParameter('primary', strip_tags($content));

        return $this;
    }

    public function primaryContentDescribedBy(string $context): self
    {
        $this->setInputParameter('primary_description', strip_tags($context));

        return $this;
    }


    public function withTaskIntroContent(string $content): self
    {
        $this->setInputParameter('intro_description', strip_tags($content));

        return $this;
    }

    public function addTaskInstruction(string $instruction): self
    {
        $this->addToInputArray('task', strip_tags($instruction));

        return $this;
    }

    public function videoTypeIsShort($type='style_1'): self
    {
        $this->setInputParameter('video_type', 'short');
        $this->setInputParameter('video_style', $type);

        return $this;
    }

    public function videoTypeIsAvatar($avatarStyleNumber=1): self
    {
        $this->setInputParameter('video_type', 'avatar');
        $this->setInputParameter('video_avatar', 'avatar_'.$avatarStyleNumber);

        return $this;
    }

    protected function transformInputForTransport(): array
    {
        $input = $this->input;

        $input['task'] = collect($input['task'])
            ->map(function ($instruction) {
                return '- ' . $instruction;
            })->implode("\n");

        if(!($input['additional'] ?? null)){
            $input['additional'] = [];
        }

        if(!$input['additional_context_description']){
            $input['additional_context_description'] = 'None Provided';
        }

        if(!($input['extra_descriptions'] ?? null)){
            $input['extra_descriptions'] = [];
        }

        if(!($this->input['video_type'] ?? null)){
            $input['video_type'] = 'short';
            $input['video_style'] = 'style_1';
        }

        return $input;
    }


    protected function getValidationRules(): array
    {
        return [
            'intro_description' => 'required|string',
            'primary' => 'required|string',
            'context' => 'required|string',
            'additional' => 'nullable|array',
            'additional.*' => 'sometimes|string',
            'task' => 'required|array',
            'task.*' => 'required|string',
            'primary_description' => 'required|string',
            'additional_context_description' => 'sometimes|string',
            'extra_descriptions' => 'nullable|array',
            'extra_descriptions.*' => 'sometimes|string',
            'video_type' => 'required|string',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentFeedbackVideoResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentFeedbackVideoResult
    {
        return parent::retrieveRunResult($run);
    }

}
