<?php
// u can say test() and u can say it()
it('belongs to an employer', function () {
    //AAA Arrange Act Assert
    //------------------------------------------------------------
    //Arranging (arrange the program to run)
    $employer = \App\Models\Employer::factory()->create();  // if it belongs to employer then we need an employer to perform this action
    $job = \App\Models\Job::factory()->create([             // We should have a job to perform action on it in the testing process..
        'employer_id' => $employer->id,                     // overriding the employer id 
    ]);
    //-------------------------------------------------------------     
    //-------------------------------------------------------------
    //Act       (perform some kind of action)
    $job->employer();
    //-------------------------------------------------------------
    //-------------------------------------------------------------
    //Assert    (what did u expect to happen as a result of that assertion)
    expect($job->employer->is($employer))->toBeTrue();  // we expect the employer by checking the passed in is method to be the current instance
});
//---------------------------------------------------------------------------------------
it('can have tags', function () {
    //AAA   Arrange Act Assert
    //-------------------------------------------------------------
    //Arranging (arrange the program to run)
    $job = \App\Models\Job::factory()->create();
    //-------------------------------------------------------------
    //-------------------------------------------------------------
    //Act       (perform some kind of action)
    $job->tag('Frontend');
    //-------------------------------------------------------------
    //-------------------------------------------------------------
    //Assert    (what did u expect to happen as a result of that assertion)
    expect($job->tags)->ToHaveCount(1); // expecting if our job has 1 tag
});
