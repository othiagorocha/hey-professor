<x-app-layout>
  <x-slot name="header">
    <x-header>
      {{ __('Vote for a question') }}
    </x-header>
  </x-slot>

  <x-container>
    {{-- listagem --}}

    <div class="dark:text-gray-300 uppercase mb-1 font-bold">List of questions</div>

    <div class="dark:text-gray-400 space-y-4">
      @foreach ($questions as $item)
        <x-question :question="$item" />
      @endforeach
    </div>

  </x-container>

</x-app-layout>
