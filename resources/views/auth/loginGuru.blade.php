<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="relative">
        <img src="https://images.pexels.com/photos/3747463/pexels-photo-3747463.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" class="absolute inset-0 object-cover w-full h-full" alt="" />
        <div class="relative bg-gray-900 bg-opacity-75 min-h-screen">
          <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="flex flex-col items-center justify-between xl:flex-row">
              <div class="w-full max-w-xl mb-8 xl:mb-0 xl:pr-16 xl:w-7/12">
                <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-white sm:text-4xl sm:leading-none">
                  The quick, brown fox <br class="hidden md:block" />
                  jumps over a <span class="text-teal-accent-400">lazy dog</span>
                </h2>
                <p class="max-w-xl mb-4 text-base text-gray-400 md:text-lg">
                  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan, totam rem aperiam, eaque ipsa quae.
                </p>
              </div>
              <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
                <div class="bg-white rounded shadow-2xl p-7 sm:p-10">
                  <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                    LOGIN GURU
                  </h3>
                  <form action="{{ route('loginGuruProcess') }}" method="POST">
                    @csrf
                    <div class="mb-1 sm:mb-2">
                      <label for="username" class="inline-block mb-1 font-medium">Username</label>
                      <input
                        placeholder="Masukkan Username"
                        required=""
                        type="text"
                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-blue-400 focus:outline-none focus:shadow-outline"
                        id="username"
                        name="username"
                      />
                    </div>
                    <div class="mb-1 sm:mb-2">
                      <label for="password" class="inline-block mb-1 font-medium">Password</label>
                      <input
                        placeholder="Masukkan Password"
                        required=""
                        type="passwordwwwwww"
                        class="flex-grow w-full h-12 px-4 mb-2 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none focus:border-blue-400 focus:outline-none focus:shadow-outline"
                        id="password"
                        name="password"
                      />
                    </div>
                    <div class="mt-4 mb-2 sm:mb-4">
                      <button
                        type="submit"
                        class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-blue-600 hover:bg-blue-700 focus:shadow-outline focus:outline-none"
                      >
                        Login
                      </button>
                    </div>
                    <p class="text-xs text-gray-600 sm:text-sm">
                      Beriman, Berkarya, Berprestasi!
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
</html>