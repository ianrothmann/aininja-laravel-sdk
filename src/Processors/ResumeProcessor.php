<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaResumeAnalysisResult;

class ResumeProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/analyze_resume';
    }

    protected function getResultClass(): string
    {
        return AINinjaResumeAnalysisResult::class;
    }

    public function forUrl(string $url): self
    {
        $this->setInputParameter('url', $url);

        return $this;
    }

    public function rateOnJobDescription(string $jobDescription): self
    {
        $this->setInputParameter('job_description', $jobDescription);

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|url',
            'job_description' => 'sometimes|nullable|string',
        ];
    }

    public function get(): AINinjaResumeAnalysisResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaResumeAnalysisResult
    {
        return parent::stream($callback);
    }

    protected function getMocked(): mixed
    {
        return json_decode(<<<TOC
{
  "error": null,
  "is_resume": true,
  "name": "John W. Smith",
  "email": "jwsmith@colostate.edu",
  "mobile": "None",
  "overview": "John W. Smith is a highly qualified professional with a robust background in early childhood development and the care of special needs children and adults. He holds a BS in Early Childhood Development and a BA in Elementary Education from the University of Arkansas at Little Rock, where he achieved a commendable GPA of 3.4 overall, with higher GPAs in his specific fields of study. He has been recognized on both the Dean’s List and the Chancellor’s List. John’s career spans several years, with notable experience in both adult care and childcare settings. His adult care experience includes determining work placements for 150 special needs adult clients, maintaining client databases and records, coordinating monthly client contacts with local healthcare professionals, and managing a team of 25 volunteer workers. In the realm of childcare, John has coordinated service assignments for part-time counselors and client families, overseen daily activities and outings for 100 clients, and assisted families with financial and healthcare research. He has also supported teachers in managing classroom activities and overseeing student activities. His employment history includes roles as a Counseling Supervisor at The Wesley Center in Little Rock, Arkansas, a Client Specialist at Rainbow Special Care Center, and a Teacher’s Assistant at Cowell Elementary in Conway, Arkansas. John W. Smith’s extensive experience, educational background, and recognition for academic excellence make him a strong candidate for roles in early childhood development and special needs care.",
  "qualifications": {
    "qualifications": [
      {
        "qualification": "BS in Early Childhood Development",
        "institution": "University of Arkansas at Little Rock",
        "start_year": 1999,
        "obtained_year": "1999"
      },
      {
        "qualification": "BA in Elementary Education",
        "institution": "University of Arkansas at Little Rock",
        "start_year": 1998,
        "obtained_year": "1998"
      }
    ]
  },
  "job_history": {
    "job_assignments": [
      {
        "start_year": 1999,
        "end_year": "2002",
        "organization": "The Wesley Center",
        "role": "Counseling Supervisor"
      },
      {
        "start_year": 1997,
        "end_year": "1999",
        "organization": "Rainbow Special Care Center",
        "role": "Client Specialist"
      },
      {
        "start_year": 1996,
        "end_year": "1997",
        "organization": "Cowell Elementary",
        "role": "Teacher’s Assistant"
      }
    ]
  },
  "skills": {
    "skills": [
      {
        "name": "Work Placement"
      },
      {
        "name": "Database Management"
      },
      {
        "name": "Volunteer Management"
      },
      {
        "name": "Activity Planning"
      },
      {
        "name": "Financial Assistance"
      }
    ]
  },
  "rating": {
    "rating_education": 5,
    "rating_education_reason": "John W. Smith holds both a BS in Early Childhood Development and a BA in Elementary Education, which are highly relevant and exceed typical requirements for an early childhood development teacher role. His academic performance, including being on the Dean’s List and Chancellor’s List, further underscores his strong educational background.",
    "rating_skills": 4,
    "rating_skills_reason": "John possesses several key skills relevant to early childhood development, such as activity planning, volunteer management, and database management. While his skills are well-aligned, the job description does not specify additional skills that might be necessary, thus a rating of 4 is appropriate.",
    "rating_experience": 4,
    "rating_experience_reason": "John has extensive experience in both childcare and special needs care, including roles as a Counseling Supervisor, Client Specialist, and Teacher’s Assistant. His experience in managing activities for children and supporting teachers aligns well with the job requirements, making him a strong fit."
  }
}
TOC
        ,true);

    }
}
