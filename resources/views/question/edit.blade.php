<x-app-layout>
  <x-slot name="header">
    <x-header>
      {{ __('Edit Question') }} :: {{ $question->id }}
    </x-header>
  </x-slot>

  <x-container>
    <x-form :action="route('question.update', $question)" put>
      <x-textarea label="Question" name="question" :value="$question->question" />
      <div class="flex gap-1">
        <x-btn.primary>Save</x-btn.primary>
        <x-btn.reset type="reset">Cancel</x-btn.reset>
      </div>
    </x-form>


  </x-container>

</x-app-layout>
