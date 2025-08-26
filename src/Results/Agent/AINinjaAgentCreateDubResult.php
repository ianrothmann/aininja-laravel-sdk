<?php

namespace IanRothmann\AINinja\Results\Agent;

use IanRothmann\AINinja\Processors\Agents\Run\AINinjaRunResult;
use Illuminate\Support\Collection;

class AINinjaAgentCreateDubResult extends AINinjaRunResult
{
    public function getDubbedAudioUrl(): ?string
    {
        return collect($this->result)->get('dubbed_audio_url');
    }

    public function getDubbedTranscript(): Collection
    {
        $transcript = collect($this->result)->get('dubbed_transcript', []);

        return collect($transcript);
    }

    public function getDubbedSubtitles(): Collection
    {
        return $this->getDubbedTranscript();
    }

    public function getSourceTranscript(): Collection
    {
        $transcript = collect($this->result)->get('source_transcript', []);

        return collect($transcript);
    }

    public function getSourceSubtitles(): Collection
    {
        return $this->getSourceTranscript();
    }
}
