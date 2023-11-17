<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\put;

it('should be able to update a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);
    put(route('question.update', $question), [
        'question' => 'Is a updated question?',
    ])->assertRedirect();
    $question->refresh();
    expect($question)->question->toBe('Is a updated question?');
});

it('should make sure that only question with status DRAFT can be updated', function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $draftQuestion    = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $questionNotDraft))->assertForbidden();
    put(route('question.update', $draftQuestion), ['question' => 'Update question without "?"?'])->assertRedirect();
});

it('should make sure that only the person who has created the question can update the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    actingAs($wrongUser);
    put(route('question.update', $question))
      ->assertForbidden()
    ;

    actingAs($rightUser);
    put(route('question.update', $question), ['question' => 'Update question without "?"?'])
      ->assertRedirect()
    ;
});

it('should be able to update a new question bigger than 255 characters', function () {
    // Arrange :: preparar
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);

    // Act :: agir
    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 260).'?',
    ]);

    // Assert :: verificar
    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260).'?']);
});

it('should check if ends with question mark "?"', function () {
    // Arrange :: preparar
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);
    // Act :: agir
    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 10),
    ]);
    // Assert :: verificar
    $request->assertSessionHasErrors([
        'question' => 'Are you sure that is a question? It is missing the question mark in the end.',
    ]);

    assertDatabaseHas('questions', ['question' => $question->question]);
});

it('should have at least 10 characters', function () {
    // Arrange :: preparar
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);
    actingAs($user);
    // Act :: agir
    $request = put(route('question.update', $question), [
        'question' => str_repeat('*', 8).'?',
    ]);
    // Assert :: verificar
    $request->assertSessionHasErrors([
        'question' => __('validation.min.string', [
            'min'       => 10,
            'attribute' => 'question',
        ]),
    ]);

    assertDatabaseHas('questions', ['question' => $question->question]);
});
