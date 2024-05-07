<?php

use IanRothmann\AINinja\AINinja;

it('can generate interview questions', function () {
    $handler = new AINinja();

    $result = $handler->generateInterviewQuestions()
        ->basedOn("Title:
  Data Scientist
  Summary:
  The Data Scientist is responsible for creating machine learning models and analytics solutions, including designing
  and implementing end-to-end cloud-based ML production pipelines, ensuring data quality, and developing predictive
  models for various business outcomes. Key tasks involve data acquisition, processing, model development, and analysis.
  Collaboration with cross-functional teams to deploy models and monitor their performance, as well as driving
  large-scale projects based on data insights, is also required. The role involves optimizing data model performance,
  development of databases and analytics strategies, trend analysis, and maintaining a testing framework for model
  quality.
  Requirements:
  Master's degree in Computer Science, Statistics, Applied Math, or related field; 3-5 years of experience in data
  manipulation and statistical model building; proficiency in statistical analysis, quantitative analytics, and
  optimization algorithms; experience with ML frameworks and libraries; strong programming skills, including SQL,
  Python, TensorFlow, and C/C++; familiarity with distributed data/computing tools; adept at large dataset manipulation;
  expertise in data visualization tools; excellent communication, a drive for continuous learning, ability to work in a
  fast-paced environment, strong project management, organizational skills; understanding of design principles;
  experience in data architecture; proven use of ML and AI to drive business results.")
        ->get();

    expect($result->getQuestions())->toBeArray();
});
