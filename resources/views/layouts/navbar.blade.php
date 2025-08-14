<!-- resources/views/layouts/navbar.blade.php -->
<nav class="bg-white border-b border-gray-200 fixed w-full top-0 left-0 right-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
          <!-- Left Side -->
          <div class="flex items-center">
              <!-- Logo -->
              <div class="flex-shrink-0 flex items-center">
                  <a href="{{ route('dashboard') }}" class="flex items-center">
                      <img class="h-8 w-auto" src="{{ asset('img/logo.svg') }}" alt="Logo">
                      <span class="ml-2 text-xl font-bold text-gray-800">Your App</span>
                  </a>
              </div>

              
             

                  <!-- Dropdown Menu -->
                  <div id="userDropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">
                      <div class="py-1">
                          <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition ease-in-out duration-150">
                              <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                              </svg>
                              Profile
                          </a>
                          <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition ease-in-out duration-150">
                              <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                              Settings
                          </a>
                          <a href="#" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition ease-in-out duration-150">
                              <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                              </svg>
                              Activity Log
                          </a>
                      </div>
                      <div class="py-1">
                          <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button type="submit" class="w-full group flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50 transition ease-in-out duration-150">
                                  <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                  </svg>
                                  Logout
                              </button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="hidden md:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1">
          <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
              Dashboard
          </a>
          <!-- Add more mobile navigation items as needed -->
      </div>
  </div>
</nav>

<style>
/* Enhanced Styles */
.dropdown-animation {
  opacity: 0;
  transform: translateY(-10px);
  transition: all 0.2s ease-out;
}

.dropdown-animation.active {
  opacity: 1;
  transform: translateY(0);
}

/* Improve focus states */
.focus\:ring-offset-2:focus {
  --tw-ring-offset-width: 2px;
}

/* Add smooth transitions */
.transition {
  transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}

/* Mobile menu animation */
@keyframes slideDown {
  0% {
      opacity: 0;
      transform: translateY(-10px);
  }
  100% {
      opacity: 1;
      transform: translateY(0);
  }
}

#mobileMenu:not(.hidden) {
  animation: slideDown 0.3s ease-out;
}
</style>

<script>
// Enhanced JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
  const userDropdown = document.getElementById('userDropdown');
  const mobileMenu = document.getElementById('mobileMenu');
  
  function toggleUserMenu() {
      userDropdown.classList.toggle('hidden');
      if (!userDropdown.classList.contains('hidden')) {
          userDropdown.classList.add('dropdown-animation', 'active');
      } else {
          userDropdown.classList.remove('dropdown-animation', 'active');
      }
  }

  function toggleMobileMenu() {
      mobileMenu.classList.toggle('hidden');
  }

  // Close dropdowns when clicking outside
  document.addEventListener('click', function(event) {
      const userButton = event.target.closest('button');
      const mobileButton = event.target.closest('[onclick="toggleMobileMenu()"]');
      
      if (!userButton && !userDropdown.contains(event.target)) {
          userDropdown.classList.add('hidden');
          userDropdown.classList.remove('dropdown-animation', 'active');
      }
      
      if (!mobileButton && !mobileMenu.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
          mobileMenu.classList.add('hidden');
      }
  });

  // Close dropdowns on escape key
  document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
          userDropdown.classList.add('hidden');
          userDropdown.classList.remove('dropdown-animation', 'active');
          mobileMenu.classList.add('hidden');
      }
  });
});
</script>