<x-app-layout>
  <x-slot name="header">
    <x-header>
      {{ __('My Questions') }}
    </x-header>
  </x-slot>

  <x-container>
    <x-form :action="route('question.store')">
      <x-textarea
        name="question"
        label="Question"
      />
      <div class="flex gap-1">
        <x-btn.primary>Save</x-btn.primary>
        <x-btn.reset type="reset">Cancel</x-btn.reset>
      </div>
    </x-form>

    <hr class="my-4 border-dashed border-gray-700">

    {{-- Drafts --}}
    <div class="mb-3 font-bold uppercase dark:text-gray-300">
      My Drafts
    </div>

    <div class="space-y-4 dark:text-gray-400">
      <x-table>
        <x-table.thead>
          <tr>
            <x-table.th>Questions</x-table.th>
            <x-table.th>Actions</x-table.th>
          </tr>
        </x-table.thead>
        <tbody>
          @foreach ($questions->where('draft', true) as $question)
            <x-table.tr>
              <x-table.td>{{ $question->question }}</x-table.td>
              <x-table.td>
                <x-form
                  :action="route('question.destroy', $question)"
                  delete
                  onsubmit="return confirm('Are you sure you want to delete this draft?')"
                >
                  <button
                    class="w-fit text-red-500 hover:underline"
                    type="submit"
                  >
                    Delete
                  </button>
                </x-form>

                <x-form
                  :action="route('question.publish', $question)"
                  put
                >
                  <button
                    class="w-fit text-blue-500 hover:underline"
                    type="submit"
                  >
                    Publish
                  </button>
                </x-form>
                <a href="{{ route('question.edit', $question) }}">
                  Editar
                </a>
              </x-table.td>
            </x-table.tr>
          @endforeach
        </tbody>
      </x-table>
    </div>
    <hr class="my-4 border-dashed border-gray-700">

    {{-- Questions --}}
    <div class="mb-3 font-bold uppercase dark:text-gray-300">
      My Questions
    </div>

    <div class="space-y-4 dark:text-gray-400">
      <x-table>
        <x-table.thead>
          <tr>
            <x-table.th>Questions</x-table.th>
            <x-table.th>Actions</x-table.th>
          </tr>
        </x-table.thead>

        <tbody>
          @foreach ($questions->where('draft', false) as $question)
            <x-table.tr>
              <x-table.td>{{ $question->question }}</x-table.td>
              <x-table.td>
                <x-form
                  :action="route('question.archive', $question)"
                  patch
                >
                  <button
                    class="w-fit text-blue-500 hover:underline"
                    type="submit"
                  >
                    Archive
                  </button>
                </x-form>
                <x-form
                  :action="route('question.destroy', $question)"
                  delete
                  onsubmit="return confirm('Are you sure you want to delete this question?')"
                >
                  <button
                    class="w-fit text-red-500 hover:underline"
                    type="submit"
                  >
                    Delete
                  </button>
                </x-form>

              </x-table.td>

            </x-table.tr>
          @endforeach
        </tbody>
      </x-table>
    </div>
    <hr class="my-4 border-dashed border-gray-700">

    {{-- Archived Questions --}}
    <div class="mb-3 mt-8 font-bold uppercase dark:text-gray-300">
      Archived Questions
    </div>

    <div class="space-y-4 dark:text-gray-400">
      <x-table>
        <x-table.thead>
          <tr>
            <x-table.th>Questions</x-table.th>
            <x-table.th>Actions</x-table.th>
          </tr>
        </x-table.thead>

        <tbody>
          @foreach ($archivedQuestions->where('draft', false) as $question)
            <x-table.tr>
              <x-table.td>{{ $question->question }}</x-table.td>
              <x-table.td>
                <x-form
                  :action="route('question.restore', $question)"
                  patch
                >
                  <button
                    class="w-fit text-red-500 hover:underline"
                    type="submit"
                  >
                    Restore
                  </button>
                </x-form>

              </x-table.td>

            </x-table.tr>
          @endforeach
        </tbody>
      </x-table>
    </div>

  </x-container>

</x-app-layout>
