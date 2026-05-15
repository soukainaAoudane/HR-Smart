<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="text-xl font-bold">
                Dashboard Manager
            </h1>

            <h3>
                Bonjour {{ Auth::user()->name }} (Manager)
            </h3>

            <p>Bienvenue sur votre espace manager.</p>

        </div>
    </div>
</x-app-layout>
