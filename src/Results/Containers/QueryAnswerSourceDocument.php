<?php

namespace IanRothmann\AINinja\Results\Containers;

class QueryAnswerSourceDocument
{
    protected $pageNumber;

    protected $collectionName;

    protected $content;

    public function __construct($pageNumber, $collectionName, $content)
    {
        $this->pageNumber = $pageNumber;
        $this->collectionName = $collectionName;
        $this->content = $content;
    }

    public static function fromQueryAnswer($result): self
    {
        $result = collect($result);
        $meta = collect($result->get('metadata'));

        $pageNumber = $result->get('page_number', $meta->get('page_number'));
        $content = $result->get('page_content', $result->get('content'));
        $collectionName = $meta->get('collection_name', $meta->get('collection_name'));

        return new QueryAnswerSourceDocument($pageNumber, $collectionName, $content);
    }

    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    public function getCollectionName(): ?string
    {
        return $this->collectionName;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
