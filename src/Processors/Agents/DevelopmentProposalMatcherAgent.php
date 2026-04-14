<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentDevelopmentProposalMatcherResult;

class DevelopmentProposalMatcherAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_development_proposal_matcher';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentDevelopmentProposalMatcherResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'goal_matches' => [
                    [
                        'goal_id' => 'goal_001',
                        'actions' => [
                            [
                                'action_id' => 'proposal_001',
                                'reason' => 'Leading a cross-functional project directly builds structured decision-making and stakeholder alignment. It closely mirrors the goal of making firm decisions while keeping teams engaged.',
                            ],
                            [
                                'action_id' => 'proposal_002',
                                'reason' => 'This proposal specifically targets landing decisions clearly without losing team engagement, supporting balanced pace with inclusion.',
                            ],
                        ],
                    ],
                    [
                        'goal_id' => 'goal_002',
                        'actions' => [
                            [
                                'action_id' => 'proposal_003',
                                'reason' => 'Authoring a forward-looking POV directly advances the goal of shaping a compelling vision for finance transformation through visible thought leadership.',
                            ],
                        ],
                    ],
                ],
                'unmatched_goal_ids' => [],
                'unmatched_action_ids' => [],
            ],
        ];
    }

    public function developmentGoals(array $goals): self
    {
        $this->input['development_goals'] = $goals;

        return $this;
    }

    public function developmentProposals(array $proposals): self
    {
        $this->input['development_proposals'] = $proposals;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'development_goals' => 'nullable|array',
            'development_goals.*.id' => 'required_with:development_goals|string',
            'development_goals.*.name' => 'required_with:development_goals|string',
            'development_goals.*.description' => 'required_with:development_goals|string',
            'development_proposals' => 'nullable|array',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentDevelopmentProposalMatcherResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentDevelopmentProposalMatcherResult
    {
        return parent::retrieveRunResult($run);
    }
}
