<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\InstrumentInterpretationProcessorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentInstrumentInterpretationProcessorResult;

it('can build instrument interpretation processor agent', function () {
    $agent = (new AINinja)->agent()
        ->interpretInstruments()
        ->instruments([
            'ptg_personality' => [
                'result' => ['extraversion' => 4.2, 'agreeableness' => 3.8],
                'interpretation' => ['summary' => 'High extraversion profile.'],
            ],
        ]);

    expect($agent)->toBeInstanceOf(InstrumentInterpretationProcessorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_instrument_interpretation_processor');
    expect($data['input']['instruments'])->toBeArray();
    expect($data['input']['instruments'])->toHaveKey('ptg_personality');
});

it('returns mocked result with interpretations', function () {
    $mocked = (new AINinja)->agent()->interpretInstruments()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('interpretations');
    expect($mocked['output']['interpretations'])->toBeArray();
    expect(count($mocked['output']['interpretations']))->toBeGreaterThan(0);
});

it('result class can parse mocked data', function () {
    $agent = (new AINinja)->agent()->interpretInstruments();

    $result = new AINinjaAgentInstrumentInterpretationProcessorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getInterpretations())->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($result->getInterpretationCount())->toBeGreaterThan(0);
});

it('can retrieve interpretation by instrument key', function () {
    $agent = (new AINinja)->agent()->interpretInstruments();

    $result = new AINinjaAgentInstrumentInterpretationProcessorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    $personality = $result->getInterpretationByKey('ptg_personality');
    expect($personality)->toBeInstanceOf(\Illuminate\Support\Collection::class);
    expect($personality->get('instrument_key'))->toBe('ptg_personality');
    expect($personality->get('instrument_interpretation'))->toBeString();

    $missing = $result->getInterpretationByKey('nonexistent');
    expect($missing)->toBeNull();
});
