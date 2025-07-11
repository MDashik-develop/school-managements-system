<x-layout.admin-layout>
   <section id="edit-role">
      <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
          <div class="p-6 md:p-8">
              <div class="border-b border-gray-200 pb-4">
                  <h2 class="text-2xl font-bold text-gray-800">Edit Role</h2>
                  <p class="text-sm text-gray-500 mt-1">Update the role details and permissions.</p>
              </div>

              <form action="{{ route('role.update', $role->id) }}" method="POST" class="mt-6 space-y-6">
                  @csrf
                  @method('PUT')

                  <div>
                      <label for="edit_role_name" class="block text-sm font-medium text-gray-700">Role Name</label>
                      <input type="text" name="role_name" id="edit_role_name" value="{{ old('role_name', $role->name) }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>

                  <div>
                      <h3 class="text-lg font-medium text-gray-800">Update Permissions</h3>
                      <div class="mt-4 space-y-6">
                          @php
                              $groupedPermissions = $permissions->groupBy(function($item) {
                                  return explode('-', $item->name)[0];
                              });
                          @endphp

                          @foreach ($groupedPermissions as $groupName => $groupPermissions)
                              <div class="p-4 border border-gray-200 rounded-lg">
                                  <div class="flex items-center justify-between">
                                      <h4 class="text-md font-semibold text-gray-700">{{ ucfirst($groupName) }} Management</h4>
                                      <div class="flex items-center">
                                          <input id="edit-select-all-{{ $groupName }}" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 select-all-checkbox">
                                          <label for="edit-select-all-{{ $groupName }}" class="ml-2 block text-sm text-gray-900">Select All</label>
                                      </div>
                                  </div>
                                  <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                      @foreach ($groupPermissions as $permission)
                                          <div class="flex items-center">
                                              <input id="edit-{{ $permission->name }}" name="permissions[]" type="checkbox" value="{{ $permission->name }}" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 permission-checkbox"
                                                  @if (in_array($permission->name, $rolePermissions)) checked @endif>
                                              <label for="edit-{{ $permission->name }}" class="ml-2 block text-sm text-gray-900">{{ ucwords(str_replace('-', ' ', $permission->name)) }}</label>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          @endforeach
                      </div>
                  </div>

                  <div class="flex items-center justify-end pt-6 border-t border-gray-200">
                      <a href="{{ route('role.list') }}" class="bg-gray-200 text-gray-700 hover:bg-gray-300 font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Cancel</a>
                      <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          Update Role
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </section>

  <script>
      document.querySelectorAll('.select-all-checkbox').forEach(headerCheckbox => {
          headerCheckbox.addEventListener('change', function() {
              const parentContainer = this.closest('.border');
              const checkboxes = parentContainer.querySelectorAll('.permission-checkbox');
              checkboxes.forEach(checkbox => {
                  checkbox.checked = this.checked;
              });
          });
      });

      // Initial check for "Select All" checkboxes on page load for edit page
      document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('.select-all-checkbox').forEach(headerCheckbox => {
              const parentContainer = headerCheckbox.closest('.border');
              const checkboxes = parentContainer.querySelectorAll('.permission-checkbox');
              const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
              headerCheckbox.checked = allChecked;
          });
      });
  </script>
</x-layout.admin-layout>