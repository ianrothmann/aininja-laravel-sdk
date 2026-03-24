<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentSuccessProfileMatcherResult;

class SuccessProfileMatcherAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_success_profile_matcher';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentSuccessProfileMatcherResult::class;
    }

    public function getMocked(): array
    {
        return [
            'final_matches' => [
                [
                    'personid' => 'person_001',
                    'person_info' => 'Senior software engineer with 10 years experience in backend development and team leadership.',
                    'matches' => [
                        [
                            'successprofileid' => 1,
                            'name' => 'Senior Developer',
                            'classification' => ['high' => 0.82, 'medium' => 0.12, 'low' => 0.06],
                            'requirements' => [
                                'education' => ['Bachelor\'s degree in Computer Science or related field'],
                                'experience' => ['5+ years software development', '2+ years team leadership'],
                            ],
                        ],
                    ],
                ],
                [
                    'personid' => 'person_002',
                    'person_info' => 'Junior developer with 2 years experience, strong academic background.',
                    'matches' => [
                        [
                            'successprofileid' => 2,
                            'name' => 'Junior Developer',
                            'classification' => ['high' => 0.75, 'medium' => 0.20, 'low' => 0.05],
                            'requirements' => [
                                'education' => ['Bachelor\'s degree in Computer Science'],
                                'experience' => ['1+ years software development'],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function successProfiles(array $profiles): self
    {
        $this->input['success_profiles'] = $profiles;

        return $this;
    }

    public function eligiblePersons(array $persons): self
    {
        $this->input['eligible_persons'] = $persons;

        return $this;
    }

    public function cosineSimilarityThreshold(float $threshold = 0.5): self
    {
        $this->input['cosine_similarity_threshold'] = $threshold;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'success_profiles' => 'required|array',
            'eligible_persons' => 'required|array',
            'cosine_similarity_threshold' => 'numeric|min:0|max:1',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentSuccessProfileMatcherResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentSuccessProfileMatcherResult
    {
        return parent::retrieveRunResult($run);
    }
}
