<?php

namespace IanRothmann\AINinja\Results;

class AINinjaQuestionChatNavigatorResult extends AINinjaResult
{
    public function getIntent(): ?string
    {
        return $this->result['type'] ?? null;
    }

    public function intentWasAnswerProvided(): bool
    {
        return $this->getIntent() === 'ProvideAnswer';
    }

    public function intentWasToGoBack(): bool
    {
        return $this->getIntent() === 'BackToPreviousQuestion';
    }

    public function intentWasThatClarificationIsRequired(): bool
    {
        return $this->getIntent() === 'ClarifyQuestion';
    }

    public function intentWasThatTheUserDoesNotKnow(): bool
    {
        return $this->getIntent() === 'DontKnowAnswer';
    }

    public function intentWasToContinueToNextQuestion(): bool
    {
        return $this->getIntent() === 'NextQuestion';
    }

    public function getQuestion(): ?string
    {
        return $this->result['args']['question'] ?? null;
    }

    public function getQuestionNumber(): ?int
    {
        return $this->result['args']['question_number'] ?? null;
    }

   /* public function getComplement(): ?string
    {
        return $this->result['args']['complement'] ?? null;
    }*/

    public function getComment(): ?string
    {
        return $this->result['args']['comment'] ?? null;
    }

    public function getClarification(): ?string
    {
        return $this->result['args']['clarification'] ?? null;
    }
}
