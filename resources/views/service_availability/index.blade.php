<x-app-layout>
    @section('title', __('messages.service_availability_list'))

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.service_availability') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Title and Add New Availability Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('messages.service_availability_list') }}</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAvailabilityModal">
                + {{ __('messages.add_availability') }}
            </button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th scope="col">{{ __('messages.start_date') }}</th>
                        <th scope="col">{{ __('messages.end_date') }}</th>
                        <th scope="col">{{ __('messages.start_time') }}</th>
                        <th scope="col">{{ __('messages.end_time') }}</th>
                        <th scope="col">{{ __('messages.service') }}</th>
                        <th scope="col">{{ __('messages.remaining_slots') }}</th>
                        <th scope="col" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        @foreach ($service->availabilities as $availability)
                            <tr class="border-bottom">

                                <td>{{ $availability->start_date }}</td>
                                <td>{{ $availability->end_date }}</td>
                                <td>{{ $availability->start_time }}</td>
                                <td>{{ $availability->end_time }}</td>

                                <!-- Service Title -->
                                <td>{{ $service->title }}</td>

                                
                                <!-- Remaining Slots -->
                                <td>{{ $availability->remaining_slots }}</td>

                                <!-- Actions -->
                                <td class="text-center">
                                    <a href="javascript:void(0);" onclick="showAvailability({{ $availability->id }})" class="text-info me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="javascript:void(0);" onclick="editAvailability({{ $availability->id }})" class="text-primary me-2" data-bs-toggle="tooltip" title="{{ __('messages.edit') }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="javascript:void(0);" onclick="deleteAvailability({{ $availability->id }})" class="text-danger" data-bs-toggle="tooltip" title="{{ __('messages.delete') }}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Availability Modal -->
    <div class="modal fade" id="addAvailabilityModal" tabindex="-1" aria-labelledby="addAvailabilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAvailabilityModalLabel">{{ __('messages.add_availability') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addAvailabilityForm" action="{{ route('service_availability.store') }}" method="POST">
                        @csrf



                        <!-- Start Date -->
                        <div class="mb-3">
                            <label for="start_date" class="form-label">{{ __('messages.start_date') }}</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <!-- End Date -->
                        <div class="mb-3">
                            <label for="end_date" class="form-label">{{ __('messages.end_date') }}</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>

                        <!-- Start Time -->
                        <div class="mb-3">
                            <label for="start_time" class="form-label">{{ __('messages.start_time') }}</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>

                        <!-- End Time -->
                        <div class="mb-3">
                            <label for="end_time" class="form-label">{{ __('messages.end_time') }}</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                        </div>


                        <!-- Service -->
                        <div class="mb-3">
                            <label for="service_id" class="form-label">{{ __('messages.service') }}</label>
                            <select class="form-select" id="service_id" name="service_id" required>
                                <option value="">{{ __('messages.select_service') }}</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>

            

                        <!-- Remaining Slots -->
                        <div class="mb-3">
                            <label for="remaining_slots" class="form-label">{{ __('messages.remaining_slots') }}</label>
                            <input type="number" class="form-control" id="remaining_slots" name="remaining_slots" min="1" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">{{ __('messages.add_availability') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Availability Modal -->
    <div class="modal fade" id="editAvailabilityModal" tabindex="-1" aria-labelledby="editAvailabilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAvailabilityModalLabel">{{ __('messages.edit_availability') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAvailabilityForm" method="POST">
                        @csrf
                        @method('PUT')



                        <!-- Start Date -->
                        <div class="mb-3">
                            <label for="edit_start_date" class="form-label">{{ __('messages.start_date') }}</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                        </div>

                        <!-- End Date -->
                        <div class="mb-3">
                            <label for="edit_end_date" class="form-label">{{ __('messages.end_date') }}</label>
                            <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                        </div>

                        <!-- Start Time -->
                        <div class="mb-3">
                            <label for="edit_start_time" class="form-label">{{ __('messages.start_time') }}</label>
                            <input type="time" class="form-control" id="edit_start_time" name="start_time" required>
                        </div>

                        <!-- End Time -->
                        <div class="mb-3">
                            <label for="edit_end_time" class="form-label">{{ __('messages.end_time') }}</label>
                            <input type="time" class="form-control" id="edit_end_time" name="end_time" required>
                        </div>


                        <!-- Service -->
                        <div class="mb-3">
                            <label for="edit_service_id" class="form-label">{{ __('messages.service') }}</label>
                            <select class="form-select" id="edit_service_id" name="service_id" required>
                                <option value="">{{ __('messages.select_service') }}</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>

               

                        <!-- Remaining Slots -->
                        <div class="mb-3">
                            <label for="edit_remaining_slots" class="form-label">{{ __('messages.remaining_slots') }}</label>
                            <input type="number" class="form-control" id="edit_remaining_slots" name="remaining_slots" min="1" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Availability Modal -->
    <div class="modal fade" id="showAvailabilityModal" tabindex="-1" aria-labelledby="showAvailabilityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showAvailabilityModalLabel">{{ __('messages.service_availability') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="mb-3">
                        <strong>{{ __('messages.start_date') }}:</strong>
                        <span id="show_start_date"></span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('messages.end_date') }}:</strong>
                        <span id="show_end_date"></span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('messages.start_time') }}:</strong>
                        <span id="show_start_time"></span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('messages.end_time') }}:</strong>
                        <span id="show_end_time"></span>
                    </div>


                    <div class="mb-3">
                        <strong>{{ __('messages.service') }}:</strong>
                        <span id="show_service_name"></span>
                    </div>
        
                    <div class="mb-3">
                        <strong>{{ __('messages.remaining_slots') }}:</strong>
                        <span id="show_remaining_slots"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Show Availability
        function showAvailability(id) {
            fetch(`/service_availability/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('show_start_date').textContent = data.start_date || 'N/A';
                    document.getElementById('show_end_date').textContent = data.end_date || 'N/A';
                    document.getElementById('show_start_time').textContent = data.start_time || 'N/A';
                    document.getElementById('show_end_time').textContent = data.end_time || 'N/A';
                    document.getElementById('show_service_name').textContent = data.service.title || 'N/A';
                    document.getElementById('show_remaining_slots').textContent = data.remaining_slots || 'N/A';

                    const showModal = new bootstrap.Modal(document.getElementById('showAvailabilityModal'));
                    showModal.show();
                })
                .catch(error => {
                    console.error('Error fetching availability details:', error);
                    alert('Failed to load availability details.');
                });
        }


        // Edit Availability
        function editAvailability(id) {
            fetch(`/service_availability/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_start_date').value = data.start_date;
                    document.getElementById('edit_end_date').value = data.end_date;
                    document.getElementById('edit_start_time').value = data.start_time;
                    document.getElementById('edit_end_time').value = data.end_time;
                    document.getElementById('edit_service_id').value = data.service_id;
                    document.getElementById('edit_remaining_slots').value = data.remaining_slots;

                    // Set form action for update
                    const form = document.getElementById('editAvailabilityForm');
                    form.action = `/service_availability/${id}`;

                    // Show the modal
                    const editModal = new bootstrap.Modal(document.getElementById('editAvailabilityModal'));
                    editModal.show();
                })
                .catch(error => {
                    console.error('Error fetching availability details:', error);
                    alert('Failed to load availability details.');
                });
        }



        // Delete Availability
        function deleteAvailability(id) {
            Swal.fire({
                title: "{{ __('messages.delete_confirmation') }}",
                text: "{{ __('messages.confirm_delete') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('messages.yes_delete') }}",
                cancelButtonText: "{{ __('messages.cancel') }}"
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.action = `/service_availability/${id}`;
                    form.method = 'POST';
                    form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // SweetAlert for Success Messages
        document.addEventListener("DOMContentLoaded", function () {
            const successMessage = '{{ session('success') }}';
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: successMessage,
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
