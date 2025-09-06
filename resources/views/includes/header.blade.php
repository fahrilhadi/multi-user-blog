<header class="w-full">
  <div class="max-w-2xl mx-auto px-4 py-4 flex justify-between items-center">
    @if (request()->routeIs('dashboard'))
        <h1 class="text-xl font-semibold">Dashboard</h1>
    @else
        <h1 class="text-xl font-semibold">Multi User Blog</h1>
    @endif

    <div class="flex items-center space-x-2">
      @if (Auth::check())
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" 
                  class="px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition shadow">
                  Logout
              </button>
          </form>
      @else
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