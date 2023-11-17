@props(['question'])

<div
  class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 text-gray-200 flex justify-between items-center">
  <span>{{ $question->question }}</span>
  <div>
    <x-form
      :action="route('question.like', $question)"
      id="form-like-{{ $question->id }}">
      <button class="flex items-start gap-1 text-emerald-500">
        <x-icons.thumbs-up
          class="w-5 h-5 hover:text-emerald-400 transition-colors"
          id="thumbs-up" />
        <span>{{ $question->votes_sum_like ?: 0 }}</span>
      </button>
    </x-form>
    <x-form :action="route('question.unlike', $question)">
      <button class="flex items-end gap-1 text-red-500">
        <x-icons.thumbs-down
          class="w-5 h-5 hover:text-red-400 transition-colors"
          id="thumbs-down" />
        <span>{{ $question->votes_sum_unlike ?: 0 }}</span>
      </button>
    </x-form>
  </div>
</div>
