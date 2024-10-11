<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaQueryAnswerResult;

class QueryCollectionProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/document_retrieval';
    }

    protected function getResultClass(): string
    {
        return AINinjaQueryAnswerResult::class;
    }

    protected function getMocked(): array
    {
        $json = <<<TOC
{"input": "Tell me about the rules regarding white belts.", "context": [{"id": null, "metadata": {"url": "https://kaggle-audio-files-2.s3.amazonaws.com/rule-book.pdf", "name": "rule-book", "page_number": 33, "collection_name": "ajp-rule-book-dd59bcac-371e-4b26-8402-f09a5573a8f7"}, "page_content": "The Gi should be completely white, royal blue or black. The jacket and pants must be the same color, and the collar must be the same color as the rest of the jacket.", "type": "Document"}, {"id": null, "metadata": {"url": "https://kaggle-audio-files-2.s3.amazonaws.com/rule-book.pdf", "name": "rule-book", "page_number": 5, "collection_name": "ajp-rule-book-dd59bcac-371e-4b26-8402-f09a5573a8f7"}, "page_content": "• For youth and younger divisions and white belts, the referee will stop the match and restart the match with both athletes standing. No penalties will be given to either athlete.", "type": "Document"}], "answer": "For white belts in competitions, the referee will stop and restart the match with both athletes standing if necessary. No penalties will be given to either athlete in these situations. Additionally, the Gi worn by white belts must be completely white, royal blue, or black, with the jacket and pants being the same color and the collar matching the color of the rest of the jacket."}
TOC;

        return json_decode($json, true);
    }

    public function question(string $question): self
    {
        $this->setInputParameter('question', $question);
        return $this;
    }

    public function withAnswerGuidelines(string $additional_info): self
    {
        $this->setInputParameter('additional_info', $additional_info);
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
            'question' => 'required|string',
            'additional_info' => 'sometimes|string',
            'collection_names' => 'required|array|min:1',
        ];
    }

    public function get(): AINinjaQueryAnswerResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaQueryAnswerResult
    {
        return parent::stream($callback);
    }
}
