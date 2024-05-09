<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaIdealResponseMultipleResult;

class IdealResponseMultipleProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/get_ideal_response_multiple';
    }

    protected function getResultClass(): string
    {
        return AINinjaIdealResponseMultipleResult::class;
    }

    protected function getMocked(): mixed
    {
        return [
            [
                'question' => 'Please describe your experience with machine learning frameworks and libraries. Which ones have you worked with most extensively?',
                'ideal_response' => 'The candidate has extensive experience with TensorFlow and PyTorch, having developed multiple projects that leverage deep learning to solve complex problems.',
            ],
            [
                'question' => 'Discuss a project where you were responsible for developing and deploying a machine learning model. What was your role, and what were the outcomes?',
                'ideal_response' => 'In a recent project, the candidate was tasked with developing and deploying a machine learning model to predict customer churn. They handled data preprocessing, feature engineering, model selection, and deployment, which resulted in a 15% improvement in prediction accuracy compared to the previous system.',
            ],
            [
                'question' => 'Which of the following best describes your level of proficiency with data visualization tools?',
                'ideal_response' => 'Intermediate',
            ],
        ];
    }

    public function forQuestion(string $question, string $answerFormat = 'text', ?string $options = null): self
    {
        $this->addToInputArray('questions', [
            'question' => $question,
            'answer_format' => $answerFormat,
            'options' => $options,
        ]);

        return $this;
    }

    public function givenRequirements(string $requirement): self
    {
        $this->setInputParameter('requirements', $requirement);

        return $this;
    }

    public function addExistingIdealAnswer(string $answer, string $idealResponse): self
    {
        $this->addToInputArray('existing_ideal_answers', [
            'question' => $answer,
            'ideal_response' => $idealResponse,
        ]);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.answer_format' => 'required|string',
            'questions.*.options' => 'nullable|string',
            'requirements' => 'required|string',
            'existing_ideal_answers' => 'sometimes|array',
            'existing_ideal_answers.*.question' => 'required|string',
            'existing_ideal_answers.*.ideal_response' => 'required|string',
        ];
    }

    public function get(): AINinjaIdealResponseMultipleResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaIdealResponseMultipleResult
    {
        return parent::stream($callback);
    }
}
