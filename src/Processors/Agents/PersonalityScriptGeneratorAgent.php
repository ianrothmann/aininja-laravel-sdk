<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentPersonalityScriptGeneratorResult;

class PersonalityScriptGeneratorAgent extends AINinjaAgent
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_personality_script_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentPersonalityScriptGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'extraversion_script' => [
                'title' => 'Your Social Energy',
                'script' => 'You bring energy into every room you enter. People notice you — not because you try to be noticed, but because you genuinely enjoy being around others. Conversations light you up, and you\'re at your best when you\'re connecting, collaborating, and making things happen with people. You probably find that your ideas come to life through talking them through, and that working alongside others sharpens your thinking. That social energy is a real asset — use it.',
            ],
            'openness_script' => [
                'title' => 'Your Curiosity and Imagination',
                'script' => 'You\'re someone who sees possibility where others see routine. New ideas energise you, and you\'re comfortable sitting with complexity and ambiguity — often finding that\'s where the most interesting work happens. You tend to think in patterns and connections that others might miss, and you\'re not afraid to explore unconventional approaches. That imagination and openness to experience is a genuine strength — it helps you innovate and adapt in ways that matter.',
            ],
            'agreeableness_script' => [
                'title' => 'Your Collaborative Nature',
                'script' => 'You lead with warmth and a genuine interest in others. When you\'re in a team, people feel it — you create an environment where others feel valued and heard. You tend to seek common ground rather than conflict, and you\'re often the person who helps a team find a way forward when things get stuck. That collaborative spirit is something workplaces need more of. Just make sure you\'re also giving your own needs and perspectives the same weight you give to others.',
            ],
            'conscientiousness_script' => [
                'title' => 'Your Drive for Excellence',
                'script' => 'When you commit to something, you follow through. You have high standards — for yourself and your work — and you approach tasks with a level of care and discipline that produces real results. You\'re organised, dependable, and you take quality seriously. That\'s the kind of reliability that builds trust over time. The key is balancing your high standards with flexibility — not everything needs to be perfect, and sometimes good enough, done quickly, creates more value than excellent, done late.',
            ],
        ];
    }

    public function firstName(string $name): self
    {
        $this->input['first_name'] = $name;

        return $this;
    }

    public function candidateContext(string $context): self
    {
        $this->input['candidate_context'] = $context;

        return $this;
    }

    public function fullProfile(string $profile): self
    {
        $this->input['full_profile'] = $profile;

        return $this;
    }

    public function personalityLevels(array $levels): self
    {
        $this->input['personality_levels'] = $levels;

        return $this;
    }

    public function outputLanguageName(string $name): self
    {
        $this->input['output_language_name'] = $name;

        return $this;
    }

    public function outputLanguageCode(string $code): self
    {
        $this->input['output_language_code'] = $code;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'first_name' => 'required|string',
            'candidate_context' => 'required|string',
            'full_profile' => 'required|string',
            'personality_levels' => 'required|array',
            'output_language_name' => 'nullable|string',
            'output_language_code' => 'nullable|string',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentPersonalityScriptGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentPersonalityScriptGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
