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

    <hr class="border-gray-700 my-4 border-dashed">

    {{-- listagem --}}

    <div class="dark:text-gray-300 uppercase mb-1 font-bold">List of questions</div>

    <div class="dark:text-gray-400 space-y-4">
      @foreach ($questions as $item)
        <x-question :question="$item" />
      @endforeach
    </div>

  </x-container>

</x-app-layout>
