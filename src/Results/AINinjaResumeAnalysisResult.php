<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaResumeAnalysisResult extends AINinjaResult
{
    public function getError(): ?string
    {
        return collect($this->result)->get('error');
    }

    public function isValidResume(): ?bool
    {
        return collect($this->result)->get('is_resume');
    }

    public function getName(): ?string
    {
        return collect($this->result)->get('name');
    }

    public function getEmail(): ?string
    {
        $value = collect($this->result)->get('email');
        if (! $value || strtolower($value) == 'none') {
            return null;
        }

        return $value;
    }

    public function getMobile(): ?string
    {
        $value = collect($this->result)->get('mobile');
        if (! $value || strtolower($value) == 'none') {
            return null;
        }

        return $value;
    }

    public function getOverview(): ?string
    {
        $value = collect($this->result)->get('overview');
        if (! $value || strtolower($value) == 'none') {
            return null;
        }

        return $value;
    }

    public function getSkills(): Collection
    {
        $value = collect(collect($this->result)->get('skills'))->get('skills');
        return collect($value);
    }

    public function getQualifications(): Collection
    {
        $value = collect(collect($this->result)->get('qualifications'))->get('qualifications');

        return collect($value);
    }

    public function getJobHistory(): Collection
    {
        $value = collect(collect($this->result)->get('job_history'))->get('job_assignments');

        return collect($value);
    }

    public function getRating(): ?float
    {
        $ratings = [
            $this->getEducationRating(),
            $this->getSkillsRating(),
            $this->getExperienceRating(),
        ];

        // Filter out null values to ensure they don't affect the average calculation
        $validRatings = array_filter($ratings, function ($rating) {
            return $rating !== null;
        });

        if (count($validRatings) === 0) {
            // If there are no valid ratings, return null
            return null;
        }

        // Calculate the average of valid ratings
        $averageRating = array_sum($validRatings) / count($validRatings);

        return round($averageRating, 2); // Returning rounded average to 2 decimal places for precision
    }

    public function getRatingLabel(): string
    {
        $ratingNumber = $this->getRating();

        if (! $ratingNumber) {
            return 'N/A';
        }

        $ratingNumber = round($ratingNumber);

        $ratings = [
            1 => 'Poor Fit',
            2 => 'Below Average Fit',
            3 => 'Average Fit',
            4 => 'Strong Fit',
            5 => 'Exceptional Fit',
        ];

        return $ratings[$ratingNumber] ?? 'Unknown Rating';
    }

    public function getRatingReason(): string
    {
        $reasons = [];

        $educationReason = $this->getEducationRatingReason();
        if ($educationReason !== null) {
            $reasons[] = $educationReason;
        }

        $skillsReason = $this->getSkillsRatingReason();
        if ($skillsReason !== null) {
            $reasons[] = $skillsReason;
        }

        $experienceReason = $this->getExperienceRatingReason();
        if ($experienceReason !== null) {
            $reasons[] = $experienceReason;
        }

        $combinedReasons = implode(' ', $reasons);

        return $combinedReasons;
    }

    public function getEducationRating(): ?int
    {
        $value = collect($this->result)->get('rating');
        if (! $value) {
            return null;
        }

        return collect($value)->get('rating_education');
    }

    public function getEducationRatingReason(): ?string
    {
        $value = collect($this->result)->get('rating');
        if (! $value) {
            return null;
        }

        return collect($value)->get('rating_education_reason');
    }

    public function getSkillsRating(): ?int
    {
        $value = collect($this->result)->get('rating');
        if (! $value) {
            return null;
        }

        return collect($value)->get('rating_skills');
    }

    public function getSkillsRatingReason(): ?string
    {
        $value = collect($this->result)->get('rating');
        if (! $value) {
            return null;
        }

        return collect($value)->get('rating_skills_reason');
    }

    public function getExperienceRating(): ?int
    {
        $value = collect($this->result)->get('rating');
        if (! $value) {
            return null;
        }

        return collect($value)->get('rating_experience');
    }

    public function getExperienceRatingReason(): ?string
    {
        $value = collect($this->result)->get('rating');
        if (! $value) {
            return null;
        }

        return collect($value)->get('rating_experience_reason');
    }

    public function getSkillsRatingLabel(): string
    {
        $ratingNumber = $this->getSkillsRating();

        $ratings = [
            0 => 'N/A: Skill requirements are not specified in the job description.',
            1 => 'Poor Fit: The candidate lacks many of the essential skills required for the role.',
            2 => 'Below Average Fit: The candidate possesses some of the required skills but is missing several key skills necessary for the role.',
            3 => 'Average Fit: The candidate mostly possesses the required skills, with a few areas for improvement.',
            4 => 'Strong Fit: The candidate’s skills match the job requirements well.',
            5 => 'Exceptional Fit: The candidate possesses a high level of proficiency in the required skills and brings additional specialized skills that exceed the job requirements.',
        ];

        if ($ratingNumber !== null) {
            return $ratings[$ratingNumber] ?? 'Unknown Rating';
        } else {
            return 'No Rating Available';
        }
    }

    public function getEducationRatingLabel(): string
    {
        $ratingNumber = $this->getEducationRating();

        $ratings = [
            0 => 'N/A: Education requirements are not specified in the job description.',
            1 => 'Poor Fit: The candidate’s education level is significantly below the job’s requirements.',
            2 => 'Below Average Fit: The candidate’s education level somewhat meets the requirements but lacks in areas critical to the role.',
            3 => 'Average Fit: The candidate mostly meets the education requirements, with minor gaps.',
            4 => 'Strong Fit: The candidate’s education level matches the job requirements well.',
            5 => 'Exceptional Fit: The candidate’s education level exceeds the job requirements, bringing additional relevant knowledge or credentials that could benefit the role.',
        ];

        if ($ratingNumber !== null) {
            return $ratings[$ratingNumber] ?? 'Unknown Rating';
        } else {
            return 'No Rating Available';
        }
    }

    public function getExperienceRatingLabel(): string
    {
        $ratingNumber = $this->getExperienceRating();

        $ratings = [
            0 => 'N/A: Experience requirements are not specified in the job description.',
            1 => 'Poor Fit: The candidate’s experience is significantly below the requirements for the position.',
            2 => 'Below Average Fit: The candidate has some relevant experience but falls short of the role’s requirements.',
            3 => 'Average Fit: The candidate’s experience mostly aligns with the job requirements, though some areas lack depth.',
            4 => 'Strong Fit: The candidate’s experience aligns well with the job requirements.',
            5 => 'Exceptional Fit: The candidate’s experience surpasses the requirements, demonstrating a higher level of responsibility, achievements, or specialized expertise that is directly relevant to the job.',
        ];

        if ($ratingNumber !== null) {
            return $ratings[$ratingNumber] ?? 'Unknown Rating';
        } else {
            return 'No Rating Available';
        }
    }
}
