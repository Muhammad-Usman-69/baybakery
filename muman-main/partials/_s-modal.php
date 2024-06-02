<div id="sign-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relativerounded-lg shadow bg-gray-700 border border-white rounded-md">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                <h3 class="text-xl font-semibold text-white">
                    Sign up to our platform
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                    data-modal-hide="sign-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="partials/_s-handler.php" method="post">
                    <div>
                        <label for="s-name" class="block mb-2 text-sm font-medium text-white">Your
                            name</label>
                        <input type="text" minlength="5" autocomplete="off" id="s-name" name="s-name"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            placeholder="John Doe" required>
                    </div>
                    <div>
                        <label for="s-email" class="block mb-2 text-sm font-medium text-white">Your
                            email</label>
                        <input type="email" autocomplete="off" id="s-email" name="s-email"
                            class="border text-sm rounded-lg  focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            placeholder="example@example.com" required>
                    </div>
                    <div>
                        <label for="s-pass" class="block mb-2 text-sm font-medium text-gray-900 text-white">Your
                            password</label>
                        <input type="password" minlength="8" autocomplete="new-password" id="s-pass" name="s-pass"
                            placeholder="••••••••"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            required>
                    </div>
                    <div>
                        <label for="s-cpass"
                            class="block mb-2 text-sm font-medium text-gray-900 text-white">Confirm
                            password</label>
                        <input type="password" minlength="8" autocomplete="new-password" id="s-cpass" name="s-cpass"
                            placeholder="••••••••"
                            class="border text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-600 border-gray-500 placeholder-gray-400 text-white"
                            required>
                    </div>
                    <button type="submit"
                        class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Create
                        your account</button>
                </form>
            </div>
        </div>
    </div>
</div>