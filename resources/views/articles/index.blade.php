<x-app-layout>
    <x-slot name="header">
        <h2>Articles</h2>
        <a href="{{ route('articles.create') }}">+ Nouvel Article</a>
    </x-slot>

    <div>
        @if ($articles->isEmpty())
            <p>Vous n'avez pas encore d'articles.</p>
        @else
            <div>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @foreach ($articles as $article)
                    <h3>
                        <a href="{{ route('articles.show', $article) }}">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p>Par {{ $article->user->name }} . {{ $article->created_at }}</p>
                    <p>{{ Str::limit($article->content, 100) }}</p>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
