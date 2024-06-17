<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaTranslateResult;

class TranslateProcessor extends AINinjaProcessor
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

    public function to(string $languageName, string $languageCode): self
    {
        $this->addToInputArray('languages', [
            'language_name' => $languageName,
            'language_code' => $languageCode,
        ]);

        return $this;
    }

    public function withParameter(string $parameter): self
    {
        $this->addToInputArray('parameters', $parameter);

        return $this;
    }

    public function withParameters(array $parameter): self
    {
        $this->setInputParameter('parameters', $parameter);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
            'languages' => 'required|array',
            'languages.*.language_name' => 'required|string',
            'languages.*.language_code' => 'required|string',
            'parameters' => 'sometimes|array',
            'parameters.*' => 'required|string',
        ];
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
