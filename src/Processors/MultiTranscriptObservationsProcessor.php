<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaNameSplitResult;
use IanRothmann\AINinja\Results\AINinjaObservationResult;

class MultiTranscriptObservationsProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/multi_transcript';
    }

    protected function getResultClass(): string
    {
        return AINinjaObservationResult::class;
    }

    public function addTranscript($text): self
    {
        $this->addToInputArray('transcripts', $text);

        return $this;
    }

    public function withContext($context): self
    {
        if(is_array($context)){
            $context = json_encode($context);
        }

        $this->setInputParameter('context', $context);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'transcripts' => 'required|array',
            'context' => 'required|string',
        ];
    }

    public function get(): AINinjaObservationResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaObservationResult
    {
        return parent::stream($callback);
    }

    protected function getMocked()
    {
        return [
            'observations' => [
                'Dogs are sitting by the door.',
                'The cat is on the mat.',
            ],
        ];
    }
}
