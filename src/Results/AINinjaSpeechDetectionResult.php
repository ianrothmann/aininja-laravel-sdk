<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaSpeechDetectionResult extends AINinjaResult
{
    public function getTotalSpeechSeconds(): ?string
    {
        return $this->result['total_speech_duration'] ?? null;
    }

    public function getTimestamps(): Collection
    {
        return collect($this->result['timestamps']);
    }
}
