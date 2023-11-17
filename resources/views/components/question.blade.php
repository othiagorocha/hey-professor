@props(['question'])

<div
  class="flex items-center justify-between rounded p-3 text-gray-200 shadow shadow-blue-500/50 dark:bg-gray-800/50">
  <span
    class="text-gray-800 dark:text-gray-200">{{ $question->question }}</span>
  <div>
    <x-form
      :action="route('question.like', $question)"
      id="form-like-{{ $question->id }}">
      <button class="flex items-start gap-1 text-emerald-500">
        <x-icons.thumbs-up
          class="h-5 w-5 transition-colors hover:text-emerald-400"
          id="thumbs-up" />
        <span>{{ $question->votes_sum_like ?: 0 }}</span>
      </button>
    </x-form>
    <x-form :action="route('question.unlike', $question)">
      <button class="flex items-end gap-1 text-red-500">
        <x-icons.thumbs-down
          class="h-5 w-5 transition-colors hover:text-red-400"
          id="thumbs-down" />
        <span>{{ $question->votes_sum_unlike ?: 0 }}</span>
      </button>
    </x-form>
  </div>
</div>
