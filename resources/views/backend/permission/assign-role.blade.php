<x-layout.admin-layout>

    <div class="max-w-3xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">Assign Role to User</h2>
    
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('user.assign.role.store') }}" method="POST" class="space-y-6">
            @csrf
    
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Select User</label>
                <select
                    name="user_id"
                    id="user_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    required
                >
                    <option value="">-- Select User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                <select
                    name="role"
                    id="role"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                    required
                >
                    <option value="">-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <button
                type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
            >
                Assign Role
            </button>
        </form>
    </div>
</x-layout.admin-layout>