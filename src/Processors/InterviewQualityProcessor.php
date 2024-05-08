<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaInterviewQualityResult;

class InterviewQualityProcessor extends AINinjaProcessor
{
    use OutputsInLanguage;

    protected function getEndpoint(): string
    {
        return '/assess_interview_quality';
    }

    protected function getResultClass(): string
    {
        return AINinjaInterviewQualityResult::class;
    }

    protected function getMocked(): array
    {
        return [
            'overall_rating' => 4,
            'overall_comments' => "The interview design is generally good, focusing on the candidate's experience and specialization, crucial for the role of a head barman at an upmarket cocktail restaurant in Dubai. The format allows for an in-depth understanding of the candidate's qualifications and expertise. However, it could benefit from a broader range of questions to cover additional relevant areas such as customer service skills, knowledge of health and safety protocols, and the ability to manage inventory.",
            'general_suggestions' => "To improve the interview, consider adding questions that explore the candidate's ability to handle customer service scenarios, their knowledge of health and safety regulations in a bar setting, and how they manage bar inventory and supplier relationships. Additionally, including a question that asks for a demonstration of creating a unique cocktail could provide insight into the candidate's creativity and expertise in mixology.",
            'additional_questions' => 'Suggested additional questions include: 1. Describe a challenging situation you faced with a customer and how you resolved it. Expected response: A detailed account of a specific customer service challenge and the steps taken to resolve it, demonstrating problem-solving skills and professionalism. Response format: audio. 2. How do you ensure compliance with health and safety regulations in your work? Expected response: Knowledge and application of health and safety regulations in a bartending environment, including specific measures taken to ensure a safe workplace. Response format: text. 3. Describe how you manage inventory and work with suppliers. Expected response: Strategies for inventory management, experience working with suppliers, and ensuring the bar is well-stocked without over-ordering. Response format: text. 4. Please record a brief video of you preparing your signature cocktail, explaining the process and ingredients. Expected response: A demonstration of preparing a signature cocktail, showcasing mixology skills and creativity. Response format: video.',
            'expected_response_comment' => 'The expected responses align well with the interview requirements, offering a balance between concise, text-based answers and more detailed, audio or video responses. However, for the question asking for a demonstration of a signature cocktail, a video response is more appropriate to visually capture the technique and presentation skills of the candidate.',
            'response_type_review' => "The response types are generally well-suited to the questions. Audio responses are appropriate for experience-related questions, allowing candidates to provide a comprehensive overview of their background without the constraint of typing. Text responses are suitable for questions about specialties, as these can be succinctly described. However, for the demonstration of cocktail preparation, a video response is more suitable than audio, providing a visual element that is essential for assessing the candidate's practical skills.",
        ];
    }

    public function forQuestions(array $questions): self
    {
        $this->setInputParameter('questions', $questions);

        return $this;
    }

    public function withRequirements(array $requirements): self
    {
        $this->setInputParameter('requirements', $requirements);

        return $this;
    }

    public function get(): AINinjaInterviewQualityResult
    {
        return parent::get();
    }

    public function stream($callback = null): AINinjaInterviewQualityResult
    {
        return parent::stream($callback);
    }
}
