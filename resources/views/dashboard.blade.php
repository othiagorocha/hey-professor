<x-app-layout>
  <x-slot name="header">
    <x-header>
      {{ __('Vote for a question') }}
    </x-header>
  </x-slot>

  <x-container>
    {{-- listagem --}}
    <div class="relative mb-4 flex flex-col justify-between">
      <p class="mb-1 font-bold uppercase dark:text-gray-300">
        List of questions
      </p>

      <form
        class="-right-2 -top-4 flex w-full flex-col items-start gap-3 p-0 sm:w-fit sm:flex-row md:absolute"
        action="{{ route('dashboard') }}"
        method="get">
        @csrf
        <x-text-input
          class="h-fit w-full rounded-md py-1.5 sm:w-[18.75rem]"
          type="text"
          name="search"
          value="{{ request()->search }}" />
        <x-btn.primary class="w-full py-2 sm:w-fit"
          type="submit">Search
        </x-btn.primary>
      </form>
    </div>

    <div class="space-y-4 dark:text-gray-400">

      @if ($questions->isEmpty())
        <div
          class="flex flex-col items-start justify-center gap-10 sm:items-center">
          <div>
            <x-draw.searching class="w-[220px] md:w-[350px]" />
          </div>
          <div class="flex w-full justify-center">
            <p class="font-bold dark:text-gray-400 sm:text-2xl">
              Question
              not found
            </p>
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
