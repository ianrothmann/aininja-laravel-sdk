<?php

namespace IanRothmann\AINinja\Results;

class AINinjaQuestionChatNavigatorResult extends AINinjaResult
{
    public function getIntent(): ?string
    {
        return $this->result['type'] ?? null;
    }

    public function getQuestion(): ?string
    {
        return $this->result['args']['question'] ?? null;
    }

    public function getQuestionNumber(): ?int
    {
        return $this->result['args']['question_number'] ?? null;
    }

    public function getComplement(): ?string
    {
        return $this->result['args']['complement'] ?? null;
    }

    public function getComment(): ?string
    {
        return $this->result['args']['comment'] ?? null;
    }

    public function getClarification(): ?string
    {
        return $this->result['args']['clarification'] ?? null;
    }
}
