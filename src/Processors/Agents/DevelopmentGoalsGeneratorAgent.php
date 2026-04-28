<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentDevelopmentGoalsGeneratorResult;

class DevelopmentGoalsGeneratorAgent extends AINinjaAgent
{
    use OutputsInLanguage;
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_development_goals_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentDevelopmentGoalsGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'development_goal_generation_version' => 'v1.0',
                'development_goals' => [
                    [
                        'id' => 'dg_001',
                        'title' => 'Set Direction and Make Decisions in Uncertainty',
                        'summary' => 'Develop the ability to lead strategically when information is incomplete, aligning teams around a clear direction even in ambiguous situations.',
                        'goal_type' => 'leadership_growth',
                        'linked_aspirations' => [
                            ['title' => 'Move into a CFO transformation leadership role'],
                        ],
                        'linked_development_areas' => [
                            ['title' => 'Letting collaboration slow bold decisions'],
                        ],
                        'linked_strengths' => [
                            ['title' => 'Applies structure and prioritises to deliver results'],
                        ],
                        'confidence' => 0.82,
                        'rationale' => 'Bridges the decision-making development area with the aspiration to lead large-scale transformations requiring executive decisiveness.',
                    ],
                    [
                        'id' => 'dg_002',
                        'title' => 'Communicate with Authority to Senior Finance Leaders',
                        'summary' => 'Build executive presence and the ability to convey complex ideas with clarity and influence at board and C-suite level.',
                        'goal_type' => 'communication_growth',
                        'linked_aspirations' => [
                            ['title' => 'Move into a CFO transformation leadership role'],
                        ],
                        'linked_development_areas' => [
                            ['title' => 'Asserting views in high-stakes forums'],
                        ],
                        'linked_strengths' => [
                            ['title' => 'Builds trust through relationships'],
                        ],
                        'confidence' => 0.84,
                        'rationale' => 'Directly supports the aspiration to operate at CFO level by closing the gap in executive communication confidence.',
                    ],
                ],
                'rejected_candidate_goals' => [
                    [
                        'theme' => 'Improve cross-functional team coordination',
                        'reason' => 'overlap',
                    ],
                ],
            ],
        ];
    }

    public function personContext(array $context): self
    {
        $this->input['person_context'] = $context;

        return $this;
    }

    public function currentState(array $state): self
    {
        $this->input['current_state'] = $state;

        return $this;
    }

    public function futureState(array $state): self
    {
        $this->input['future_state'] = $state;

        return $this;
    }

    public function optionalContext(array $context): self
    {
        $this->input['optional_context'] = $context;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'person_context' => 'nullable|array',
            'current_state' => 'required|array',
            'current_state.strengths' => 'required|array',
            'current_state.development_areas' => 'required|array',
            'current_state.instrument_interpretations' => 'nullable|array',
            'future_state' => 'required|array',
            'future_state.aspirations' => 'required|array',
            'optional_context' => 'nullable|array',
            'output_language_name' => 'nullable|string',
            'output_language_code' => 'nullable|string',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentDevelopmentGoalsGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentDevelopmentGoalsGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
