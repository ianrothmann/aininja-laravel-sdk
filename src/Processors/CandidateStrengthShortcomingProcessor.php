<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsAsHtml;
use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaCandidateStrengthShortcomingResult;

class CandidateStrengthShortcomingProcessor extends AINinjaProcessor
{
    use OutputsAsHtml;
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/candidate_strengths_shortcomings';
    }

    protected function getResultClass(): string
    {
        return AINinjaCandidateStrengthShortcomingResult::class;
    }

    protected function getMocked(): mixed
    {
        return [
            'strengths' => "Ian Rothmann's strengths are evident in his ability to clearly and concisely introduce himself and highlight his relevant experience and achievements, which earned him an exemplary score in the video introduction question. His response was direct, addressing all aspects of the ideal answer, such as his current role, experience, and a brief example of how he applied his skills to solve a significant business problem. This showcases Ian's strong communication skills and his ability to articulate his thoughts in a clear and structured manner. Furthermore, Ian demonstrates satisfactory problem-solving skills by outlining a general approach to addressing issues when predictive models do not deliver the expected outcomes, indicating his proficiency in data manipulation and model adjustment.",
            'shortcomings' => "Despite his strengths, Ian Rothmann's application reveals significant shortcomings, particularly in his inability to provide detailed examples of using machine learning and AI to drive business results, which resulted in a low score for that question. This indicates a gap in demonstrating applied knowledge and the impact of his work, which are crucial for the Data Scientist role. Additionally, while he acknowledges the importance of communication when models fail to deliver, his response lacked depth and failed to elaborate on specific steps for diagnosing model issues or how he would engage with stakeholders during such challenges. This suggests a need for improvement in detailing methodologies and stakeholder management strategies.",
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

    public function withRatingRubric(array $labelsByScores): self
    {
        $this->setInputParameter('rubric', json_encode($labelsByScores));

        return $this;
    }

    public function addRating($question, $score, $reason): self
    {
        $this->addToInputArray('rating_table', [
            'question' => $question,
            'score' => $score,
            'reason' => strip_tags($reason),
        ]);

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'job_description' => 'required|string',
            'candidate_context' => 'required|string',
            'rubric' => 'sometimes|string',
            'rating_table' => 'required|array',
            'rating_table.*.question' => 'required|string',
            'rating_table.*.score' => 'required|numeric',
            'rating_table.*.reason' => 'required|string',
        ];
    }

    protected function transformInputForTransport(): array
    {
        $input = parent::transformInputForTransport();
        $input['rating_table'] = json_encode($input['rating_table']);

        return $input;
    }

    public function get(): AINinjaCandidateStrengthShortcomingResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaCandidateStrengthShortcomingResult
    {
        return parent::stream($callback);
    }
}
