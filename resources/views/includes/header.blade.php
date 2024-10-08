<nav class="bg-brown-bg text-white shadow-md px-2 py-2.5 dark:bg-gray-800 sm:dark:bg-gray-800 dark:border-gray-700 z-50">
    <div class="flex flex-wrap justify-between items-center px-2">
        <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
            aria-controls="drawer-navigation"
            class="p-3 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-yellow-900 focus:bg-yellow-900 dark:focus:bg-gray-700 focus:ring-2 focus:ring-yellow-900 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <i class="fa-solid fa-bars text-gray-50"></i>
        </button>
        <div class="flex items-center">
            <img src="{{ asset('assets/img/stikom-logo.webp') }}" class="mr-3 hidden sm:block" alt="STIKOM Logo"
                width="48" height="48">

            <div class="flex flex-col">
                <span
                    class="self-center text-1xl md:text-xl hidden sm:block font-semibold whitespace-nowrap dark:text-white">STIKOM
                    22
                    Januari<br>

                </span>
                <p class="hidden text-sm md:text-xl font-semibold whitespace-nowrap dark:text-white">
                    Learning
                    Management System</p>
            </div>
        </div>


        <div class="flex items-center lg:order-2 gap-2">
            <button id="theme-toggle" type="button"
                class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2.5">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
            @auth
                <button type="button"
                    class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                    @php
                        $user = Auth::user();
                        $profileTypes = ['dosen', 'mahasiswa', 'admin'];
                        $fotoUrl = asset('assets/img/user.png'); // Default foto URL
                        $nama = 'Akun belum aktif.';
                        $username = '';
                        $role = '';
                        foreach ($profileTypes as $type) {
                            $profile = $user->{$type};
                            if ($profile && $profile->foto) {
                                $fotoUrl = Storage::url($profile->foto);
                                $nama = $profile->nama;
                                $username = $profile->user->username;
                                $role = $profile->user->role->nama_role;
                                break; // Stop checking once a foto is found
                            }
                        }

                    @endphp

                    <img class="w-8 h-8 rounded-full object-cover" src="{{ $fotoUrl }}" alt="User Foto">

                </button>
                <!-- Mini iProfile Menu -->
                {{-- w-52 --}}
                <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded rounded-md divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="dropdown">
                    <div class="py-3 px-4">
                        <span class="block text-sm font-semibold text-blue-500">{{ $nama }}</span>
                        <span class="block text-xs text-gray-900 dark:text-white">{{ $username }}</span>
                        <span class="block text-xs text-gray-900 dark:text-white">{{ $role }}</span>
                    </div>
                    <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                        <li>
                            <a href="{{ route('edit-profile') }}"
                                class="block py-2 px-4 text-sm hover:bg-gray-100 hover:font-bold dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white"><i
                                    class="fas fa-user mr-2"></i>
                                Profil
                            </a>
                        </li>
                    </ul>
                    <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                        <li>
                            <a href="/user/preferences"
                                class="block py-2 px-4 text-sm hover:bg-gray-100 hover:font-bold dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white"><i
                                    class="fas fa-cog mr-2"></i>
                                Pengaturan
                            </a>
                        </li>
                    </ul>

                    <ul class="text-gray-700 dark:text-gray-300 hover:bg-red-500 hover:rounded-b-md py-1"
                        aria-labelledby="dropdown">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button
                                    class="text-left py-1 w-full h-full text-sm py-2 px-4 hover:text-white hover:font-bold dark:hover:text-gray-100 dark:text-gray-400 dark:hover:text-white"
                                    type="submit"><i class="fas fa-sign-out-alt mr-2"></i>
                                    Logout</button>

                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
            @guest
                <a href="/login"><button type="button"
                        class="text-gray-900 bg-brown-button hover:bg-brown-10 hover:text-gray-900 dark:bg-blue-600 dark:text-gray-50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-gray-800"><i
                            class="fas fa-user mr-2"></i><span>Login</span>
                    </button></a>
            @endguest
        </div>
    </div>
</nav>
