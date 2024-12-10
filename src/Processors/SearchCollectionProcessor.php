<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaSearchResult;

class SearchCollectionProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/document_search';
    }

    protected function getResultClass(): string
    {
        return AINinjaSearchResult::class;
    }

    protected function getMocked(): array
    {
        $json = <<<TOC
[]
TOC;

        return json_decode($json, true);
    }

    public function withTerm(string $term): self
    {
        $this->setInputParameter('search_term', $term);

        return $this;
    }

    public function onCollections(array $collection_refs): self
    {
        $this->setInputParameter('collection_names', $collection_refs);

        return $this;
    }

    protected function transformInputForTransport(): array
    {
        return parent::transformInputForTransport();
    }

    protected function getValidationRules(): array
    {
        return [
            'search_term' => 'required|string',
            'collection_names' => 'required|array|min:1',
        ];
    }

    public function get(): AINinjaSearchResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaSearchResult
    {
        return parent::stream($callback);
    }
}
