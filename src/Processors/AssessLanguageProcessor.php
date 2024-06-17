<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaLanguageAssessmentResult;
use IanRothmann\AINinja\Results\AINinjaTranscribeURLResult;

class AssessLanguageProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/language_assessment';
    }

    protected function getResultClass(): string
    {
        return AINinjaLanguageAssessmentResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'RecognitionStatus' => 'Success',
            'DisplayText' => "Today I'm focusing on several important tasks and refining the documentation for our PHP composer package to ensure it's clear and comprehensive. I'm also working on resolving issues with Meta Business verification, reviewing necessary documents for compliance. Additionally, I'm exploring new APIs that could enhance our process is. Lastly, I manage Ng RAWS infrastructure to ensure everything runs smoothly.",
            'Confidence' => 0.9245442,
            'PronunciationAssessment' => [
                'AccuracyScore' => 94.0,
                'FluencyScore' => 89.0,
                'ProsodyScore' => 89.1,
                'CompletenessScore' => 100.0,
                'PronScore' => 90.0
            ],
            'ContentAssessment' => [
                'GrammarScore' => 44.0,
                'VocabularyScore' => 44.0,
                'TopicScore' => 72.0
            ]
        ];
    }

    public function forURL(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    public function forLanguage(string $value = 'en-US'): self
    {
        $this->setInputParameter('language', $value);

        return $this;
    }

    public function aboutTopic(string $value): self
    {
        $this->setInputParameter('topic', $value);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
            'topic' => 'required|string',
            'language' => 'sometimes|string|in:en-US',
        ];
    }

    public function get(): AINinjaLanguageAssessmentResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaLanguageAssessmentResult
    {
        return parent::stream($callback);
    }
}
