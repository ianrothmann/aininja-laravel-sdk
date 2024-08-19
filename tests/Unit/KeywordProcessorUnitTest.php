<?php

use IanRothmann\AINinja\AINinja;

it('can extract keywords from text', function () {
    $handler = new AINinja;

    $result = $handler->extractKeywords()
        ->basedOn('The Data Scientist role is pivotal in crafting machine learning models and analytics solutions that have a profound
  impact on business outcomes. This role encompasses the design and implementation of cloud-based ML production
  pipelines, ensuring data quality, and developing predictive models to inform strategic decisions. Key responsibilities
  include data acquisition, processing, model development, and in-depth analysis. The position demands close
  collaboration with cross-functional teams to deploy models effectively and monitor their performance, as well as
  leading large-scale projects that leverage data insights to address complex business challenges. Responsibilities also
  include optimizing data model performance, developing databases and analytics strategies, conducting trend analysis,
  and upholding a strict model quality testing framework.')
        ->get();

    expect($result->getResult())->toBeArray();
});
