<?php

namespace IanRothmann\AINinja\Results;

class AINinjaInterviewQuestionProbingResult extends AINinjaResult
{
    public function getAnswerSufficient(): int
    {
        return $this->result['answer_sufficient'];
    }

    public function getProbingQuestion(): string
    {
        return $this->result['probing_question'];
    }
}
