<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaSpeechDetectionResult;

class DetectSpeechProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/speech_detect';
    }

    protected function getResultClass(): string
    {
        return AINinjaSpeechDetectionResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'total_speech_duration' => 374.88,
            'timestamps' => [
                ['start' => 0.544, 'end' => 8.672],
                ['start' => 10.784, 'end' => 45.024],
                ['start' => 52.768, 'end' => 140.256],
                ['start' => 148.512, 'end' => 214.496],
                ['start' => 218.656, 'end' => 259.04],
                ['start' => 278.56, 'end' => 289.248],
                ['start' => 292.384, 'end' => 343.52],
                ['start' => 350.24, 'end' => 360.416],
                ['start' => 363.04, 'end' => 429.696],
            ],
        ];
    }

    public function onUrl(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
        ];
    }

    public function get(): AINinjaSpeechDetectionResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaSpeechDetectionResult
    {
        return parent::stream($callback);
    }
}
