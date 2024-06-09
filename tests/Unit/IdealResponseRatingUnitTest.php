<?php

use IanRothmann\AINinja\AINinja;

it('can generate a ideal response rating', function () {
    $handler = new AINinja();

    $result = $handler->generateIdealResponseRating()
        ->forJobDescription("Title:
      Data Scientist

      Summary:
      The Data Scientist is responsible for creating machine learning models and analytics solutions, including designing and implementing end-to-end cloud-based ML production pipelines, ensuring data quality, and developing predictive models for various business outcomes. Key tasks involve data acquisition, processing, model development, and analysis. Collaboration with cross-functional teams to deploy models and monitor their performance, as well as driving large-scale projects based on data insights, is also required. The role involves optimizing data model performance, development of databases and analytics strategies, trend analysis, and maintaining a testing framework for model quality.

      Requirements:
      Master's degree in Computer Science, Statistics, Applied Math, or related field; 3-5 years of experience in data manipulation and statistical model building; proficiency in statistical analysis, quantitative analytics, and optimization algorithms; experience with ML frameworks and libraries; strong programming skills, including SQL, Python, TensorFlow, and C/C++; familiarity with distributed data/computing tools; adept at large dataset manipulation; expertise in data visualization tools; excellent communication, a drive for continuous learning, ability to work in a fast-paced environment, strong project management, organizational skills; understanding of design principles; experience in data architecture; proven use of ML and AI to drive business results.")
        ->withCandidateContext("Title: Data Scientist

      Summary:
      The Data Scientist role is pivotal in crafting machine learning models and analytics solutions that have a profound impact on business outcomes. This role encompasses the design and implementation of cloud-based ML production pipelines, ensuring data quality, and developing predictive models to inform strategic decisions. Key responsibilities include data acquisition, processing, model development, and in-depth analysis. The position demands close collaboration with cross-functional teams to deploy models effectively and monitor their performance, as well as leading large-scale projects that leverage data insights to address complex business challenges. Responsibilities also include optimizing data model performance, developing databases and analytics strategies, conducting trend analysis, and upholding a strict model quality testing framework.

      Ideal candidates should hold a Master's degree in Computer Science, Statistics, Applied Math, or a related field, with 3-5 years of experience in data manipulation and statistical model building. Essential skills encompass proficiency in statistical analysis, quantitative analytics, optimization algorithms, and experience with ML frameworks and libraries. Strong programming skills in SQL, Python, TensorFlow, and C/C++ are essential, along with familiarity with distributed data/computing tools. The role also requires expertise in data visualization tools, excellent communication skills, a dedication to continuous learning, and the ability to excel in a fast-paced environment. Strong project management and organizational skills, an understanding of design principles, experience in data architecture, and a proven track record of applying ML and AI to drive business results are also critical.

      Ian Rothmann, with his 15 years of experience in developing AI and machine learning solutions, stands out as an exemplary candidate for this role. His commitment to applying these solutions in practical, value-adding ways to organizations highlights his strong candidacy and potential to make a significant contribution to business success. Ian's approach to challenges, such as improving underperforming predictive models by gathering more data, trying different models, and persisting in his efforts, showcases his problem-solving skills and dedication to achieving desired outcomes. His insight into utilizing data visualization, as demonstrated by his innovative approach to representing complex systems through artistic and functional imagery, further underscores his ability to convey intricate data in accessible and impactful ways, enhancing decision-making processes and project outcomes. Ian's preference for GPT-4 as the superior LLM for tasks indicates his up-to-date knowledge and expertise in the field, ensuring that he remains at the forefront of technological advancements in AI and machine learning.")
        ->forQuestion('How would you handle a situation where your predictive model is not delivering the desired outcomes?')
        ->whereIdealAnswerIs("When faced with a model's poor performance, the candidate would first diagnose the issue by evaluating the model's assumptions, data quality, and feature selection, then iterate on the model by incorporating new data, adjusting hyperparameters, or trying alternative modeling techniques. They would also communicate these challenges and remediation steps to stakeholders effectively.")
        ->whereCandidateAnswerIs("Ian Rothmann responded to a question about handling a predictive model that isn't delivering desired outcomes by saying that he would initially request the model to improve its performance humorously. If that fails, he would then gather more data, try different models, and persist with the process. Regarding the specific steps to diagnose the model's issues and how to communicate these to stakeholders, he emphasized the importance of communication, though he didn't provide detailed steps.")
        ->get();

    expect($result->getScore())->toBeInt()
        ->and($result->getReason())->toBeString();
});
