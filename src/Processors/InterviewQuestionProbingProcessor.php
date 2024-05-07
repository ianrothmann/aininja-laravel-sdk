<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaInterviewQuestionProbingResult;

class InterviewQuestionProbingProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/interview_question_probing';
    }

    protected function getResultClass(): string
    {
        return AINinjaInterviewQuestionProbingResult::class;
    }

    protected function getMocked(): array
    {
        return [
            "answer_sufficient" => 0,
            "probing_question" => "Could you elaborate on your experience in high-end or luxury establishments, and discuss any unique cocktails you've created or any special training or certifications you've received in bartending?"
        ];
    }

    public function withQuestion(string $question): self
    {
        $this->setInputParameter('question', $question);

        return $this;
    }

    public function forAnswer(string $answer): self
    {
        $this->setInputParameter('response_text', $answer);

        return $this;
    }

    public function withResponseType(string $type): self
    {
        $this->setInputParameter('response_type', $type);

        return $this;
    }

    public function whereIdealAnswer(string $idealAnswer): self
    {
        $this->setInputParameter('ideal_answer', $idealAnswer);

        return $this;
    }

    public function withContext(string $context): self
    {
        $this->setInputParameter('context', $context);

        return $this;
    }

    public function withOtherQuestions(array $questions): self
    {
        $this->setInputParameter('other_questions', $questions);

        return $this;
    }

    public function get(): AINinjaInterviewQuestionProbingResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaInterviewQuestionProbingResult
    {
        return parent::stream($callback);
    }
}