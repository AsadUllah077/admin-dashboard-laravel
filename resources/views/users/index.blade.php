<x-layouts.app>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Users') }}</h1>
    </div>

    <div class="mb-4 flex justify-end items-end">
        <a href="{{ route('users.create') }}"
            class="inline-block  bg-gray-600 hover:bg-gray-700 text-white font-semibold py-1 px-2 rounded">
            + Add User
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg p-4">
        <table id="users-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-600 dark:text-gray-300">Name</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-600 dark:text-gray-300">Email</th>
                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-600 dark:text-gray-300">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="py-2 px-4 text-gray-800 dark:text-gray-100 text-sm">{{ $user->name }}</td>
                        <td class="py-2 px-4 text-gray-800 dark:text-gray-100 text-sm">{{ $user->email }}</td>
                        <td class="py-2 px-4 text-gray-800 dark:text-gray-100 text-sm flex space-x-2">
                            <!-- Edit Icon -->
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700"
                                title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536M9 13l6.536-6.536a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H9v-1.414a2 2 0 01.586-1.414z" />
                                </svg>
                            </a>

                            <!-- Delete Icon -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @push('scripts')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables CSS & JS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <!-- Dark mode styling for DataTables -->
        <style>
            /* Optional: Customize dark mode DataTables */
            body.dark .dataTables_wrapper {
                color: #e5e7eb;
            }

            body.dark .dataTables_filter input {
                background-color: #1f2937;
                color: #f9fafb;
                border: 1px solid #374151;
            }

            body.dark .dataTables_paginate .paginate_button {
                background-color: #374151;
                color: #f9fafb !important;
            }

            body.dark .dataTables_paginate .paginate_button.current {
                background-color: #2563eb !important;
                color: #fff !important;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('#users-table').DataTable({
                    responsive: true,
                    paging: true,
                    pageLength: 10,
                    language: {
                        searchPlaceholder: "Search users...",
                        search: "",
                    }
                });
            });
        </script>
    @endpush
</x-layouts.app>
