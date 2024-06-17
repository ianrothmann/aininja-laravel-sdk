<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Arr;

class AINinjaLanguageAssessmentResult extends AINinjaResult
{
    public function getTranscription(): ?string
    {
        return Arr::get($this->result, 'DisplayText');
    }

    public function wasSuccessful(): bool
    {
        return Arr::get($this->result, 'RecognitionStatus') === 'Success';
    }

    public function getConfidence(): ?float
    {
        return Arr::get($this->result, 'Confidence') !== null ? (float) Arr::get($this->result, 'Confidence') : null;
    }

    public function isConfident(): bool
    {
        return $this->getConfidence() >= 0.65;
    }

    public function getAccuracyScore(): ?float
    {
        return Arr::get($this->result, 'PronunciationAssessment.AccuracyScore') !== null ? (float) Arr::get($this->result, 'PronunciationAssessment.AccuracyScore') : null;
    }

    public function getFluencyScore(): ?float
    {
        return Arr::get($this->result, 'PronunciationAssessment.FluencyScore') !== null ? (float) Arr::get($this->result, 'PronunciationAssessment.FluencyScore') : null;
    }

    public function getProsodyScore(): ?float
    {
        return Arr::get($this->result, 'PronunciationAssessment.ProsodyScore') !== null ? (float) Arr::get($this->result, 'PronunciationAssessment.ProsodyScore') : null;
    }

    public function getCompletenessScore(): ?float
    {
        return Arr::get($this->result, 'PronunciationAssessment.CompletenessScore') !== null ? (float) Arr::get($this->result, 'PronunciationAssessment.CompletenessScore') : null;
    }

    public function getOverallPronunciationScore(): ?float
    {
        return Arr::get($this->result, 'PronunciationAssessment.PronScore') !== null ? (float) Arr::get($this->result, 'PronunciationAssessment.PronScore') : null;
    }

    public function getOverallContentScore(): ?float
    {
        return 0.4 * $this->getGrammarScore() + 0.4 * $this->getVocabularyScore() + 0.2 * $this->getTopicScore();
    }

    public function getOverallScore(): ?float
    {
        return 0.6 * $this->getOverallPronunciationScore() + 0.4 * $this->getOverallContentScore();
    }

    public function getGrammarScore(): ?float
    {
        return Arr::get($this->result, 'ContentAssessment.GrammarScore') !== null ? (float) Arr::get($this->result, 'ContentAssessment.GrammarScore') : null;
    }

    public function getVocabularyScore(): ?float
    {
        return Arr::get($this->result, 'ContentAssessment.VocabularyScore') !== null ? (float) Arr::get($this->result, 'ContentAssessment.VocabularyScore') : null;
    }

    public function getTopicScore(): ?float
    {
        return Arr::get($this->result, 'ContentAssessment.TopicScore') !== null ? (float) Arr::get($this->result, 'ContentAssessment.TopicScore') : null;
    }
}
