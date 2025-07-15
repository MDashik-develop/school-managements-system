<x-guest-layout>
   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="col-md-6">
            <div class="card">
               <div class="card-header text-center bg-primary text-white">
                  <h4>Create Password</h4>
               </div>
               <div class="card-body">
                  <div class="mb-4 text-center">
                     <h5>Welcome, {{ $student->name }}</h5>
                  </div>
                  <form method="POST" action="{{ route('student.aprove.password.store', $student->id) }}">
                     @csrf
                     <!-- Password -->
                     <div class="mt-4">
                         <x-input-label for="password" :value="__('Password')" />
             
                         <x-text-input id="password" class="block w-full mt-1"
                                         type="password"
                                         name="password"
                                         required autocomplete="current-password" />
             
                         <x-input-error :messages="$errors->get('password')" class="mt-2" />
                     </div>
             
                     <div class="flex items-center justify-end mt-4">
                        <center class="w-full">
                         <x-primary-button class="w-full">
                             {{ __('Log in') }}
                         </x-primary-button>

                        </center>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-guest-layout>