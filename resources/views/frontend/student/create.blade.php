<x-guest-layout>
   <form method="POST" action="{{ route('register.student.store') }}">
       @csrf

       <!-- Name -->
       <div class="mt-4">
           <x-input-label for="name" :value="__('Name')" />
           <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required />
           <x-input-error :messages="$errors->get('name')" class="mt-2" />
       </div>

       <!-- Class -->
       <div class="mt-4">
           <x-input-label for="class" :value="__('Class')" />
           <x-text-input id="class" class="block w-full mt-1" type="text" name="class" :value="old('class')" required />
           <x-input-error :messages="$errors->get('class')" class="mt-2" />
       </div>

       <!-- amil -->
       <div class="mt-4">
           <x-input-label for="email" :value="__('Email')" />
           <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />
           <x-input-error :messages="$errors->get('email')" class="mt-2" />
       </div>

       <!-- Phone -->
       <div class="mt-4">
           <x-input-label for="phone" :value="__('Phone')" />
           <x-text-input id="phone" class="block w-full mt-1" type="text" name="phone" :value="old('phone')" required />
           <x-input-error :messages="$errors->get('phone')" class="mt-2" />
       </div>

       <!-- Address -->
       <div class="mt-4">
           <x-input-label for="address" :value="__('Address (Optional)')" />
           <textarea id="address" name="address" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('address') }}</textarea>
           <x-input-error :messages="$errors->get('address')" class="mt-2" />
       </div>

       <!-- Date of Birth -->
       <div class="mt-4">
           <x-input-label for="dob" :value="__('Date of Birth')" />
           <x-text-input id="dob" class="block w-full mt-1" type="date" name="dob" :value="old('dob')" />
           <x-input-error :messages="$errors->get('dob')" class="mt-2" />
       </div>

       <div class="flex items-center justify-end mt-6">
           <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
               {{ __('Already registered?') }}
           </a>

           <x-primary-button class="ms-4">
               {{ __('Register') }}
           </x-primary-button>
       </div>
   </form>
</x-guest-layout>
