<x-app-layout>
    <x-slot name="header">
        <h2>Articles</h2>
        <a href="{{ route('articles.create') }}">+ Nouvel Article</a>
    </x-slot>

    <div>
        @if ($articles->isEmpty())
            <p>Vous n'avez pas encore d'articles.</p>
        @else
            <p>Vous avez des articles</p>
        @endif
    </div>
</x-app-layout>
