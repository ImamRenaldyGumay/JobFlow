<aside id="sidebar"
    class="fixed z-30 inset-y-0 left-0 w-64 h-screen bg-white shadow-lg flex flex-col transition-transform duration-200">
    <!-- Brand/Logo (fix di atas) -->
    <div class="flex items-center h-16 px-6 border-b-2 border-blue-100 mb-2 shrink-0">
        <span class="flex items-center gap-3">
            <span class="bg-blue-100 text-blue-600 rounded-full p-2"><i class="fa fa-briefcase fa-lg"></i></span>
            <span class="text-2xl font-extrabold text-blue-600 tracking-wide">JobFlow</span>
        </span>
        <button id="closeSidebar" class="ml-auto md:hidden text-gray-500 focus:outline-none"><i
                class="fa fa-times"></i></button>
    </div>
    <!-- Menu scrollable -->
    <div class="flex-1 overflow-y-auto">
        <nav class="px-4 py-6 space-y-2">
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-2 {{ request()->is('dashboard') ? 'bg-blue-600 text-white font-semibold shadow-md' : 'text-gray-700 hover:bg-blue-50' }} rounded-lg"><i
                    class="fa fa-th-large mr-3"></i>Dashboard</a>
            <!-- Jobs menu tanpa submenu -->
            <a href="{{ route('jobs.index') }}"
                class="flex items-center px-4 py-2 {{ request()->is('jobs*') ? 'bg-blue-600 text-white font-semibold shadow-md' : 'text-gray-700 hover:bg-blue-50' }} rounded-lg"><i
                    class="fa fa-briefcase mr-3"></i>Jobs</a>
            <a href="{{ route('tasks.index') }}"
                class="flex items-center px-4 py-2 {{ request()->is('tasks*') ? 'bg-blue-600 text-white font-semibold shadow-md' : 'text-gray-700 hover:bg-blue-50' }} rounded-lg"><i
                    class="fa fa-tasks mr-3"></i>Tasks</a>
            <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg"><i
                    class="fa fa-address-book mr-3"></i>Contacts</a>
            <a href="{{ route('calendar.index') }}"
                class="flex items-center px-4 py-2 {{ request()->is('calendar*') ? 'bg-blue-600 text-white font-semibold shadow-md' : 'text-gray-700 hover:bg-blue-50' }} rounded-lg"><i
                    class="fa fa-calendar-alt mr-3"></i>Calendar</a>
            <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg"><i
                    class="fa fa-sticky-note mr-3"></i>Notes</a>
            <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg"><i
                    class="fa fa-chart-line mr-3"></i>Analytics</a>
            <a href="#" id="settingsMenuBtn"
                class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg justify-between">
                <span><i class="fa fa-cog mr-3"></i>Settings</span>
                <svg id="settingsMenuArrow" class="w-4 h-4 ml-2 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
            <div id="settingsSubMenu" class="ml-8 mt-1 space-y-1 hidden">
                <a href="{{ route('profile.show') }}"
                    class="block px-2 py-1 text-gray-600 hover:text-blue-600">Profile</a>
                <a href="#" class="block px-2 py-1 text-gray-400 cursor-not-allowed">Account</a>
                <a href="#" class="block px-2 py-1 text-gray-400 cursor-not-allowed">Preferences</a>
            </div>
        </nav>
    </div>
    <div class="mt-auto px-4 py-4 border-t">
        <a href="#" class="flex items-center text-gray-500 hover:text-blue-600"><i
                class="fa fa-life-ring mr-2"></i>Support</a>
    </div>
</aside>
<script>
    // Sidebar submenu toggle for Jobs
    const jobsMenuBtn = document.getElementById('jobsMenuBtn');
    const jobsSubMenu = document.getElementById('jobsSubMenu');
    const jobsMenuArrow = document.getElementById('jobsMenuArrow');
    jobsMenuBtn && jobsMenuBtn.addEventListener('click', () => {
        jobsSubMenu.classList.toggle('hidden');
        jobsMenuArrow.classList.toggle('rotate-180');
    });
    // Sidebar submenu toggle for Settings
    const settingsMenuBtn = document.getElementById('settingsMenuBtn');
    const settingsSubMenu = document.getElementById('settingsSubMenu');
    const settingsMenuArrow = document.getElementById('settingsMenuArrow');
    settingsMenuBtn && settingsMenuBtn.addEventListener('click', () => {
        settingsSubMenu.classList.toggle('hidden');
        settingsMenuArrow.classList.toggle('rotate-180');
    });
</script>