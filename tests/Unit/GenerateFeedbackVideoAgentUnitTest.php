<?php

use IanRothmann\AINinja\AINinja;

it('can run an agent to make a feedback video', function () {
    $handler = new AINinja;

    $result = $handler->agent()
        ->generateFeedbackVideo()
        ->withPersonContext("A candidate is completing an online assessment called 'Future+ Assessment' in a project called 'Aurora Finance Graduate Development Programme' for a client called 'Zenith Consulting Group'.\nThe candidate details are:\nName: Elias Verhoeven\nAge: 26\nGender: Male\nCountry: South Africa\nJob History:\n\nQualifications:\n\n\nThe following additional information is available about the assessment context:\n\nAssessment Use-case: Recruiting graduates for intake\nIndustry: Financial Consulting and Advisory\nJob Role: Financial and Investment Analyst")
        ->withTaskIntroContent("A personal introduction (elevator pitch) was recorded by a candidate (and transcribed) during an online assessment.")
        ->addTaskInstruction("Provide a positive, uplifting, and developmental piece of feedback on the candidate’s elevator pitch.")
        ->addTaskInstruction("Focus mainly on the candidate's response and use the assessment context and personality as background.")
        ->addTaskInstruction("What makes a short and impactful personal introduction in this context?")
        ->addTaskInstruction("Outline positive highlights of the candidate's personal introduction.")
        ->addTaskInstruction("Provide constructive suggestions for improvement based on the candidate's response.")
        ->addAdditionalContext("Results of personality preferences are as follows: Elias’s psychometric profile suggests a balanced blend of creativity and practicality, shown through his comfort with new ideas that can be practically executed. His strong drive for achieving results, coupled with his structured approach, indicates he is likely to excel in roles requiring precision and methodical problem-solving.\n\nHe may take time to warm up in new settings, but his moderate trust and optimism indicate he can form meaningful relationships and maintain a positive outlook. His moderate gregariousness suggests he enjoys social interaction but also values independence — useful in roles needing both teamwork and solo focus.\n\nElias shows diligence and composure, handles pressure well, and is meticulous. This aligns well with high-stakes financial environments. A slightly lower benevolence score may mean he's more task-oriented than people-oriented, which could be a development area for highly interpersonal roles.\n\nOverall, Elias is well-suited to analytical, structured roles balancing independent and collaborative work, especially in dynamic, complex environments.")
        ->additionalContextDescribedBy("A summary of the candidate's personality preferences (as measured through a psychometric personality tool) for background.")
        ->onPrimaryContent("Hi there. My name is Elias Verhoeven and I recently graduated from the University of Cape Town with a BCom Honours in Business Finance. I have a real passion for finance, and I'm excited about applying the knowledge I've gained as a student to real-world scenarios. As someone who loves to learn, I’ve decided to pursue the Polaris CFA Programme with the goal of becoming a charter holder, as I believe it will strengthen my financial expertise. I'm technically inclined with experience using coding languages such as R, Java, Python, VBA, and SQL. I’m also confident in using Excel, which I see as essential in most corporate environments. I consider myself an analytical thinker, committed to producing high-quality work and achieving set goals. Above all, I’m a motivated individual who takes pride in continuous improvement, and I look forward to growing alongside a dynamic organization.")
        ->primaryContentDescribedBy("The candidate is responding with a recorded video to the following question:\nIntroduce yourself as a professional, tell us how you developed your career and describe your personal and leadership brand.\nGiven the following information:\n- Let's launch your journey with an elevator pitch. Introduce yourself as a professional, describe your career path, and articulate your personal and leadership brand. Imagine you're on an elevator sharing this with a new colleague. Keep it short and impactful (2-3 mins).")
        ->videoTypeIsShort()
        ->runAndWait(3);


    expect($result->getFeedback())->not()->toBeEmpty();
    expect($result->getScript())->not()->toBeEmpty();
});
