
<?php

use IanRothmann\AINinja\AINinja;

it('can generate an Interview Report', function () {

    $transcript = [
        'Send us a video where you introduce yourself. Keep the video less than 30 seconds (to be answered as video)' => 'Ian Rothmann, a data scientist with 15 years of experience, introduced himself and highlighted his passion for applying AI and machine learning solutions in ways that add value to organizations. He also provided an example of a business problem he solved using his skills. He worked with a company to evaluate customer support calls in real-time, providing valuable developmental feedback to their support agency.',
        'Do you have experience in using machine learning and AI to drive business results? Please provide examples. (to be answered as text)' => 'Ian Rothmann confirmed that he has extensive experience in using machine learning and AI to drive business results, although he did not provide specific examples of such projects.',
        'How would you handle a situation where your predictive model is not delivering the desired outcomes? (to be answered as audio)' => "Ian Rothmann responded to a question about handling a predictive model that isn't delivering desired outcomes by saying that he would initially request the model to improve its performance humorously. If that fails, he would then gather more data, try different models, and persist with the process. Regarding the specific steps to diagnose the model's issues and how to communicate these to stakeholders, he emphasized the importance of communication, though he didn't provide detailed steps.",
        'Which LLM is better? (to be answered as option)' => 'GPT-4',
        'Share a research paper that was accepted for publication on which you are an author (to be answered as file)' => null,
    ];

    $requirements = <<<'TOC'
    Title:
    Data Scientist

    Summary:
    The Data Scientist is responsible for creating machine learning models and analytics solutions, including designing and implementing end-to-end cloud-based ML production pipelines, ensuring data quality, and developing predictive models for various business outcomes. Key tasks involve data acquisition, processing, model development, and analysis. Collaboration with cross-functional teams to deploy models and monitor their performance, as well as driving large-scale projects based on data insights, is also required. The role involves optimizing data model performance, development of databases and analytics strategies, trend analysis, and maintaining a testing framework for model quality.

    Requirements:
    Master's degree in Computer Science, Statistics, Applied Math, or related field; 3-5 years of experience in data manipulation and statistical model building; proficiency in statistical analysis, quantitative analytics, and optimization algorithms; experience with ML frameworks and libraries; strong programming skills, including SQL, Python, TensorFlow, and C/C++; familiarity with distributed data/computing tools; adept at large dataset manipulation; expertise in data visualization tools; excellent communication, a drive for continuous learning, ability to work in a fast-paced environment, strong project management, organizational skills; understanding of design principles; experience in data architecture; proven use of ML and AI to drive business results.
TOC;

    $handler = new AINinja();
    $result = $handler->writeInterviewReport()
        ->givenRequirements($requirements)
        ->withContext('The candidate is Ian Rothmann');

    foreach ($transcript as $question => $answer) {
        $result->givenQuestionAndAnswer($question, $answer);
    }

    $result = $result->get();

    expect($result->getResult())->toBeString();
});
