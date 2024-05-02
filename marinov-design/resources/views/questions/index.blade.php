<x-app-layout>
    <div class="relative bg-white overflow-x-auto w-11/12 mx-auto border my-8">
        <div class="header text-left border-b w-full py-4 bg-gray-50">
            <h1 class="text-lg w-11/12 mx-auto text-gray-600">Questions</h1>
        </div>
        <div class="w-11/12 mx-auto mt-8">
            @foreach ($questions as $question)
                <div class="mb-4 p-4 border rounded">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $question->name }}</h2>
                            <p class="text-gray-600">{{ $question->email }}</p>
                        </div>
                        <div>
                            <div class="flex flex-col space-y-2" style="max-width: 250px; margin: auto;">
                                <form action="{{ route('questions.destroy', $question) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-400 hover:bg-red-600 py-2 px-5 rounded w-full">
                                        Delete
                                    </button>
                                </form>
                                <a href="{{ route('questions.edit', $question) }}" class="text-white bg-green-400 hover:bg-green-600 py-2 px-5 rounded block text-center w-full mt-3">
                                    Answer
                                </a>
                            </div>
                        </div>
                        
                        
                    </div>

                    <p class="mt-2">"{{ $question->question }}"</p>

                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
