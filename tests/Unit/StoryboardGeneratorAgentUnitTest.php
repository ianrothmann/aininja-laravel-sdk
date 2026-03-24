<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\StoryboardGeneratorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentStoryboardGeneratorResult;

it('can build storyboard generator agent with script', function () {
    $agent = (new AINinja)->agent()
        ->generateStoryboard()
        ->script('You have a magnetic presence that draws people in.')
        ->voiceId(StoryboardGeneratorAgent::VOICE_BRITISH_FEMALE_1);

    expect($agent)->toBeInstanceOf(StoryboardGeneratorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_storyboard_generator');
    expect($data['input']['script'])->toBe('You have a magnetic presence that draws people in.');
    expect($data['input']['voice_id'])->toBe('british_female_1');
});

it('can set optional audio url and alignment', function () {
    $agent = (new AINinja)->agent()
        ->generateStoryboard()
        ->script('Test script.')
        ->audioUrl('https://example.com/audio.mp3')
        ->alignment(['characters' => ['T', 'e', 's', 't'], 'character_start_times_seconds' => [0.0, 0.1, 0.2, 0.3], 'character_end_times_seconds' => [0.1, 0.2, 0.3, 0.4]])
        ->title('My Custom Title');

    $data = $agent->toArray();
    expect($data['input']['audio_url'])->toBe('https://example.com/audio.mp3');
    expect($data['input']['alignment'])->toBeArray();
    expect($data['input']['title'])->toBe('My Custom Title');
});

it('has all voice id constants', function () {
    expect(StoryboardGeneratorAgent::VOICE_BRITISH_MALE_1)->toBe('british_male_1');
    expect(StoryboardGeneratorAgent::VOICE_BRITISH_MALE_2)->toBe('british_male_2');
    expect(StoryboardGeneratorAgent::VOICE_BRITISH_MALE_3)->toBe('british_male_3');
    expect(StoryboardGeneratorAgent::VOICE_BRITISH_MALE_4)->toBe('british_male_4');
    expect(StoryboardGeneratorAgent::VOICE_AMERICAN_MALE_1)->toBe('american_male_1');
    expect(StoryboardGeneratorAgent::VOICE_AMERICAN_MALE_2)->toBe('american_male_2');
    expect(StoryboardGeneratorAgent::VOICE_BRITISH_FEMALE_1)->toBe('british_female_1');
    expect(StoryboardGeneratorAgent::VOICE_BRITISH_FEMALE_2)->toBe('british_female_2');
    expect(StoryboardGeneratorAgent::VOICE_BRITISH_FEMALE_3)->toBe('british_female_3');
    expect(StoryboardGeneratorAgent::VOICE_AMERICAN_FEMALE_1)->toBe('american_female_1');
    expect(StoryboardGeneratorAgent::VOICE_AMERICAN_FEMALE_2)->toBe('american_female_2');
});

it('returns mocked result with all output fields', function () {
    $mocked = (new AINinja)->agent()->generateStoryboard()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('audio');
    expect($mocked['output'])->toHaveKey('script');
    expect($mocked['output'])->toHaveKey('subtitles');
    expect($mocked['output'])->toHaveKey('cover_content');
    expect($mocked['output'])->toHaveKey('scenes');
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->generateStoryboard();

    $result = new AINinjaAgentStoryboardGeneratorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getAudio())->toBeString();
    expect($result->getScript())->toBeString();
    expect($result->getSubtitles())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getCoverContent())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getScenes())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getSceneCount())->toBeGreaterThan(0);
    expect($result->getTotalDuration())->toBeFloat();
});
