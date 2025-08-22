<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaVoiceOverResult extends AINinjaResult
{
    public function getSubtitles(): Collection
    {
        $subtitlesData = collect($this->result)->get('subtitles', []);
        $subtitles = collect($subtitlesData)->get('subtitles', []);

        return collect($subtitles);
    }

    public function getAudioBase64(): ?string
    {
        return collect($this->result)->get('audio_b64');
    }

    public function getAudioBinary(): ?string
    {
        $base64Audio = $this->getAudioBase64();

        return $base64Audio ? base64_decode($base64Audio) : null;
    }
}
