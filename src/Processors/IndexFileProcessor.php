<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaIndexedFileResult;
use IanRothmann\AINinja\Results\AINinjaKeywordResult;

class IndexFileProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/vectorize_file';
    }

    protected function getResultClass(): string
    {
        return AINinjaIndexedFileResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'collection_name' => '1234',
            'summary' => 'This is the summary',
            'title' => 'Title Here',
        ];
    }

    public function forUrl(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    public function nameIs(string $name): self
    {
        $this->setInputParameter('collection_name', $name);

        return $this;
    }

    public function shouldSummarize(bool $summarize): self
    {
        $this->setInputParameter('summarize', $summarize);

        return $this;
    }

    protected function transformInputForTransport(): array
    {
        if(!array_key_exists('summarize', $this->input)){
            $this->setInputParameter('summarize', false);
        }
        if(!array_key_exists('extract_title', $this->input)){
            $this->setInputParameter('extract_title', false);
        }
        return parent::transformInputForTransport();
    }

    protected function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
            'collection_name' => 'required|string',
            'summarize' => 'sometimes|bool',
            'extract_title' => 'sometimes|string',
        ];
    }

    public function get(): AINinjaIndexedFileResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaIndexedFileResult
    {
        return parent::stream($callback);
    }
}
