<x-app-layout>

    @section('title', __('messages.user_management'))


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.user_management') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Title and Add New User Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('messages.user_management') }}</h1>

            <!-- Button trigger modal for Add User -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                + {{ __('messages.add_new_user') }}
            </button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-orange">
                    <tr>
                        <th scope="col">{{ __('messages.name') }}</th>
                        <th scope="col">{{ __('messages.email') }}</th>
                        <th scope="col">{{ __('messages.date_created') }}</th>
                        <th scope="col" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <!-- Show Icon -->
                                <a href="javascript:void(0);" onclick="showUser({{ $user->id }})" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>

                                <!-- Edit Icon -->
                                <a href="javascript:void(0);" onclick="editUser({{ $user->id }})" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.edit') }}">
                                    <i data-feather="edit" class="action-icon text-success"></i>
                                </a>

                                <!-- Delete Icon -->
                                <a href="javascript:void(0);" onclick="confirmDelete({{ $user->id }})" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.delete') }}">
                                    <i data-feather="trash" class="action-icon text-danger"></i>
                                </a>

                                 <!-- Hidden delete form -->
                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>

        <!-- Modals for show, add, and edit are below -->

        <!-- Modal for Showing User Details -->
        <div class="modal fade" id="showUserModal" tabindex="-1" aria-labelledby="showUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showUserModalLabel">{{ __('messages.user_details') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>{{ __('messages.name') }}:</strong> <span id="user-name"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.email') }}:</strong> <span id="user-email"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.date_created') }}:</strong> <span id="user-created"></span></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Adding New User -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">{{ __('messages.add_new_user') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm" action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('messages.enter_name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('messages.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('messages.enter_email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('messages.password') }}</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('messages.enter_password') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('messages.confirm_password') }}</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('messages.confirm_password') }}" required>
                            </div>
                            <div class="alert alert-danger d-none" id="errorAlert"></div>
                            <div class="text-center d-none" id="loadingSpinner">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">{{ __('messages.loading') }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="button" class="btn btn-primary" onclick="submitAddUserForm()">{{ __('messages.add_user') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Editing User -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">{{ __('messages.edit_user') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">{{ __('messages.email') }}</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                            <div class="alert alert-danger d-none" id="editErrorAlert"></div>
                            <div class="text-center d-none" id="editLoadingSpinner">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">{{ __('messages.loading') }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="button" class="btn btn-primary" onclick="submitEditUserForm()">{{ __('messages.save_changes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div id="success-message" data-message="{{ session('success') }}"></div>
    @endif

    <!-- JavaScript for handling the modals and form submissions -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>



        // Submit the Add User form
        function submitAddUserForm() {
            const form = document.getElementById('addUserForm');
            const errorAlert = document.getElementById('errorAlert');
            const spinner = document.getElementById('loadingSpinner');

            // Clear any previous errors
            errorAlert.classList.add('d-none');
            errorAlert.innerHTML = '';
            spinner.classList.remove('d-none');  // Show spinner

            // Perform basic client-side validation
            let password = document.getElementById('password').value;
            let passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                errorAlert.classList.remove('d-none');
                errorAlert.innerHTML = 'Passwords do not match!';
                spinner.classList.add('d-none');  // Hide spinner
                return;  // Prevent form submission
            }

            // Simulate a loading delay
            setTimeout(function() {
                form.submit();  // Allow the form to submit to the server
            }, 500);
        }

        // Fetch and show user data in modal
        function showUser(userId) {
            fetch(`/users/${userId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('user-name').textContent = data.name;
                    document.getElementById('user-email').textContent = data.email;
                    document.getElementById('user-created').textContent = new Date(data.created_at).toLocaleDateString();

                    var showUserModal = new bootstrap.Modal(document.getElementById('showUserModal'));
                    showUserModal.show();
                })
                .catch(error => console.error('Error fetching user data:', error));
        }

        // Trigger Edit User modal and populate with data
        function editUser(userId) {
            fetch(`/users/${userId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_email').value = data.email;

                    // Set form action URL for editing the user
                    const form = document.getElementById('editUserForm');
                    form.action = `/users/${userId}`;

                    var editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                    editUserModal.show();
                })
                .catch(error => console.error('Error fetching user data:', error));
        }

        // Submit Edit User form
        function submitEditUserForm() {
            const form = document.getElementById('editUserForm');
            const errorAlert = document.getElementById('editErrorAlert');
            const spinner = document.getElementById('editLoadingSpinner');

            // Clear any previous errors
            errorAlert.classList.add('d-none');
            errorAlert.innerHTML = '';
            spinner.classList.remove('d-none');  // Show spinner

            // Simulate a loading delay
            setTimeout(function() {
                form.submit();  // Allow the form to submit to the server
            }, 500);
        }

        // Confirm delete with SweetAlert2
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the hidden delete form
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }


        // Trigger SweetAlert2 Success notification
        document.addEventListener("DOMContentLoaded", function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                var message = successMessage.getAttribute('data-message');
                Swal.fire({
                    icon: 'success',
                    title: message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            }
        });
    </script>
</x-app-layout>
