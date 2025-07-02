<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaTechnicalCompetencyQuestionResult extends AINinjaResult
{
    public function getQuestions(): Collection
    {
        return collect(collect($this->result)->get('questions') ?? []);
    }

    public function getEasyQuestions(): Collection
    {
        return $this->getQuestions()->filter(fn ($question) => $question['difficulty'] === 'easy');
    }

    public function getMediumQuestions(): Collection
    {
        return $this->getQuestions()->filter(fn ($question) => $question['difficulty'] === 'medium');
    }

    public function getHardQuestions(): Collection
    {
        return $this->getQuestions()->filter(fn ($question) => $question['difficulty'] === 'hard');
    }
}
