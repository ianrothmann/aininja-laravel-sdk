<?php


use IanRothmann\AINinja\AINinja;

it('can generate a job description',function(){
    $handler = new AINinja();
    $result=$handler->generateJobDescription()
        ->basedOn('A Laravel Developer in PHP')
        ->stream(function (\IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamEvent $response){
            if($response->getContent()){
                //dd($response->getContent());
            }
        });
    expect($result->getSummary())->toBeString();
    expect($result->getEducationRequirements())->toBeString();
    expect($result->getExperienceRequirements())->toBeString();
    expect($result->getEducationRequirements())->toBeString();
    expect($result->getOtherRequirements())->toBeString();
});
