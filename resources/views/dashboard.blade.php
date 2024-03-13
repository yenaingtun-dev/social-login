<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @isset($posts)
                        <div class="text-white my-3">
                            <a href="{{ route('posts.create') }}" class="bg-blue-500 p-1 text-sm rounded">create post</a>
                        </div>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-8">
                            @foreach ($posts as $post)
                                <div class="rounded-lg bg-gray-200">
                                    <article
                                        class="rounded-lg border border-gray-100 bg-gray-300 p-4 shadow-sm transition hover:shadow-lg sm:p-6">
                                        <a href="{{ route('posts.edit', $post['id']) }}">
                                            <h3 class="mt-0.5 text-lg font-medium text-gray-900">
                                                {{ $post['title'] }}
                                            </h3>
                                        </a>
                                        <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                                            {{ $post['description'] }}
                                        </p>
                                        <div class="mt-2">
                                            <form action="{{ route('posts.destory', $post['id']) }}" method="POST">
                                                @csrf
                                                <button class="bg-red-500 text-white text-sm p-1 rounded">delete</button>
                                            </form>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{ __("You're logged in!") }}
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
