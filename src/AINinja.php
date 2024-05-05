<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Processors\GenerateJsonProcessor;
use IanRothmann\AINinja\Traits\CanRunBatches;

class AINinja
{
    use CanRunBatches;

    public function generateJson(): GenerateJsonProcessor
    {
        return new GenerateJsonProcessor();
    }
}
