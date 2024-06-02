<div id="log-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative rounded-lg shadow bg-gray-700 border-white border">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Log in to our platform
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                    data-modal-hide="log-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="partials/_l-handler.php" method="post">
                    <div>
                        <label for="l-email" class="block mb-2 text-sm font-medium text-white">Your
                            email</label>
                        <input autocomplete="on" type="email" id="l-email" name="l-email"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            placeholder="example@example.com" required>
                    </div>
                    <div>
                        <label for="l-pass" class="block mb-2 text-sm font-medium text-white">Your
                            password</label>
                        <input autocomplete="on" type="password" id="l-pass" name="l-pass" placeholder="••••••••"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            required>
                    </div>
                    <div class="flex justify-left mx-1">
                        <a href="info.php?t=contact" class="text-sm hover:underline text-blue-500">Lost Password?</a>
                    </div>
                    <button type="submit"
                        class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Login
                        to your account</button>
                </form>
            </div>
        </div>
    </div>
</div>