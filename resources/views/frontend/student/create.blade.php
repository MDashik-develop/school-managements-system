<x-guest-layout>
   <form method="POST" action="{{ route('register.student.store') }}" enctype="multipart/form-data">
       @csrf

       <!-- Student ID -->
       <div>
           <x-input-label for="student_id" :value="__('Student ID')" />
           <x-text-input id="student_id" class="block mt-1 w-full" type="text" name="student_id" :value="old('student_id')" required autofocus />
           <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
       </div>

       <!-- Name -->
       <div class="mt-4">
           <x-input-label for="name" :value="__('Name')" />
           <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
           <x-input-error :messages="$errors->get('name')" class="mt-2" />
       </div>

       <!-- Class -->
       <div class="mt-4">
           <x-input-label for="class" :value="__('Class')" />
           <x-text-input id="class" class="block mt-1 w-full" type="text" name="class" :value="old('class')" required />
           <x-input-error :messages="$errors->get('class')" class="mt-2" />
       </div>

       <!-- Section -->
       <div class="mt-4">
           <x-input-label for="section" :value="__('Section (Optional)')" />
           <x-text-input id="section" class="block mt-1 w-full" type="text" name="section" :value="old('section')" />
           <x-input-error :messages="$errors->get('section')" class="mt-2" />
       </div>

       <!-- Phone -->
       <div class="mt-4">
           <x-input-label for="phone" :value="__('Phone')" />
           <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
           <x-input-error :messages="$errors->get('phone')" class="mt-2" />
       </div>

       <!-- Address -->
       <div class="mt-4">
           <x-input-label for="address" :value="__('Address (Optional)')" />
           <textarea id="address" name="address" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('address') }}</textarea>
           <x-input-error :messages="$errors->get('address')" class="mt-2" />
       </div>

       <!-- Date of Birth -->
       <div class="mt-4">
           <x-input-label for="dob" :value="__('Date of Birth')" />
           <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" />
           <x-input-error :messages="$errors->get('dob')" class="mt-2" />
       </div>

       <!-- Photo -->
       <div class="mt-4">
           <x-input-label for="photo" :value="__('Photo')" />
           <input id="photo" class="block mt-1 w-full" type="file" name="photo" accept="image/*">
           <x-input-error :messages="$errors->get('photo')" class="mt-2" />
       </div>

       <!-- Status -->
       <div class="mt-4">
           <x-input-label for="status" :value="__('Status')" />
           <select id="status" name="status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
               <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
               <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
               <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
           </select>
           <x-input-error :messages="$errors->get('status')" class="mt-2" />
       </div>

       <!-- Joining Date -->
       <div class="mt-4">
           <x-input-label for="joining_date" :value="__('Joining Date')" />
           <x-text-input id="joining_date" class="block mt-1 w-full" type="date" name="joining_date" :value="old('joining_date')" />
           <x-input-error :messages="$errors->get('joining_date')" class="mt-2" />
       </div>

       <div class="flex items-center justify-end mt-6">
           <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
               {{ __('Already registered?') }}
           </a>

           <x-primary-button class="ms-4">
               {{ __('Register') }}
           </x-primary-button>
       </div>
   </form>
</x-guest-layout>
