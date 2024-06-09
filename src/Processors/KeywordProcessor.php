<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaKeywordResult;

class KeywordProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/keywords';
    }

    protected function getResultClass(): string
    {
        return AINinjaKeywordResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'keywords' => [
                'keyword1',
                'keyword2',
            ],
        ];
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

    public function get(): AINinjaKeywordResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaKeywordResult
    {
        return parent::stream($callback);
    }
}
