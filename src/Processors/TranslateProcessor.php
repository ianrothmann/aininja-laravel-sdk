<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaTranslateResult;

class TranslateProcessor extends AiNinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/translate';
    }

    protected function getResultClass(): string
    {
        return AINinjaTranslateResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'translations' => [
                [
                    'code' => 'af',
                    'translation' => 'Wat is jou gunsteling fliek van :era?',
                ],
                [
                    'code' => 'es',
                    'translation' => '¿Cuál es tu película favorita de :era?',
                ],
            ],
        ];
    }

    public function text(string $text): self
    {
        $this->setInputParameter('text', $text);

        return $this;
    }

    public function to(array $language): self
    {
        $this->input['languages'][] = $language;

        return $this;
    }

    public function toLanguages(array $languages): self
    {
        $this->setInputParameter('languages', $languages);

        return $this;
    }

    public function withParameters($parameters): self
    {
        $this->setInputParameter('parameters', $parameters);

        return $this;
    }

    public function get(): AINinjaTranslateResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaTranslateResult
    {
        return parent::stream($callback);
    }
}
