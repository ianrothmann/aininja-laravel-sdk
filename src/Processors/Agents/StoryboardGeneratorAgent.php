<?php

namespace IanRothmann\AINinja\Processors\Agents;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaAgentRun;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentStoryboardGeneratorResult;

class StoryboardGeneratorAgent extends AINinjaAgent
{
    const VOICE_BRITISH_MALE_1 = 'british_male_1';

    const VOICE_BRITISH_MALE_2 = 'british_male_2';

    const VOICE_BRITISH_MALE_3 = 'british_male_3';

    const VOICE_BRITISH_MALE_4 = 'british_male_4';

    const VOICE_AMERICAN_MALE_1 = 'american_male_1';

    const VOICE_AMERICAN_MALE_2 = 'american_male_2';

    const VOICE_BRITISH_FEMALE_1 = 'british_female_1';

    const VOICE_BRITISH_FEMALE_2 = 'british_female_2';

    const VOICE_BRITISH_FEMALE_3 = 'british_female_3';

    const VOICE_AMERICAN_FEMALE_1 = 'american_female_1';

    const VOICE_AMERICAN_FEMALE_2 = 'american_female_2';

    public function __construct()
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return '/agent_storyboard_generator';
    }

    public function getResultClass(): string
    {
        return AINinjaAgentStoryboardGeneratorResult::class;
    }

    public function getMocked(): array
    {
        return [
            'output' => [
                'audio' => 'https://example.com/audio/sample.mp3',
                'script' => 'You have a magnetic presence that draws people in and energizes every room you enter.',
                'subtitles' => [
                    ['text' => 'You have a magnetic presence', 'start' => 0.0, 'end' => 2.5],
                    ['text' => 'that draws people in', 'start' => 2.5, 'end' => 4.8],
                    ['text' => 'and energizes every room you enter.', 'start' => 4.8, 'end' => 7.2],
                ],
                'cover_content' => [
                    'heading' => 'Leading With Energy and Inclusion',
                    'subheading' => 'Learn to harness your vibrant presence while empowering every voice in the workplace.',
                    'image_url' => 'https://example.com/thumbnails/cover.jpg',
                ],
                'scenes' => [
                    [
                        'id' => 'title',
                        'type' => 'classic',
                        'accent' => '#60a5fa',
                        'background' => 'aurora',
                        'duration' => 13.05,
                        'data' => [
                            'heading' => 'Laura',
                            'subheading' => 'You have a magnetic presence that draws people in and energizes every room you enter.',
                            'label' => 'Personal Profile',
                            'tag' => 'Confident Connector',
                            'items' => null,
                            'itemsAlt' => null,
                            'itemTimings' => null,
                            'gauge' => null,
                        ],
                        'lottieSrc' => '/lotties/User_V6_4.json',
                        'lottieSources' => null,
                        'items' => null,
                        'highlightWord' => null,
                        'typedLines' => [
                            ['text' => 'Your energy lights up a room', 'at' => 1.86],
                            ['text' => 'People are drawn to you', 'at' => 5.68],
                        ],
                        'lines' => null,
                        'emphasis' => null,
                    ],
                    [
                        'id' => 'text-marker',
                        'type' => 'text',
                        'accent' => '#34d399',
                        'background' => 'aurora',
                        'duration' => 8.2,
                        'data' => null,
                        'lottieSrc' => null,
                        'lottieSources' => null,
                        'items' => null,
                        'highlightWord' => null,
                        'typedLines' => null,
                        'lines' => [
                            'Connecting lights you up inside',
                            'You thrive on building real rapport',
                        ],
                        'emphasis' => [
                            ['line' => 0, 'words' => ['Connecting', 'lights', 'up']],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function script(string $script): self
    {
        $this->input['script'] = $script;

        return $this;
    }

    public function voiceId(string $voiceId = self::VOICE_BRITISH_MALE_1): self
    {
        $this->input['voice_id'] = $voiceId;

        return $this;
    }

    public function audioUrl(string $audioUrl): self
    {
        $this->input['audio_url'] = $audioUrl;

        return $this;
    }

    public function alignment(array $alignment): self
    {
        $this->input['alignment'] = $alignment;

        return $this;
    }

    public function title(string $title): self
    {
        $this->input['title'] = $title;

        return $this;
    }

    protected function getValidationRules(): array
    {
        return [
            'script' => 'required|string',
            'voice_id' => 'string|in:british_male_1,british_male_2,british_male_3,british_male_4,american_male_1,american_male_2,british_female_1,british_female_2,british_female_3,american_female_1,american_female_2',
            'audio_url' => 'string|nullable',
            'alignment' => 'array|nullable',
            'title' => 'string|nullable',
        ];
    }

    public function runAndWait($waitIntervalSeconds = null): AINinjaAgentStoryboardGeneratorResult
    {
        return parent::runAndWait($waitIntervalSeconds);
    }

    public function retrieveRunResult(AINinjaAgentRun $run): AINinjaAgentStoryboardGeneratorResult
    {
        return parent::retrieveRunResult($run);
    }
}
