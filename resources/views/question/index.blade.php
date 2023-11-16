<x-app-layout>
  <x-slot name="header">
    <x-header>
      {{ __('My Questions') }}
    </x-header>
  </x-slot>

  <x-container>
    <x-form :action="route('question.store')">
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

    {{-- Drafts --}}
    <div class="dark:text-gray-300 uppercase mb-3 font-bold">
      My Drafts
    </div>

    <div class="dark:text-gray-400 space-y-4">
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
                  :action="route('question.publish', $question)"
                  put
                >
                  <button
                    type="submit"
                    class="hover:underline w-fit text-blue-500"
                  >
                    Publish
                  </button>
                </x-form>
                <x-form
                  :action="route('question.destroy', $question)"
                  delete
                >
                  <button
                    type="submit"
                    class="hover:underline text-red-500 w-fit"
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
    <hr class="border-gray-700 my-4 border-dashed">

    {{-- Questions --}}
    <div class="dark:text-gray-300 uppercase mb-3 font-bold">
      My Questions
    </div>

    <div class="dark:text-gray-400 space-y-4">
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
                  :action="route('question.destroy', $question)"
                  delete
                >
                  <button
                    type="submit"
                    class="hover:underline text-red-500 w-fit"
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

  </x-container>

</x-app-layout>
