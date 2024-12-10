<?php

use IanRothmann\AINinja\AINinja;

it('can generate a role profile', function () {
    $handler = new AINinja;
    $result = $handler->generateRoleProfile()
        ->basedOn('A Laravel Developer in PHP')
        ->setTraceId('Test')
        ->get();

    expect($result->getRoleProfile())->toBeString();
});
