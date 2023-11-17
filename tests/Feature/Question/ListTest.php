<?php

use App\Models\Question;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

it('should paginate the result', function () {
    $user      = User::factory()->create();
    $questions = Question::factory()->count(20)->create();

    actingAs($user);
    get(route('dashboard'))
      ->assertViewHas('questions', fn ($value) => $value instanceof LengthAwarePaginator)
    ;
});
