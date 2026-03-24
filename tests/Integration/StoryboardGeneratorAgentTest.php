<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\StoryboardGeneratorAgent;
use Illuminate\Support\Collection;

it('can run storyboard generator agent', function () {
    $result = (new AINinja)->agent()
        ->generateStoryboard()
        ->script('You have a magnetic presence that draws people in and energizes every room you enter. People are naturally drawn to your warmth and confidence. You speak up easily, share ideas with conviction, and take the lead when the moment calls for it.')
        ->voiceId(StoryboardGeneratorAgent::VOICE_BRITISH_FEMALE_1)
        ->runAndWait(10);

    expect($result->isSuccessful())->toBeTrue();
    if ($result->isSuccessful()) {
        expect($result->getAudio())->toBeString();
        expect($result->getScenes())->toBeInstanceOf(Collection::class);
        expect($result->getSceneCount())->toBeGreaterThan(0);
    }
});
