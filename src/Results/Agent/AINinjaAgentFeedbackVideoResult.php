<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;

class AINinjaAgentFeedbackVideoResult extends AINinjaRunResult
{
    public function getScript(): ?string
    {
        return collect($this->result)->get('script');
    }

    public function getFeedback(): ?string
    {
        return collect($this->result)->get('feedback');
    }

    public function getVideoUrl(): ?string
    {
        return collect($this->result)->get('video_url');
    }
}
