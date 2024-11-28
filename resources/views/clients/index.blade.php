<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('messages.client_management') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Title and Add New Client Button -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h1>{{ __('messages.client_management') }}</h1>

            <!-- Button trigger modal for Add Client -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
                + {{ __('messages.add_new_client') }}
            </button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-orange">
                    <tr>
                        <th scope="col">{{ __('messages.name') }}</th>
                        <th scope="col">{{ __('messages.email') }}</th>
                        <th scope="col">{{ __('messages.phone') }}</th>
                        <th scope="col">{{ __('messages.address') }}</th>
                        <th scope="col">{{ __('messages.date_created') }}</th>
                        <th scope="col" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->address }}</td>
                            <td>{{ $client->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <!-- Show Icon -->
                                <a href="javascript:void(0);" onclick="showClient({{ $client->id }})" class="me-2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>

                                <!-- Edit Icon -->
                                <a href="javascript:void(0);" onclick="editClient({{ $client->id }})" class="me-2"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.edit') }}">
                                    <i data-feather="edit" class="action-icon text-success"></i>
                                </a>

                                <!-- Delete Icon -->
                                <a href="javascript:void(0);" onclick="confirmDelete({{ $client->id }})"
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ __('messages.delete') }}">
                                    <i data-feather="trash" class="action-icon text-danger"></i>
                                </a>

                                <!-- Hidden delete form -->
                                <form id="delete-form-{{ $client->id }}"
                                    action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                    style="display: none;">
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
            {{ $clients->links() }}
        </div>

        <!-- Modals for show, add, and edit are below -->

        <!-- Modal for Showing Client Details -->
        <div class="modal fade" id="showClientModal" tabindex="-1" aria-labelledby="showClientModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showClientModalLabel">{{ __('messages.client_details') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>{{ __('messages.name') }}:</strong> <span
                                    id="client-name"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.email') }}:</strong> <span
                                    id="client-email"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.phone') }}:</strong> <span
                                    id="client-phone"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.address') }}:</strong> <span
                                    id="client-address"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.city') }}:</strong> <span
                                    id="client-city"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.state') }}:</strong> <span
                                    id="client-state"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.zip_code') }}:</strong> <span
                                    id="client-zip_code"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.country') }}:</strong> <span
                                    id="client-country"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.passport_number') }}:</strong> <span
                                    id="client-passport_number"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.birth_day') }}:</strong> <span
                                    id="client-birth_day"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.nationality') }}:</strong> <span
                                    id="client-nationality"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.date_created') }}:</strong> <span
                                    id="client-created"></span></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal for Adding New Client -->
        <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClientModalLabel">{{ __('messages.add_new_client') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addClientForm" action="{{ route('clients.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('messages.enter_name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('messages.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="{{ __('messages.enter_email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="{{ __('messages.enter_phone') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">{{ __('messages.address') }}</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="{{ __('messages.enter_address') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">{{ __('messages.city') }}</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="{{ __('messages.enter_city') }}">
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">{{ __('messages.state') }}</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    placeholder="{{ __('messages.enter_state') }}">
                            </div>
                            <div class="mb-3">
                                <label for="zip_code" class="form-label">{{ __('messages.zip_code') }}</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                    placeholder="{{ __('messages.enter_zip_code') }}">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">{{ __('messages.country') }}</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    placeholder="{{ __('messages.enter_country') }}">
                            </div>
                            <div class="mb-3">
                                <label for="passport_number"
                                    class="form-label">{{ __('messages.passport_number') }}</label>
                                <input type="text" class="form-control" id="passport_number"
                                    name="passport_number" placeholder="{{ __('messages.enter_passport_number') }}">
                            </div>
                            <div class="mb-3">
                                <label for="birth_day" class="form-label">{{ __('messages.date_of_birth') }}</label>
                                <input type="date" class="form-control" id="birth_day" name="birth_day">
                            </div>
                            <div class="mb-3">
                                <label for="nationality" class="form-label">{{ __('messages.nationality') }}</label>
                                <input type="text" class="form-control" id="nationality" name="nationality"
                                    placeholder="{{ __('messages.enter_nationality') }}">
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
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="button" class="btn btn-primary"
                            onclick="submitAddClientForm()">{{ __('messages.add_client') }}</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Editing Client -->
        <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editClientModalLabel">{{ __('messages.edit_client') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editClientForm" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">{{ __('messages.name') }}</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">{{ __('messages.email') }}</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>

                            <!-- Phone Field -->
                            <div class="mb-3">
                                <label for="edit_phone" class="form-label">{{ __('messages.phone') }}</label>
                                <input type="text" class="form-control" id="edit_phone" name="phone" required>
                            </div>

                            <!-- Address Field -->
                            <div class="mb-3">
                                <label for="edit_address" class="form-label">{{ __('messages.address') }}</label>
                                <input type="text" class="form-control" id="edit_address" name="address"
                                    required>
                            </div>

                            <!-- City Field -->
                            <div class="mb-3">
                                <label for="edit_city" class="form-label">{{ __('messages.city') }}</label>
                                <input type="text" class="form-control" id="edit_city" name="city">
                            </div>

                            <!-- State Field -->
                            <div class="mb-3">
                                <label for="edit_state" class="form-label">{{ __('messages.state') }}</label>
                                <input type="text" class="form-control" id="edit_state" name="state">
                            </div>

                            <!-- Zip Code Field -->
                            <div class="mb-3">
                                <label for="edit_zip_code" class="form-label">{{ __('messages.zip_code') }}</label>
                                <input type="text" class="form-control" id="edit_zip_code" name="zip_code">
                            </div>

                            <!-- Country Field -->
                            <div class="mb-3">
                                <label for="edit_country" class="form-label">{{ __('messages.country') }}</label>
                                <input type="text" class="form-control" id="edit_country" name="country">
                            </div>

                            <!-- Passport Number Field -->
                            <div class="mb-3">
                                <label for="edit_passport_number"
                                    class="form-label">{{ __('messages.passport_number') }}</label>
                                <input type="text" class="form-control" id="edit_passport_number"
                                    name="passport_number">
                            </div>

                            <!-- Birth Day Field -->
                            <div class="mb-3">
                                <label for="edit_birth_day" class="form-label">{{ __('messages.birth_day') }}</label>
                                <input type="date" class="form-control" id="edit_birth_day" name="birth_day">
                            </div>

                            <!-- Nationality Field -->
                            <div class="mb-3">
                                <label for="edit_nationality"
                                    class="form-label">{{ __('messages.nationality') }}</label>
                                <input type="text" class="form-control" id="edit_nationality" name="nationality">
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
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                        <button type="button" class="btn btn-primary"
                            onclick="submitEditClientForm()">{{ __('messages.save_changes') }}</button>
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
    <script src="https://cdn.jsdelivr.net/npm/feather-icons"></script>
    <script>
        // Submit the Add Client form
        function submitAddClientForm() {
            const form = document.getElementById('addClientForm');
            const errorAlert = document.getElementById('errorAlert');
            const spinner = document.getElementById('loadingSpinner');

            // Clear any previous errors
            errorAlert.classList.add('d-none');
            errorAlert.innerHTML = '';
            spinner.classList.remove('d-none'); // Show spinner

            // Perform basic client-side validation
            let phone = document.getElementById('phone').value;
            let address = document.getElementById('address').value;

            if (!phone || !address) {
                errorAlert.classList.remove('d-none');
                errorAlert.innerHTML = 'Phone and Address cannot be empty!';
                spinner.classList.add('d-none'); // Hide spinner
                return; // Prevent form submission
            }

            // Simulate a loading delay
            setTimeout(function() {
                form.submit(); // Allow the form to submit to the server
            }, 500);
        }

        // Fetch and show client data in modal
        function showClient(clientId) {
            fetch(`/clients/${clientId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate all the fields with client data
                    document.getElementById('client-name').textContent = data.name;
                    document.getElementById('client-email').textContent = data.email;
                    document.getElementById('client-phone').textContent = data.phone;
                    document.getElementById('client-address').textContent = data.address;
                    document.getElementById('client-city').textContent = data.city;
                    document.getElementById('client-state').textContent = data.state;
                    document.getElementById('client-zip_code').textContent = data.zip_code;
                    document.getElementById('client-country').textContent = data.country;
                    document.getElementById('client-passport_number').textContent = data.passport_number;
                    document.getElementById('client-birth_day').textContent = new Date(data.birth_day)
                        .toLocaleDateString(); // Format the birth date
                    document.getElementById('client-nationality').textContent = data.nationality;
                    document.getElementById('client-created').textContent = new Date(data.created_at)
                        .toLocaleDateString();

                    // Show the modal
                    const showClientModal = new bootstrap.Modal(document.getElementById('showClientModal'));
                    showClientModal.show();
                })
                .catch(error => console.error('Error fetching client data:', error));
        }


        // Trigger Edit Client modal and populate with data
        function editClient(clientId) {
            fetch(`/clients/${clientId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate fields with the fetched data
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_email').value = data.email;
                    document.getElementById('edit_phone').value = data.phone;
                    document.getElementById('edit_address').value = data.address;
                    document.getElementById('edit_city').value = data.city; // Ensure data.city is valid
                    document.getElementById('edit_state').value = data.state; // Ensure data.state is valid
                    document.getElementById('edit_zip_code').value = data.zip_code;
                    document.getElementById('edit_country').value = data.country;
                    document.getElementById('edit_passport_number').value = data.passport_number;
                    document.getElementById('edit_birth_day').value = data.birth_day;
                    document.getElementById('edit_nationality').value = data.nationality;

                    // Set the action URL for the form (to update the client)
                    const form = document.getElementById('editClientForm');
                    form.action = `/clients/${clientId}`;

                    // Show the modal
                    const editClientModal = new bootstrap.Modal(document.getElementById('editClientModal'));
                    editClientModal.show();
                })
                .catch(error => console.error('Error fetching client data:', error));
        }


        // Submit Edit Client form
        function submitEditClientForm() {
            const form = document.getElementById('editClientForm');
            const errorAlert = document.getElementById('editErrorAlert');
            const spinner = document.getElementById('editLoadingSpinner');

            // Clear any previous errors
            errorAlert.classList.add('d-none');
            errorAlert.innerHTML = '';
            spinner.classList.remove('d-none'); // Show spinner

            // Simulate a loading delay
            setTimeout(function() {
                form.submit(); // Allow the form to submit to the server
            }, 500);
        }

        // Confirm delete with SweetAlert2
        function confirmDelete(clientId) {
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
                    document.getElementById('delete-form-' + clientId).submit();
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
