<header class="w-full">
  <div class="max-w-2xl mx-auto px-4 py-4 flex justify-between items-center">
    <a href="{{ url('/') }}" class="text-xl font-semibold">Multi User Blog</a>
    <div class="flex items-center space-x-2">
      @if (Auth::check())
          {{-- Kalau sudah login --}}
          @if (request()->is('/'))
              {{-- Kalau user sedang di URL / --}}
              <a href="{{ route('dashboard') }}" 
                 class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                 Dashboard
              </a>
          @else
              {{-- Tampilkan Add Post hanya jika role user dan sudah punya minimal 1 post --}}
              @if(Auth::check() && Auth::user()->role === 'user' && $posts->count() > 0)
                <a href="{{ route('posts.create') }}" 
                class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                + Add Post
                </a>
              @endif
              {{-- Logout --}}
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                    Logout
                </button>
              </form>
          @endif
      @else
          {{-- Guest --}}
          @if (request()->routeIs('login','register'))
              <a href="{{ url('/') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Back
              </a>
          @else
              <a href="{{ route('login') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Login
              </a>
              <a href="{{ route('register') }}" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Register
              </a>
          @endif
      @endif
    </div>
  </div>
</header>