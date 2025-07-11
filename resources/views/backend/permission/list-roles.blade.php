<x-layout.admin-layout>
   <section id="list-roles" class="mb-12">
      <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
          <div class="p-6 md:p-8">
              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-4">
                  <div>
                      <h2 class="text-2xl font-bold text-gray-800">Roles List</h2>
                      <p class="text-sm text-gray-500 mt-1">Manage all user roles and their permissions.</p>
                  </div>
                  <a href="{{ route('role.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                      </svg>
                      Create New Role
                  </a>
              </div>

              <div class="mt-6 flow-root">
                  <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                          <table class="min-w-full divide-y divide-gray-300">
                              <thead>
                                  <tr>
                                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">#</th>
                                      <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role Name</th>
                                      <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0 text-right text-sm font-semibold text-gray-900">
                                          Actions
                                      </th>
                                  </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-200 bg-white">
                                  @forelse ($roles as $index => $role)
                                      <tr>
                                          <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $index + 1 }}</td>
                                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $role->name }}</td>
                                          <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                              <a href="{{ route('role.edit', $role->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                              <span class="mx-2 text-gray-300">|</span>
                                              <form action="{{ route('role.delete', $role->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                              </form>
                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="3" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 text-center">No roles found.</td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</x-layout.admin-layout>