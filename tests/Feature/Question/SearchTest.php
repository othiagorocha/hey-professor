<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should be able to search a question by text', function () {
    $user = User::factory()->create();
    Question::factory()->count(5)->create(['question' => 'Something else?']);
    Question::factory()->create(['question' => 'My question is?']);

    actingAs($user);

    $response = get(route('dashboard', ['search' => 'question']));

    $response->assertDontSee('Something else?');
    $response->assertSee('My question is?');
});
