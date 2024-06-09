<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaInterviewQuestionResult extends AINinjaResult
{
    public function getQuestions(): ?Collection
    {
        return collect($this->result['questions'] ?? null);
    }
}
