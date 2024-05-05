<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Processors\AINinjaProcessor;
use IanRothmann\AINinja\Processors\GenerateJsonProcessor;
use IanRothmann\AINinja\Runners\AINinjaRunner;
use IanRothmann\AINinja\Traits\CanRunBatches;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableResponse;
use Illuminate\Support\Collection;

class AINinja
{
    use CanRunBatches;

    public function generateJson(): GenerateJsonProcessor
    {
        return new GenerateJsonProcessor();
    }
}
