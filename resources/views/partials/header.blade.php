<header class="flex items-center justify-between bg-white h-16 px-4 md:px-8 shadow sticky top-0 z-10">
    <div class="flex items-center space-x-4">
        <button id="openSidebar" class="text-gray-500 focus:outline-none md:hidden"><i class="fa fa-bars"></i></button>
        <div class="flex flex-col">
            <div id="currentDateTime" class="text-sm text-gray-500"></div>
        </div>
    </div>
    <div class="flex items-center space-x-4">
        <!-- Search Icon -->
        <button id="searchToggleBtn"
            class="relative flex items-center justify-center w-10 h-10 rounded-lg hover:bg-blue-100 focus:outline-none transition-colors duration-200">
            <svg id="searchIcon" class="w-6 h-6 text-gray-500 group-hover:text-blue-600" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
            </svg>
        </button>
        <button class="relative text-gray-500 hover:text-blue-600"><i class="fa fa-bell"></i><span
                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1">3</span></button>
        <button class="relative text-gray-500 hover:text-blue-600"><i class="fa fa-envelope"></i><span
                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1">4</span></button>
        <!-- User Dropdown -->
        <div class="flex items-center space-x-2 relative" id="userDropdownWrapper">
            <div id="userDropdownBtn"
                class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 font-bold text-lg cursor-pointer relative overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff"
                    alt="User Avatar" class="w-8 h-8 object-cover rounded-full">
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-white rounded-full flex items-center justify-center">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                </span>
            </div>
            <div class="hidden sm:block cursor-pointer" id="userDropdownBtnText">
                <div class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-400">{{ Auth::user()->role ?? 'User' }}</div>
            </div>
            <svg id="userDropdownArrow"
                class="w-4 h-4 ml-1 text-gray-400 cursor-pointer transition-transform duration-200" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <!-- Dropdown -->
            <div id="userDropdownMenu"
                class="absolute right-0 top-12 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50 hidden">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Setting</a>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 flex items-center justify-between">
                        Sign Out <i class="fa fa-sign-out-alt ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
<!-- Search Bar Overlay -->
<div id="searchBarWrapper" class="w-full flex justify-center mt-4 hidden">
    <div class="w-full max-w-xl bg-white rounded-xl shadow-lg p-4 flex items-center">
        <svg class="w-6 h-6 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
        </svg>
        <input type="text"
            class="w-full border-0 focus:ring-0 text-gray-700 text-lg placeholder-gray-400 bg-transparent"
            placeholder="Type your keyword...">
    </div>
</div>
<script>
    // User dropdown
    const userDropdownBtn = document.getElementById('userDropdownBtn');
    const userDropdownBtnText = document.getElementById('userDropdownBtnText');
    const userDropdownArrow = document.getElementById('userDropdownArrow');
    const userDropdownMenu = document.getElementById('userDropdownMenu');
    const userDropdownWrapper = document.getElementById('userDropdownWrapper');
    function toggleUserDropdown() {
        userDropdownMenu.classList.toggle('hidden');
        userDropdownArrow.classList.toggle('rotate-180');
    }
    userDropdownBtn && userDropdownBtn.addEventListener('click', toggleUserDropdown);
    userDropdownBtnText && userDropdownBtnText.addEventListener('click', toggleUserDropdown);
    userDropdownArrow && userDropdownArrow.addEventListener('click', toggleUserDropdown);
    document.addEventListener('click', function (e) {
        if (!userDropdownWrapper.contains(e.target)) {
            userDropdownMenu.classList.add('hidden');
            userDropdownArrow.classList.remove('rotate-180');
        }
    });
    // Search bar toggle
    const searchToggleBtn = document.getElementById('searchToggleBtn');
    const searchBarWrapper = document.getElementById('searchBarWrapper');
    searchToggleBtn && searchToggleBtn.addEventListener('click', () => {
        searchBarWrapper.classList.toggle('hidden');
        searchToggleBtn.classList.toggle('bg-[#5C59E8]');
        document.getElementById('searchIcon').classList.toggle('text-white');
    });
    document.addEventListener('click', function (e) {
        if (!searchBarWrapper.contains(e.target) && !searchToggleBtn.contains(e.target)) {
            searchBarWrapper.classList.add('hidden');
            searchToggleBtn.classList.remove('bg-[#5C59E8]');
            document.getElementById('searchIcon').classList.remove('text-white');
        }
    });

    // Update current date and time
    function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
    }

    // Update time every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>