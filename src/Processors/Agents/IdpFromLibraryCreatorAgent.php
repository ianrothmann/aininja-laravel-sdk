<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentIdpFromLibraryCreatorResult;

class IdpFromLibraryCreatorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/idp_from_library_creator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentIdpFromLibraryCreatorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'dev_actions' => [
                    [
                        'title' => 'Participate in a mega project',
                        'category_id' => 'experience',
                        'dev_action_id' => 1102,
                        'description' => 'Join a high-visibility analysis project (e.g., inflation nowcast or liquidity stress testing) and own a discrete workstream from data sourcing to output checks.',
                        'rationale' => 'By taking end-to-end responsibility on a complex stream, you\'ll sharpen data rigor and produce outputs leaders can use quickly.',
                        'priority' => 'ShortTerm',
                    ],
                    [
                        'title' => 'Lead a cost benefit analysis',
                        'category_id' => 'experience',
                        'dev_action_id' => 1101,
                        'description' => 'Work through input costs and projected benefits step-by-step to frame clear trade-offs for a policy decision.',
                        'rationale' => 'This helps you quantify options and make your briefings more defensible to committee members.',
                        'priority' => 'MediumTerm',
                    ],
                ],
                'development_themes' => [
                    [
                        'title' => 'Strengthen Economic Analytics',
                        'summary' => 'Build core capability in sourcing, cleaning, modeling, and interpreting macroeconomic data using econometrics and statistical coding to produce policy-grade analyses and reports.',
                        'linked_competencies' => [
                            [
                                'refcode' => 'economic_data_analysis',
                                'name' => 'Economic Data Analysis',
                                'score' => 2.11372,
                            ],
                        ],
                        'business_impact_if_improved' => 'Enables timely nowcasts, scenario analyses, and chartbooks that improve briefing quality for monetary-policy and financial-stability committees; reduces rework and boosts credibility of recommendations.',
                        'quick_diagnostics' => [
                            'Can you build a reproducible inflation nowcast in R or Python?',
                            'Do your chartbooks auto-refresh from data pipelines with documented code?',
                        ],
                        'tags' => [
                            'macroeconomics',
                            'econometrics',
                            'data_analysis',
                        ],
                        'suggested_modality_focus' => [
                            'experience',
                            'education',
                            'elearn',
                            'read',
                        ],
                        'priority' => 1,
                        'evidence' => [
                            [
                                'type' => 'competency',
                                'ref' => 'economic_data_analysis',
                                'detail' => 'Score 2.11372 indicates a foundational gap.',
                            ],
                        ],
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

    public function addDevelopmentCategory($id, $name, $numActionsRequired): self
    {
        $this->addToInputArray('development_categories', [
            'id' => $id,
            'name' => $name,
            'num_items_required' => $numActionsRequired,
            'development_actions' => [],
        ]);

        return $this;
    }

    public function addDevelopmentAction($categoryId, $actionId, $actionName, $actionDescription, $rationaleHint = null, $theme = null): self
    {
        if (! array_key_exists('development_categories', $this->input)) {
            throw new \Exception('Development categories must be added before adding actions');
        }
        $categories = collect($this->input['development_categories'])->where('id', $categoryId);

        if ($categories->count() == 0) {
            throw new \Exception('Development category with id '.$categoryId.' not found');
        }

        $categoryKey = $categories->keys()->first();
        $category = $categories->first();

        $action = [
            'id' => $actionId,
            'title' => $actionName,
            'description' => $actionDescription,
            'rationale_hint' => $rationaleHint,
        ];

        if ($theme !== null) {
            $action['theme'] = $theme;
        }

        $category['development_actions'][] = $action;

        $this->input['development_categories'][$categoryKey] = $category;

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
            'development_categories.*.development_actions' => 'required|array',
            'development_categories.*.development_actions.*.id' => 'required',
            'development_categories.*.development_actions.*.title' => 'required|string',
            'development_categories.*.development_actions.*.description' => 'required|string',
            'development_categories.*.development_actions.*.rationale_hint' => 'sometimes|string|nullable',
            'development_categories.*.development_actions.*.theme' => 'sometimes|string|nullable',
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

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentIdpFromLibraryCreatorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentIdpFromLibraryCreatorResult
    {
        return parent::retrieveRunResult($run);
    }
}
