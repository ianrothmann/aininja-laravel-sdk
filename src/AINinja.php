<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Processors\GenerateJsonProcessor;
use IanRothmann\AINinja\Processors\InterviewReportProcessor;
use IanRothmann\AINinja\Processors\JobDescriptionCreateProcessor;
use IanRothmann\AINinja\Traits\CanRunBatches;

class AINinja
{
    use CanRunBatches;

    public function generateJson(): GenerateJsonProcessor
    {
        return new GenerateJsonProcessor();
    }

    public function writeInterviewReport(): InterviewReportProcessor
    {
        return new InterviewReportProcessor();
    }

    public function generateJobDescription(): JobDescriptionCreateProcessor
    {
        return new JobDescriptionCreateProcessor();
    }
}
