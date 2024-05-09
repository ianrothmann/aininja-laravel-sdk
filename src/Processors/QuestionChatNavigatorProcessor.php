<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaQuestionChatNavigatorResult;

class QuestionChatNavigatorProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/navigate_question_chat';
    }

    protected function getResultClass(): string
    {
        return AINinjaQuestionChatNavigatorResult::class;
    }

    protected function getMocked(): mixed
    {
        return [
            "type" => "BackToPreviousQuestion",
            "args" => [
                "question" => "What is your name",
                "question_number" => 1,
                "complement" => null,
                "comment" => null,
                "clarification" => null
            ]
        ];
    }

    public function withQuestion(string|int $questionNumber, string $question): self
    {
        $this->addToInputArray('questions_by_number', [
            'question_number' => (string)$questionNumber,
            'question' => $question,
        ]);

        return $this;
    }

    public function withResponse(string $response): self
    {
        $this->setInputParameter('user_response', $response);

        return $this;
    }

    public function withContext(string $context): self
    {
        $this->setInputParameter('context', $context);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'questions_by_number' => 'required|array',
            'questions.*.question_number' => 'required|string',
            'questions.*.question' => 'required|string',
            'user_response' => 'required|string',
            'context' => 'sometimes|string',
        ];
    }

    public function get(): AINinjaQuestionChatNavigatorResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaQuestionChatNavigatorResult
    {
        return parent::stream($callback);
    }
}
