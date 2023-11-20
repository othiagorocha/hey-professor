<x-app-layout>
  <x-slot name="header">
    <x-header>
      {{ __('Vote for a question') }}
    </x-header>
  </x-slot>

  <x-container>
    {{-- listagem --}}
    <div class="relative mb-4 flex justify-between">
      <p class="mb-1 font-bold uppercase dark:text-gray-300">
        List of questions
      </p>

      <form
        class="absolute -right-2 -top-4 flex w-fit items-start gap-3 p-0"
        action="{{ route('dashboard') }}"
        method="get">
        @csrf
        <x-text-input
          class="h-fit w-[18.75rem] rounded-md py-1.5"
          type="text"
          name="search"
          value="{{ request()->search }}" />
        <x-btn.primary class="py-2"
          type="submit">Search</x-btn.primary>
      </form>
    </div>

    <div class="space-y-4 dark:text-gray-400">

      @if ($questions->isEmpty())
        <div class="flex flex-col items-center justify-center gap-10">
          <div>
            <x-draw.searching width="350" />
          </div>
          <div>
            <div class="text-2xl font-bold dark:text-gray-400">
              Question
              not found
            </div>
          </div>
        </div>
      @else
        @foreach ($questions as $item)
          <x-question :question="$item" />
        @endforeach
      @endif

      {{ $questions->withQueryString()->links() }}
    </div>

  </x-container>

</x-app-layout>
