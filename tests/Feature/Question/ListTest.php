<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should list all the questions', function () {
    // Arrange - [criar algumas perguntas, criar usuário]
    $questions = Question::factory()->count(5)->create();
    $user      = User::factory()->create();

    // Act - [logar, acessar a rota]
    actingAs($user);
    $response = get(route('dashboard'));

    // Assert - Verificar se a lista de perguntas está sendo exibida
    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
