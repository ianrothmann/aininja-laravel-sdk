<?php

namespace IanRothmann\AINinja\Results;

class AINinjaInterviewQualityResult extends AINinjaResult
{
    public function getOverallRating(): ?int
    {
        return $this->result['overall_rating'] ?? null;
    }

    public function getOverallComments(): ?string
    {
        return $this->result['overall_comments'] ?? null;
    }

    public function getGeneralSuggestions(): ?string
    {
        return $this->result['general_suggestions'] ?? null;
    }

    public function getAdditionalQuestions(): ?string
    {
        return $this->result['additional_questions'] ?? null;
    }

    public function getExpectedResponseComment(): ?string
    {
        return $this->result['expected_response_comment'] ?? null;
    }

    public function getResponseTypeReview(): ?string
    {
        return $this->result['response_type_review'] ?? null;
    }
}
