<x-layout.admin-layout>
    <div class="max-w-6xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">User Role List</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 text-sm">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Current Role</th>
                    <th class="px-4 py-2 text-left">Change Role</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @foreach($users as $index => $user)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            @if($user->roles->count() > 0)
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-600 rounded-full text-xs">
                                    {{ $user->roles->pluck('name')->join(', ') }}
                                </span>
                            @else
                                <span class="text-gray-400">No Role</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <form action="{{ route('user.assign.role.store') }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <select name="role" class="border rounded px-2 py-1 text-sm">
                                    <option value="">-- Select --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded text-xs hover:bg-indigo-700">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.admin-layout>
