<?php

namespace IanRothmann\AINinja\Results;

class AINinjaInterviewQuestionProbingResult extends AINinjaResult
{
    public function getAnswerSufficient(): ?bool
    {
        if($this->result['answer_sufficient'] ?? null === null) {
            return null;
        }
        return (bool) $this->result['answer_sufficient'];
    }

    public function getProbingQuestion(): ?string
    {
        return $this->result['probing_question'] ?? null;
    }
}
