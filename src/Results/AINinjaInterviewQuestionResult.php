<?php

namespace IanRothmann\AINinja\Results;

class AINinjaInterviewQuestionResult extends AINinjaResult
{
    public function getQuestions(): ?array
    {
        return $this->result['questions'] ?? null;
    }
}
