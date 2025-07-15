<x-guest-layout>
    <div class="bg-gray-50">
        <div class="w-full min-h-max mx-auto">
            <div class="w-full mx-auto bg-white rounded-2xl" x-data="{ step: 1 }">

                <!-- Header -->
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">Student Admission</h1>
                    <p class="mt-2 text-gray-600">Create your account to start your journey with us.</p>
                    <div class="mt-4">
                        <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="{{ route('login') }}">
                            {{ __('Already have an account? Sign In') }}
                        </a>
                    </div>
                </div>

                <!-- Stepper Navigation -->
                <div class="w-full max-w-7xl p-2 mx-auto mb-12">
                    <div class="flex items-center justify-between">
                        <!-- Step 1: Personal -->
                        <div class="flex flex-col items-center text-center text-indigo-600" :class="{ 'font-bold': step >= 1 }">
                            <div class="flex items-center justify-center w-10 h-10 text-white bg-indigo-600 border-2 border-indigo-600 rounded-full" :class="{'!bg-white !text-indigo-600': step > 1}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="mt-2 text-xs sm:text-sm">Personal</span>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out" :class="step > 1 ? 'border-indigo-600' : 'border-gray-300'"></div>

                        <!-- Step 2: Guardian -->
                        <div class="flex flex-col items-center text-center" :class="{ 'text-indigo-600 font-bold': step >= 2, 'text-gray-500': step < 2 }">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-2" :class="step >= 2 ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-gray-100 text-gray-600 border-gray-300', {'!bg-white !text-indigo-600': step > 2}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="mt-2 text-xs sm:text-sm">Guardian</span>
                        </div>
                        <div class="flex-auto border-t-2 transition duration-500 ease-in-out" :class="step > 2 ? 'border-indigo-600' : 'border-gray-300'"></div>
                        
                        <!-- Step 3: Account -->
                        <div class="flex flex-col items-center text-center" :class="{ 'text-indigo-600 font-bold': step === 3, 'text-gray-500': step < 3 }">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full border-2" :class="step === 3 ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-gray-100 text-gray-600 border-gray-300'">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <span class="mt-2 text-xs sm:text-sm">Security</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('register.student.store') }}">
                    @csrf

                    <!-- Step 1: Personal Details -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                        <h2 class="mb-8 text-xl font-semibold text-center text-gray-700">Tell us about yourself</h2>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="class" :value="__('Class')" />
                                <x-text-input id="class" class="block w-full mt-1" type="text" name="class" :value="old('class')" required />
                                <x-input-error :messages="$errors->get('class')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="dob" :value="__('Date of Birth')" />
                                <x-text-input id="dob" class="block w-full mt-1" type="date" name="dob" :value="old('dob')" required />
                                <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" />
                                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="phone" :value="__('Phone Number')" />
                                <x-text-input id="phone" class="block w-full mt-1" type="tel" name="phone" placeholder="01xxxxxxxxx" :value="old('phone')" required />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Guardian & Family Information -->
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                        <h2 class="mb-8 text-xl font-semibold text-center text-gray-700">Guardian & Family Information</h2>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <x-input-label for="father_name" :value="__('Father\'s Name (Optional)')" />
                                <x-text-input id="father_name" class="block w-full mt-1" type="text" name="father_name" :value="old('father_name')" />
                                <x-input-error :messages="$errors->get('father_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="mother_name" :value="__('Mother\'s Name (Optional)')" />
                                <x-text-input id="mother_name" class="block w-full mt-1" type="text" name="mother_name" :value="old('mother_name')" />
                                <x-input-error :messages="$errors->get('mother_name')" class="mt-2" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="guardian_number" :value="__('Primary Guardian Contact Number (Optional)')" />
                                <x-text-input id="guardian_number" class="block w-full mt-1" type="tel" name="guardian_number" placeholder="01xxxxxxxxx" :value="old('guardian_number')" />
                                <x-input-error :messages="$errors->get('guardian_number')" class="mt-2" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="address" :value="__('Home Address (Optional)')" />
                                <textarea id="address" name="address" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('address') }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Account Security -->
                    <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                        <h2 class="mb-8 text-xl font-semibold text-center text-gray-700">Secure Your Account</h2>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex items-center justify-between pt-8 mt-8 border-t border-gray-200">
                        <div>
                            <button type="button" x-show="step > 1" @click="step--" class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200">
                                Previous
                            </button>
                        </div>
                        
                        <div>
                            <button type="button" x-show="step < 3" @click="step++" class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span>Next Step</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </button>

                            <x-primary-button x-show="step === 3" class="inline-flex items-center px-3 py-2 text-base">
                                <span>{{ __('Register') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Include AlpineJS for interactivity -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</x-guest-layout>
