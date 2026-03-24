<?php

use IanRothmann\AINinja\AINinja;
use IanRothmann\AINinja\Processors\Agents\ProfileInfoExtractorAgent;
use IanRothmann\AINinja\Results\Agent\AINinjaAgentProfileInfoExtractorResult;
use Illuminate\Support\Collection;

it('can build profile info extractor agent with candidate context', function () {
    $agent = (new AINinja)->agent()
        ->extractProfileInfo()
        ->candidateContext([
            'bio' => ['name' => 'Alex', 'surname' => 'Morgan', 'country' => 'New Zealand'],
            'experience' => '2019 - Present: Senior Software Engineer.',
            'qualifications' => 'BSc Computer Science, Westfield University, 2015.',
        ]);

    expect($agent)->toBeInstanceOf(ProfileInfoExtractorAgent::class);

    $data = $agent->toArray();
    expect($data['endpoint'])->toBe('/agent_profile_info_extractor');
    expect($data['input']['input'])->toBeArray();
    expect($data['input']['input']['bio']['name'])->toBe('Alex');
});

it('returns mocked result with person profile extract', function () {
    $mocked = (new AINinja)->agent()->extractProfileInfo()->getMocked();

    expect($mocked)->toHaveKey('output');
    expect($mocked['output'])->toHaveKey('person_profile_extract');
    expect($mocked['output'])->toHaveKey('extraction_meta');
    expect($mocked['output'])->toHaveKey('instrument_interpretations');
});

it('result class can parse mocked data and extract name fields', function () {
    $agent = (new AINinja)->agent()->extractProfileInfo();

    $result = new AINinjaAgentProfileInfoExtractorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->isSuccessful())->toBeTrue();
    expect($result->getPersonProfileExtract())->toBeInstanceOf(Collection::class);
    expect($result->getExtractionMeta())->toBeInstanceOf(Collection::class);
    expect($result->getInstrumentInterpretations())->toBeInstanceOf(Collection::class);
    expect($result->getIdentity())->toBeInstanceOf(Collection::class);
    expect($result->getFirstName())->toBe('Alex');
    expect($result->getSurname())->toBe('Morgan');
    expect($result->getFullName())->toBe('Alex Morgan');
});

it('result class can access demographics and career snapshot', function () {
    $agent = (new AINinja)->agent()->extractProfileInfo();

    $result = new AINinjaAgentProfileInfoExtractorResult([
        'status' => 'success',
        'response' => $agent->getMocked(),
    ]);

    expect($result->getDemographics())->toBeInstanceOf(Collection::class);
    expect($result->getCareerSnapshot())->toBeInstanceOf(Collection::class);
    expect($result->getExperience())->toBeInstanceOf(Collection::class);
    expect($result->getQualifications())->toBeInstanceOf(Collection::class);
});
