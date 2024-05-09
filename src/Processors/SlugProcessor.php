<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaSlugResult;

class SlugProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/generate_slug';
    }

    protected function getResultClass(): string
    {
        return AINinjaSlugResult::class;
    }

    protected function getMocked(): string
    {
        return 'cocktail-barman-joe';
    }

    public function basedOn(string $text): self
    {
        $this->setInputParameter('text', $text);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
        ];
    }

    public function get(): AINinjaSlugResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaSlugResult
    {
        return parent::stream();
    }
}
