<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaTranscribeURLResult;

class TranscribeURLProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/transcribe_url';
    }

    protected function getResultClass(): string
    {
        return AINinjaTranscribeURLResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'transcription' => 'Dogs are sitting by the door.',
            'srt' => [
                [
                    'text' => 'Dogs are sitting by the door.',
                    'start' => '00:00:00,000',
                    'end' => '00:00:05,000',
                ],
            ],
            'complement' => 'You have such well-behaved dogs!',
            'summary' => 'Reinhardt mentioned that dogs are sitting by the door.',
            'topics' => [
                [
                    'topic' => 'Dogs sitting by the door',
                    'start' => '00:00:00,000',
                    'end' => '00:00:05,000',
                ],
            ],
        ];
    }

    public function forURL(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    public function withSummary(bool $value = true): self
    {
        $this->setInputParameter('summary_option', $value);

        return $this;
    }

    public function withComplement(bool $value = true): self
    {
        $this->setInputParameter('complement_option', $value);

        return $this;
    }

    public function withTopic(bool $value = true): self
    {
        $this->setInputParameter('topics_option', $value);

        return $this;
    }

    public function withContext(string $context): self
    {
        $this->setInputParameter('context', $context);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
            'summary_option' => 'sometimes|boolean',
            'complement_option' => 'sometimes|boolean',
            'topics_option' => 'sometimes|boolean',
            'context' => 'sometimes|string',
        ];
    }

    public function get(): AINinjaTranscribeURLResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaTranscribeURLResult
    {
        return parent::stream($callback);
    }
}
