<?php

namespace IanRothmann\AINinja\Results;

class AINinjaFileToMarkdownResult extends AINinjaResult
{
    public function wasSuccessful(): bool
    {
        return collect($this->result)->get('was_successful', false);
    }

    public function getMarkdown(): ?string
    {
        return $this->result['markdown'] ?? null;
    }

    public function getErrorMessage(): ?string
    {
        return $this->result['error_message'] ?? null;
    }
}