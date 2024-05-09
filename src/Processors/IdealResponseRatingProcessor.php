<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaIdealResponseRatingResult;

class IdealResponseRatingProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/get_ideal_response_rating';
    }

    protected function getResultClass(): string
    {
        return AINinjaIdealResponseRatingResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'score' => 2,
            'reason' => "The candidate's response only tangentially addresses the aspects of the ideal answer by mentioning a general approach to problem-solving without delving into specifics about evaluating the model's assumptions, data quality, or feature selection. There is a lack of comprehensive coverage on iterating the model with new data, adjusting hyperparameters, or trying alternative modelling techniques. Furthermore, the response lacks clarity due to its vague nature and does not offer original thoughts or examples that align with the ideal answer. The context of applying real-world applications or examples closely aligned with the ideal answer is also missing, demonstrating a limited understanding of the context.",
        ];
    }

    public function forJobDescription(string $jobDescription): self
    {
        $this->setInputParameter('job_description', $jobDescription);

        return $this;
    }

    public function withCandidateContext(string $context): self
    {
        $this->setInputParameter('candidate_context', $context);

        return $this;
    }

    public function forQuestion(string $question): self
    {
        $this->setInputParameter('question', $question);

        return $this;
    }

    public function whereIdealAnswerIs(string $idealAnswer): self
    {
        $this->setInputParameter('ideal_answer', $idealAnswer);

        return $this;
    }

    public function whereCandidateAnswerIs(string $candidateAnswer): self
    {
        $this->setInputParameter('candidate_answer', $candidateAnswer);

        return $this;
    }

    public function withRatingRubric(array $labelsByScores): self
    {
        $this->setInputParameter('rubric', json_encode($labelsByScores));

        return $this;
    }

    public function get(): AINinjaIdealResponseRatingResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaIdealResponseRatingResult
    {
        return parent::stream($callback);
    }
}
