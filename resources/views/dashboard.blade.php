<x-app-layout>
  <x-slot name="header">
    <x-header>
      {{ __('Vote for a question') }}
    </x-header>
  </x-slot>

  <x-container>
    {{-- listagem --}}

    <div class="mb-1 font-bold uppercase dark:text-gray-300">List of
      questions</div>

    <div class="space-y-4 dark:text-gray-400">
      @foreach ($questions as $item)
        <x-question :question="$item" />
      @endforeach

      {{ $questions->withQueryString()->links() }}
    </div>

  </x-container>

</x-app-layout>
