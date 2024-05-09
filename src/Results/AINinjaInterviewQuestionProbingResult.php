<?php

namespace IanRothmann\AINinja\Results;

class AINinjaInterviewQuestionProbingResult extends AINinjaResult
{
    public function getAnswerSufficient(): ?bool
    {
        return (bool)$this->result['answer_sufficient'] ?? null;
    }

    public function getProbingQuestion(): ?string
    {
        return $this->result['probing_question'] ?? null;
    }
}
