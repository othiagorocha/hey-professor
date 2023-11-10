<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('should be able to create a new question bigger than 255 characters', function () {
  // Arrange
  $user = User::factory()->create();
  actingAs($user);
  // Act
  $request = post(route('question.store'), [
    'question' => str_repeat('*', 260) . '?',
  ]);
  // Assert
  $request->assertRedirect(route('dashboard'));
  assertDatabaseCount('questions', 1);
  assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

it('should check if ends with question mark?', function () {
  expect(true)->toBeTruthy();
});

it('should have at least 10 characters', function () {
  expect(true)->toBeTruthy();
});