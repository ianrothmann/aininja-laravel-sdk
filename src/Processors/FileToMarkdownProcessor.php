<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaFileToMarkdownResult;

class FileToMarkdownProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/file_to_markdown';
    }

    protected function getResultClass(): string
    {
        return AINinjaFileToMarkdownResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'was_successful' => true,
            'markdown' => "# Sample Document\n\nThis is a sample markdown content converted from a file.",
            'error_message' => null,
        ];
    }

    public function forURL(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
        ];
    }

    public function get(): AINinjaFileToMarkdownResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaFileToMarkdownResult
    {
        return parent::stream($callback);
    }
}
