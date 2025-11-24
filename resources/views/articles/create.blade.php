<x-app-layout>
    <x-slot name="header">
        <h2>Créer un Article</h2>
    </x-slot>

    <div>
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Titre -->
            <x-input-label for="title" value="Titre" />
            <x-text-input id="title" name="title" type="text" autofocus />

            <!-- Image -->
            <x-input-label for="image" value="Image" />
            <x-text-input id="image" name="image" type="file" />

            <!-- Contenu -->
            <x-input-label for="content" value="Contenu" />
            <textarea id="content" name="content"></textarea>

            <!-- Button pour publier l'article -->
            <x-primary-button>Publier l'article</x-primary-button>
        </form>
    </div>
</x-app-layout>
