<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Results\AINinjaSummarizeTextResult;

class SummarizeTextProcessor extends AINinjaProcessor
{
    protected function getEndpoint(): string
    {
        return '/summarize';
    }

    protected function getResultClass(): string
    {
        return AINinjaSummarizeTextResult::class;
    }

    protected function getMocked(): string
    {
        return "I wanted to walk ten more steps to finish, but my legs were too tired and wouldn't move, even though I really tried. It looks like I can't do it.";
    }

    public function basedOn(string $text): self
    {
        $this->setInputParameter('text', $text);

        return $this;
    }

    public function forTargetGradeLevel(int $gradeLevel): self
    {
        $this->setInputParameter('target_grade_level', $gradeLevel);

        return $this;
    }

    public function inFirstPerson(bool $value): self
    {
        $this->setInputParameter('first_person', $value);

        return $this;
    }

    public function withWordLimit(int $limit): self
    {
        $this->setInputParameter('word_limit', $limit);

        return $this;
    }

    public function get(): AINinjaSummarizeTextResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaSummarizeTextResult
    {
        return parent::stream($callback);
    }
}
