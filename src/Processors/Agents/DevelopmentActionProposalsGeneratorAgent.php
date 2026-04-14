<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentDevelopmentActionProposalsGeneratorResult;

class DevelopmentActionProposalsGeneratorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_development_action_proposals_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentDevelopmentActionProposalsGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'summary' => [
                    'mode_used' => 'mixed',
                    'generated_count' => 2,
                    'coverage_by_category' => [
                        'experience' => 1,
                        'exposure' => 1,
                        'education' => 0,
                    ],
                    'coverage_by_goal_id' => [
                        'goal_001' => 2,
                    ],
                    'notes' => [
                        'Prioritised the underrepresented goal with two proposals.',
                    ],
                ],
                'proposals' => [
                    [
                        'goal_id' => 'goal_001',
                        'category' => 'experience',
                        'timeframe' => 'short_term',
                        'title' => 'Run a Decide–Deliver Sprint on a Live CFO Workstream',
                        'description' => 'Select a high-ambiguity finance transformation workstream and lead a 30-day sprint to make three high-impact, time-boxed decisions with explicit decision rights and trade-off rationale.',
                        'rationale' => 'You have the structure and integrative thinking to simplify complexity, but collaboration can slow firm decisions. A contained sprint forces clarity of decision rights and sharper trade-offs.',
                        'source_type' => 'new',
                        'fit_score' => 0.88,
                        'novelty_reason' => 'No prior items focus on decision velocity and irreversible calls on a live transformation.',
                        'based_on_proposal_ids' => [],
                        'based_on_action_ids' => [],
                    ],
                    [
                        'goal_id' => 'goal_001',
                        'category' => 'exposure',
                        'timeframe' => 'medium_term',
                        'title' => 'Engage an Ex-CFO Decision Coach for Two High-Stakes Meetings',
                        'description' => 'Invite a respected ex-CFO to observe two pivotal transformation meetings and provide candid debrief on decision clarity, pace, and governance.',
                        'rationale' => 'An external operator\'s lens raises the standard on decisiveness and presence in the moments that matter.',
                        'source_type' => 'new',
                        'fit_score' => 0.80,
                        'novelty_reason' => 'Different from internal peer feedback; focuses on decision dynamics with an external ex-CFO.',
                        'based_on_proposal_ids' => [],
                        'based_on_action_ids' => [],
                    ],
                ],
            ],
        ];
    }

    public function profile(array $profile): self
    {
        $this->input['profile'] = $profile;

        return $this;
    }

    public function contexts(array $contexts): self
    {
        $this->input['contexts'] = $contexts;

        return $this;
    }

    public function developmentGoals(array $goals): self
    {
        $this->input['development_goals'] = $goals;

        return $this;
    }

    public function existingProposals(array $proposals): self
    {
        $this->input['existing_proposals'] = $proposals;

        return $this;
    }

    public function existingActions(array $actions): self
    {
        $this->input['existing_actions'] = $actions;

        return $this;
    }

    public function generationRequest(array $request): self
    {
        $this->input['generation_request'] = $request;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'profile'                  => 'required|array',
            'contexts'                 => 'nullable|array',
            'development_goals'        => 'required|array',
            'development_goals.*.id'   => 'required|string',
            'development_goals.*.name' => 'required|string',
            'existing_proposals'       => 'nullable|array',
            'existing_actions'         => 'nullable|array',
            'generation_request'       => 'required|array',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentDevelopmentActionProposalsGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentDevelopmentActionProposalsGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
