<?php

namespace IanRothmann\AINinja\Results;

class AINinjaTranscribeURLResult extends AINinjaResult
{
    public function getTranscription(): ?string
    {
        return $this->result['transcription'] ?? null;
    }

    public function getSRT(): ?array
    {
        return $this->result['srt'] ?? null;
    }

    public function getComplement(): ?string
    {
        return $this->result['complement'] ?? null;
    }

    public function getSummary(): ?string
    {
        return $this->result['summary'] ?? null;
    }

    public function getTopics(): ?array
    {
        return $this->result['topics'] ?? null;
    }

    public function transcriptIsWithinQuestionContext(): bool
    {
        return collect($this->result)->get('within_question_context') ?? true;
    }

    public function getValidTranscript(): bool
    {
        return $this->result['valid_transcript'] ?? true;
    }
}
