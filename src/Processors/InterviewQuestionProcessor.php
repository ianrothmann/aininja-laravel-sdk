<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaInterviewQuestionResult;

class InterviewQuestionProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/get_interview_question';
    }

    protected function getResultClass(): string
    {
        return AINinjaInterviewQuestionResult::class;
    }

    protected function getMocked(): mixed
    {
        return [
            'questions' => [
                [
                    "question" => "What motivated you to apply for the Data Scientist position with us?",
                    "answer_format" => "text",
                    "options" => null
                ],
                [
                    "question" => "Please describe a project where you implemented an end-to-end cloud-based ML production pipeline. What challenges did you face, and how did you overcome them?",
                    "answer_format" => "text",
                    "options" => null
                ],
                [
                    "question" => "Explain a complex machine learning concept in simple terms.",
                    "answer_format" => "audio",
                    "options" => null
                ],
                [
                    "question" => "How do you ensure data quality before processing it for model development?",
                    "answer_format" => "text",
                    "options" => null
                ],
                [
                    "question" => "Discuss your experience with data architecture. How have you contributed to the development of databases and analytics strategies in your past roles?",
                    "answer_format" => "audio",
                    "options" => null
                ],
                [
                    "question" => "Provide an example of a predictive model you developed and its impact on business outcomes. How did you measure its success?",
                    "answer_format" => "text",
                    "options" => null
                ],
                [
                    "question" => "Describe your proficiency with statistical analysis, quantitative analytics, and optimization algorithms. Include examples of tools and methods you've used.",
                    "answer_format" => "audio",
                    "options" => null
                ],
                [
                    "question" => "Which ML frameworks and libraries are you most familiar with, and how have you applied them in your projects?",
                    "answer_format" => "text",
                    "options" => null
                ],
                [
                    "question" => "How do you stay updated with the latest in machine learning and AI?",
                    "answer_format" => "audio",
                    "options" => null
                ],
                [
                    "question" => "Explain how you approach large dataset manipulation and the tools you prefer for such tasks.",
                    "answer_format" => "text",
                    "options" => null
                ],
                [
                    "question" => "Please record a short video explaining the process you follow for model development, from data acquisition to deployment.",
                    "answer_format" => "video",
                    "options" => null
                ],
                [
                    "question" => "Share an experience where you had to collaborate with cross-functional teams to deploy a model. How did you ensure the smooth integration and monitoring of the model's performance?",
                    "answer_format" => "audio",
                    "options" => null
                ],
                [
                    "question" => "How do you optimize model performance post-deployment, and what metrics do you prioritize for evaluation?",
                    "answer_format" => "text",
                    "options" => null
                ],
                [
                    "question" => "Describe your experience in using data visualization tools. Can you mention specific tools you’ve used and how they facilitated your data analysis?",
                    "answer_format" => "text",
                    "options" => null
                ],
                [
                    "question" => "Discuss a time when you used ML and AI to drive significant business results. What was the project, and what results were achieved?",
                    "answer_format" => "audio",
                    "options" => null
                ]
            ]
        ];
    }

    public function basedOn(string $text): self
    {
        $this->setInputParameter('text', $text);

        return $this;
    }

    public function get(): AINinjaInterviewQuestionResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaInterviewQuestionResult
    {
        return parent::stream($callback);
    }
}
