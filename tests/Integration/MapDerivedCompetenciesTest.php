<?php

use IanRothmann\AINinja\AINinja;

it('extract competencies from text', function () {
    $handler = new AINinja;

    $derivedJson = <<<'TOC'
[
  {
    "name": "Inspiring",
    "description": "Empowering others by setting a positive example, creating a compelling vision, and encouraging them to achieve their full potential.",
    "id": "inspiring"
  },
  {
    "name": "Purpose Creation",
    "description": "Defining and articulating a clear mission that aligns individual and organizational goals, driving collective motivation.",
    "id": "purpose_creation"
  },
  {
    "name": "Promoting Flexibility",
    "description": "Encouraging adaptability and responsiveness to change, fostering an environment where new ideas and approaches are welcomed.",
    "id": "promoting_flexibility"
  },
  {
    "name": "Cultivating Diverse Talent",
    "description": "Building a diverse and inclusive workforce by recognizing and nurturing unique skills, perspectives, and backgrounds.",
    "id": "cultivating_diverse_talent"
  },
  {
    "name": "Persuasion",
    "description": "Effectively influencing and guiding others towards a shared goal through clear communication and strong interpersonal skills.",
    "id": "persuasion"
  },
  {
    "name": "Teamwork",
    "description": "Collaborating with others to achieve common objectives, fostering a sense of unity and collective responsibility.",
    "id": "teamwork"
  },
  {
    "name": "Achieving Outcomes",
    "description": "Focusing on delivering tangible results by setting clear goals, overcoming obstacles, and maintaining a results-oriented mindset.",
    "id": "achieving_outcomes"
  },
  {
    "name": "Business Growth",
    "description": "Driving the organization forward by identifying new opportunities, expanding markets, and enhancing overall business performance.",
    "id": "business_growth"
  }
]
TOC;

    $mappingJson = <<<'TOC'
[
  {
    "id": "team_collaboration",
    "name": "Team Collaboration",
    "description": "Effectively engages with team members and coordinates with various stakeholders."
  },
  {
    "id": "impactful_communication",
    "name": "Impactful Communication",
    "description": "Delivers messages with passion, clarity, and influence to ensure understanding."
  },
  {
    "id": "relationship_building",
    "name": "Relationship Building",
    "description": "Establishes enduring, positive connections with diverse stakeholders."
  },
  {
    "id": "organizing_and_planning",
    "name": "Organizing and Planning",
    "description": "Implements processes and efficiently allocates resources to achieve objectives."
  },
  {
    "id": "data_analysis",
    "name": "Data Analysis",
    "description": "Examines information to identify trends and pinpoint issues."
  },
  {
    "id": "resource_management",
    "name": "Resource Management",
    "description": "Optimizes the use of resources to successfully accomplish tasks."
  },
  {
    "id": "lifelong_learning",
    "name": "Lifelong Learning",
    "description": "Continuously acquires new skills and knowledge to foster personal growth."
  },
  {
    "id": "result_oriented",
    "name": "Result-Oriented",
    "description": "Sets ambitious goals and consistently achieves them."
  },
  {
    "id": "critical_decision_making",
    "name": "Critical Decision Making",
    "description": "Evaluates all aspects and uses logical thinking to make informed decisions."
  },
  {
    "id": "pressure_management",
    "name": "Pressure Management",
    "description": "Maintains composure and efficiency under tight deadlines and stress."
  },
  {
    "id": "quality_focus",
    "name": "Quality Focus",
    "description": "Prioritizes high standards and pays attention to detail in all tasks."
  },
  {
    "id": "performance_management",
    "name": "Performance Management",
    "description": "Establishes performance benchmarks, defines key metrics, and guides teams to success."
  },
  {
    "id": "process_implementation",
    "name": "Process Implementation",
    "description": "Designs and oversees standardized procedures to achieve superior results."
  },
  {
    "id": "conflict_resolution",
    "name": "Conflict Resolution",
    "description": "Navigates tough conversations and effectively resolves conflicts."
  },
  {
    "id": "innovation_driving",
    "name": "Innovation Driving",
    "description": "Introduces new ideas and implements creative solutions to challenges."
  },
  {
    "id": "customer_centric",
    "name": "Customer-Centric",
    "description": "Prioritizes customer needs, delivering on expectations and exceeding them."
  },
  {
    "id": "commercial_acumen",
    "name": "Commercial Acumen",
    "description": "Applies strategic thinking to identify opportunities and grow the business."
  },
  {
    "id": "team_empowerment",
    "name": "Team Empowerment",
    "description": "Delegates responsibilities, supports growth, and enhances team capabilities."
  },
  {
    "id": "relationship_networking",
    "name": "Relationship Networking",
    "description": "Builds lasting relationships with a diverse array of stakeholders."
  },
  {
    "id": "persuasive_influence",
    "name": "Persuasive Influence",
    "description": "Negotiates effectively and shapes outcomes through strategic influence."
  },
  {
    "id": "talent_development",
    "name": "Talent Development",
    "description": "Mentors and guides individuals to reach their full potential."
  },
  {
    "id": "analytics_skills",
    "name": "Analytics Skills",
    "description": "Utilizes data-driven insights to solve problems and enhance efficiency."
  },
  {
    "id": "change_leadership",
    "name": "Change Leadership",
    "description": "Anticipates and manages change by minimizing risks and maximizing resources."
  },
  {
    "id": "strategic_visioning",
    "name": "Strategic Visioning",
    "description": "Plans for the future with a long-term perspective, considering broader trends."
  },
  {
    "id": "ambiguity_navigation",
    "name": "Ambiguity Navigation",
    "description": "Effectively operates in uncertain environments and delivers results."
  },
  {
    "id": "agile_learning",
    "name": "Agile Learning",
    "description": "Quickly acquires new skills and knowledge, remaining open to continuous learning."
  },
  {
    "id": "complex_problem_solving",
    "name": "Complex Problem Solving",
    "description": "Breaks down complex issues and develops systematic approaches to resolve them."
  },
  {
    "id": "digital_proficiency",
    "name": "Digital Proficiency",
    "description": "Leverages digital tools and technology to streamline operations and boost efficiency."
  }
]
TOC;

    $derived = json_decode($derivedJson, true);
    $mapping = json_decode($mappingJson, true);

    $obj = $handler->mapDerivedCompetencies();

    foreach ($derived as $competency) {
        $obj->addCompetency($competency['id'], $competency['name'], $competency['description']);
    }

    foreach ($mapping as $competency) {
        $obj->addMappingCompetency($competency['id'], $competency['name'], $competency['description']);
    }

    $result = $obj->get();

    expect($result->getMappings()->toArray())->not()->toBeEmpty();
});
