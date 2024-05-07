<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaSummarizeContextResult;

class SummarizeContextProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/summarize_context';
    }

    protected function getResultClass(): string
    {
        return AINinjaSummarizeContextResult::class;
    }

    protected function getMocked(): mixed
    {
        return "The JSON provided contains information about an individual named Ian Rothmann, who is of South African nationality.";
    }

    public function withContext($context): self
    {
        if (is_array($context)) {
            $context = json_encode($context);
        }

        $this->setInputParameter('context', $context);

        return $this;
    }

    public function get(): AINinjaSummarizeContextResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaSummarizeContextResult
    {
        return parent::stream($callback);
    }
}
