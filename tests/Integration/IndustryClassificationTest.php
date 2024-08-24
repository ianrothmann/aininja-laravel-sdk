<?php

use IanRothmann\AINinja\AINinja;

it('can classify NAIC industry based on context', function () {
    $handler = new AINinja;

    $result = $handler->classifyIndustry()
        ->addToContext('company_name', 'ABC Commercial Bank')
        ->get();

    expect($result->getCode())->toBe('5221');
    expect($result->getName())->toBe('Depository Credit Intermediation');
});
