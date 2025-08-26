<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentCreateDubResult;

class CreateDubAgent extends AINinjaAgent
{
    protected function getEndpoint(): string
    {
        return '/agent_create_dub';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentCreateDubResult::class;
    }

    public function getMocked(): array
    {
        return [
            'dubbed_audio_url' => 'https://example.com/dubbed_audio.mp3',
            'dubbed_transcript' => [
                [
                    'text' => 'Hola mundo',
                    'start' => 0.0,
                    'end' => 2.5,
                ],
                [
                    'text' => 'Esta es una prueba',
                    'start' => 2.5,
                    'end' => 5.0,
                ],
            ],
            'source_transcript' => [
                [
                    'text' => 'Hello world',
                    'start' => 0.0,
                    'end' => 2.5,
                ],
                [
                    'text' => 'This is a test',
                    'start' => 2.5,
                    'end' => 5.0,
                ],
            ],
        ];
    }

    public function withAudioUrl(string $audioUrl): self
    {
        $this->setInputParameter('audio_url', $audioUrl);

        return $this;
    }

    public function withTargetLanguage(string $targetLang): self
    {
        $this->setInputParameter('target_lang', $targetLang);

        return $this;
    }

    public function withSourceLanguage(string $sourceLang): self
    {
        $this->setInputParameter('source_lang', $sourceLang);

        return $this;
    }

    public function withSourceSubtitles(?array $subtitles): self
    {
        if ($subtitles !== null) {
            $this->setInputParameter('source_subtitles', $subtitles);
        }

        return $this;
    }

    protected function transformInputForTransport(): array
    {
        return $this->input;
    }

    protected function getValidationRules(): array
    {
        return [
            'audio_url' => 'required|string|url',
            'target_lang' => 'required|string',
            'source_lang' => 'required|string',
            'source_subtitles' => 'nullable|array',
            'source_subtitles.*.text' => 'required_with:source_subtitles|string',
            'source_subtitles.*.start' => 'required_with:source_subtitles|numeric',
            'source_subtitles.*.end' => 'required_with:source_subtitles|numeric',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentCreateDubResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentCreateDubResult
    {
        return parent::retrieveRunResult($run);
    }
}
