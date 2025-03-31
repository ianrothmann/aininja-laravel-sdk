<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Processors\Agents\GenerateFeedbackVideoAgent;

class AINinjaAgent
{
    public function generateFeedbackVideo(): GenerateFeedbackVideoAgent
    {
        return new GenerateFeedbackVideoAgent;
    }
}
