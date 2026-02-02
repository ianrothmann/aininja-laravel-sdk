<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentIdpCreatorResult;

class IdpCreatorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/idp_creator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentIdpCreatorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'dev_actions' => [
                    [
                        'title' => 'Hans Rosling – The Best Stats You have Ever Seen',
                        'category_id' => 'watch',
                        'url' => 'https://www.ted.com/talks/hans_rosling_shows_the_best_stats_you_ve_ever_seen',
                        'keywords' => [
                            'data visualization',
                            'global health',
                            'statistics',
                            'Gapminder',
                            'forecasting',
                        ],
                        'description' => 'Hans Rosling uses animated data visuals to debunk myths about global development and illustrate how data can drive clearer understanding and forecasting.',
                        'rationale' => 'This talk helps you turn complex operational data into clear, compelling stories that influence senior stakeholders and guide transformation choices.',
                        'priority' => 'AsOpportunitiesArise',
                        'thumbnail_url' => 'https://aininja-temp.s3.amazonaws.com/thumbnails/faf78936af4b51eb36ef72108f4fda3b.jpg',
                    ],
                    [
                        'title' => 'The Beauty of Data Visualization',
                        'category_id' => 'watch',
                        'url' => 'https://www.ted.com/talks/david_mccandless_the_beauty_of_data_visualization',
                        'keywords' => [
                            'data visualization',
                            'infographics',
                            'visual storytelling',
                            'business',
                            'analytics',
                        ],
                        'description' => 'David McCandless demonstrates how transforming complex data sets into visual diagrams reveals patterns and insights.',
                        'rationale' => 'You will sharpen your data storytelling by seeing how visuals reveal patterns that spreadsheets hide.',
                        'priority' => 'AsOpportunitiesArise',
                        'thumbnail_url' => 'https://aininja-temp.s3.amazonaws.com/thumbnails/c7f1b2fa50aaa1838caa9bd3a8236e2b.jpg',
                    ],
                ],
            ],
        ];
    }

    public function addToPersonContext(string $category, string $text): self
    {
        $this->addToInputArray('person_context', $text, $category);

        return $this;
    }

    public function addToAssessmentContext(string $category, string $text): self
    {
        $this->addToInputArray('assessment_context', $text, $category);

        return $this;
    }

    public function addDevelopmentCategory($id, $name, $numItemsRequired): self
    {
        $this->addToInputArray('development_categories', [
            'id' => $id,
            'name' => $name,
            'num_items_required' => $numItemsRequired,
        ]);

        return $this;
    }

    public function addCompetencyScore(
        string $refcode,
        string $name,
        float $score,
        ?string $description = null,
        ?float $minValue = null,
        ?float $maxValue = null
    ): self {
        $competencyScore = [
            'refcode' => $refcode,
            'name' => $name,
            'score' => $score,
        ];

        if ($description !== null) {
            $competencyScore['description'] = $description;
        }

        if ($minValue !== null) {
            $competencyScore['minValue'] = $minValue;
        }

        if ($maxValue !== null) {
            $competencyScore['maxValue'] = $maxValue;
        }

        $this->addToInputArray('competency_scores', $competencyScore);

        return $this;
    }

    public function avoidActions($actions): self
    {
        if (is_array($actions)) {
            $actions = json_encode($actions);
        }
        $this->setInputParameter('avoid_actions', $actions);

        return $this;
    }

    public function instructions(?string $instructions = null): self
    {
        if ($instructions !== null) {
            $this->setInputParameter('instructions', $instructions);
        }

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'person_context' => 'required|array',
            'person_context.*' => 'required|string',
            'assessment_context' => 'required|array',
            'assessment_context.*' => 'required|string',
            'development_categories' => 'required|array',
            'development_categories.*.id' => 'required|string',
            'development_categories.*.name' => 'required|string',
            'development_categories.*.num_items_required' => 'required|integer',
            'competency_scores' => 'sometimes|array',
            'competency_scores.*.refcode' => 'required|string',
            'competency_scores.*.name' => 'required|string',
            'competency_scores.*.score' => 'required|numeric',
            'competency_scores.*.description' => 'sometimes|string|nullable',
            'competency_scores.*.minValue' => 'sometimes|numeric|nullable',
            'competency_scores.*.maxValue' => 'sometimes|numeric|nullable',
            'avoid_actions' => 'sometimes|string|nullable',
            'instructions' => 'sometimes|string|nullable',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentIdpCreatorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentIdpCreatorResult
    {
        return parent::retrieveRunResult($run);
    }
}
