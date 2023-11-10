<x-app-layout>
  <x-slot name="header">
    <x-header>
      {{ __('Dashboard') }}
    </x-header>
  </x-slot>

  <x-container>
    <x-form
      post
      :action="route('question.store')"
    >
      <x-textarea
        label="Question"
        name="question"
      />
      <div class="flex gap-1">
        <x-btn.primary>Save</x-btn.primary>
        <x-btn.reset type="reset">Cancel</x-btn.reset>
      </div>
    </x-form>
  </x-container>


</x-app-layout>
