<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentLearningActionsGeneratorResult;

class LearningActionsGeneratorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_learning_actions_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentLearningActionsGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'person_id' => 'person_001',
                'run_date' => '2026-03-31',
                'weekly_plan_summary' => [
                    'target_total_items' => 5,
                    'selected_total_items' => 4,
                    'news_items_selected' => 1,
                    'event_items_selected' => 0,
                    'evergreen_items_selected' => 3,
                ],
                'weekly_learning_actions' => [
                    [
                        'learning_domain_id' => 'ld_001',
                        'learning_domain_title' => 'Strategic Leadership',
                        'learning_resource_type_id' => 'read',
                        'title' => 'The Making of a Manager',
                        'description' => 'A practical guide to leading teams effectively, covering feedback, meetings, and hiring.',
                        'url' => 'https://example.com/making-of-a-manager',
                        'resource_date' => '2019-01-01',
                        'source_name' => 'Book',
                        'why_selected' => 'Directly addresses the transition from individual contributor to manager — highly relevant to the leadership aspiration.',
                        'novelty_reason' => 'Not previously seen in learning history.',
                        'confidence' => 0.91,
                    ],
                    [
                        'learning_domain_id' => 'ld_002',
                        'learning_domain_title' => 'Business Acumen & Commercial Thinking',
                        'learning_resource_type_id' => 'watch',
                        'title' => 'How to Read a P&L Statement',
                        'description' => 'A short video walkthrough of profit and loss statements for non-finance leaders.',
                        'url' => 'https://example.com/pl-statement',
                        'resource_date' => '2024-06-01',
                        'source_name' => 'YouTube',
                        'why_selected' => 'Builds financial literacy — a core gap for moving into an executive role.',
                        'novelty_reason' => 'Not covered in recent learning history.',
                        'confidence' => 0.87,
                    ],
                ],
                'coverage_notes' => [
                    'Focused on leadership transition and business acumen as the highest-priority domains this week.',
                ],
                'warnings' => [],
            ],
        ];
    }

    public function person(array $person): self
    {
        $this->input['person'] = $person;

        return $this;
    }

    public function resourcePreferences(array $preferences): self
    {
        $this->input['resource_preferences'] = $preferences;

        return $this;
    }

    public function activeLearningDomains(array $domains): self
    {
        $this->input['active_learning_domains'] = $domains;

        return $this;
    }

    public function existingLearningItems(array $items): self
    {
        $this->input['existing_learning_items'] = $items;

        return $this;
    }

    public function recentCoverage(array $coverage): self
    {
        $this->input['recent_coverage'] = $coverage;

        return $this;
    }

    public function runContext(array $context): self
    {
        $this->input['run_context'] = $context;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'person'                     => 'required|array',
            'person.id'                  => 'required|string',
            'person.country'             => 'required|string',
            'person.timezone'            => 'required|string',
            'person.language'            => 'required|string',
            'resource_preferences'       => 'required|array',
            'active_learning_domains'    => 'required|array',
            'existing_learning_items'    => 'nullable|array',
            'recent_coverage'            => 'nullable|array',
            'run_context'                => 'required|array',
            'run_context.run_date'       => 'required|string',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentLearningActionsGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentLearningActionsGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
