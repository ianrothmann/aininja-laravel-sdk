<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaEmbeddingsResult;

class EmbeddingsProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/embeddings';
    }

    protected function getResultClass(): string
    {
        return AINinjaEmbeddingsResult::class;
    }

    protected function getMocked(): array
    {
        return [
            [0.1,0.2,0.3],
            [0.1,0.2,0.3],
        ];
    }

    public function addText(string $text): self
    {
        $this->addToInputArray('texts', $text);

        return $this;
    }

    public function forTextArray(array $texts): self
    {
        $this->setInputParameter('texts', $texts);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'texts' => 'required|array',
            'texts.*' => 'required|string',
        ];
    }

    public function get(): AINinjaEmbeddingsResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaEmbeddingsResult
    {
        return parent::stream($callback);
    }
}
