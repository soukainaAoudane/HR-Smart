<nav class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </div>

            <!-- User -->
            <div class="flex items-center gap-4">

                <span>
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

</nav>
