<x-app-layout>
    @section('title', __('messages.reservation_list'))

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.reservations') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('messages.reservation_list') }}</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReservationModal">
                + {{ __('messages.add_reservation') }}
            </button>
        </div>

        <!-- Reservation Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light border-bottom">
                    <tr>
                        <th>{{ __('messages.client') }}</th>
                        <th>{{ __('messages.service') }}</th>
                        <th>{{ __('messages.reservation_dates') }}</th>
                        <th>{{ __('messages.adults') }}</th>
                        <th>{{ __('messages.children') }}</th>
                        <th>{{ __('messages.total_price') }}</th>
                        <th>{{ __('messages.payment_status') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <!-- Client Name -->
                            <td>
                                <span class="fw-bold">{{ $reservation->client->name }}</span>
                            </td>

                            <!-- Service Title -->
                            <td>
                                <span class="badge bg-info text-dark">{{ $reservation->service->title }}</span>
                            </td>

                            <!-- Reservation Dates -->
                            <td>
                                @if($reservation->reservation_dates)
                                    <span class="badge bg-secondary">
                                        {{ implode(', ', json_decode($reservation->reservation_dates)) }}
                                    </span>
                                @else
                                    <span class="text-muted">{{ __('messages.no_dates') }}</span>
                                @endif
                            </td>

                            <!-- Adults Count -->
                            <td>
                                <span class="badge bg-primary">{{ $reservation->adults_count }}</span>
                            </td>

                            <!-- Children Count -->
                            <td>
                                @if($reservation->children_count > 0)
                                    <span class="badge bg-warning text-dark">{{ $reservation->children_count }}</span>
                                @else
                                    <span class="text-muted">{{ __('messages.none') }}</span>
                                @endif
                            </td>

                            <!-- Total Price -->
                            <td>
                                <span class="fw-bold text-success">{{ number_format($reservation->total_price, 2) }} {{ __('messages.currency') }}</span>
                            </td>

                            <!-- Payment Status -->
                            <td>
                                @switch($reservation->payment_status)
                                    @case('paid')
                                        <span class="badge bg-success">{{ __('messages.paid') }}</span>
                                        @break
                                    @case('unpaid')
                                        <span class="badge bg-danger">{{ __('messages.unpaid') }}</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ __('messages.unknown') }}</span>
                                @endswitch
                            </td>

                            <!-- Status -->
                            <td>
                                @switch($reservation->status)
                                    @case('confirmed')
                                        <span class="badge bg-success">{{ __('messages.confirmed') }}</span>
                                        @break
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">{{ __('messages.pending') }}</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger">{{ __('messages.cancelled') }}</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ __('messages.unknown') }}</span>
                                @endswitch
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <a href="javascript:void(0);" onclick="showReservation({{ $reservation->id }})" class="text-info me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="editReservation({{ $reservation->id }})" class="text-primary me-2" data-bs-toggle="tooltip" title="{{ __('messages.edit') }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="deleteReservation({{ $reservation->id }})" class="text-danger" data-bs-toggle="tooltip" title="{{ __('messages.delete') }}">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Add Reservation Modal -->
    <div class="modal fade" id="addReservationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.add_reservation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('reservations.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label>{{ __('messages.client') }}</label>
                            <select name="client_id" class="form-select" required>
                                <option value="">{{ __('messages.select_client') }}</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.service') }}</label>
                            <select name="service_id" class="form-select" required id="service_id">
                                <option value="">{{ __('messages.select_service') }}</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" 
                                            data-price="{{ $service->price }}" 
                                            data-max-participants="{{ $service->max_participants }}" 
                                            data-start-date="{{ $service->availabilities->pluck('start_date')->first() }}"
                                            data-end-date="{{ $service->availabilities->pluck('end_date')->first() }}"
                                            data-start-time="{{ $service->availabilities->pluck('start_time')->first() }}"
                                            data-end-time="{{ $service->availabilities->pluck('end_time')->first() }}">
                                        {{ $service->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Service Details -->
                        <div id="service_details" class="mb-3" style="display: none;">
                            <h6>{{ __('messages.service_details') }}</h6>
                            <p><strong>{{ __('messages.price') }}:</strong> <span id="service_price"></span></p>
                            <p><strong>{{ __('messages.max_participants') }}:</strong> <span id="max_participants"></span></p>
                            <p><strong>{{ __('messages.available_date') }}:</strong> <span id="available_dates"></span></p>
                            <p><strong>{{ __('messages.start_time') }}:</strong> <span id="start_time"></span></p>
                            <p><strong>{{ __('messages.end_time') }}:</strong> <span id="end_time"></span></p>
                        </div>

                        <div class="mb-3">
                            <label>{{ __('messages.reservation_dates') }}</label>
                            <input type="text" name="reservation_dates[]" class="form-control flatpickr" placeholder="yyyy-mm-dd" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.adults') }}</label>
                            <input type="number" name="adults_count" id="adults_count" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.children') }}</label>
                            <input type="number" name="children_count" id="children_count" class="form-control" min="0">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.total_price') }}</label>
                            <input type="number" id="total_price" name="total_price" class="form-control" min="0" readonly>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.payment_status') }}</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="paid">{{ __('messages.paid') }}</option>
                                <option value="unpaid">{{ __('messages.unpaid') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('messages.status') }}</label>
                            <select name="status" class="form-select" required>
                                <option value="confirmed">{{ __('messages.confirmed') }}</option>
                                <option value="pending">{{ __('messages.pending') }}</option>
                                <option value="cancelled">{{ __('messages.cancelled') }}</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Show Reservation Modal -->
<div class="modal fade" id="showReservationModal" tabindex="-1" aria-labelledby="showReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showReservationModalLabel">{{ __('messages.reservation_details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>{{ __('messages.client') }}:</strong>
                    <span id="show_client"></span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('messages.service') }}:</strong>
                    <span id="show_service"></span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('messages.reservation_dates') }}:</strong>
                    <span id="show_dates"></span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('messages.adults') }}:</strong>
                    <span id="show_adults"></span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('messages.children') }}:</strong>
                    <span id="show_children"></span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('messages.total_price') }}:</strong>
                    <span id="show_total"></span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('messages.payment_status') }}:</strong>
                    <span id="show_payment_status"></span>
                </div>
                <div class="mb-3">
                    <strong>{{ __('messages.status') }}:</strong>
                    <span id="show_status"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Reservation Modal -->
<div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReservationModalLabel">{{ __('messages.edit_reservation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editReservationForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>{{ __('messages.client') }}</label>
                        <select name="client_id" class="form-select" id="edit_client" required>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>{{ __('messages.service') }}</label>
                        <select name="service_id" class="form-select" id="edit_service" required>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>{{ __('messages.reservation_dates') }}</label>
                        <input type="text" name="reservation_dates[]" id="edit_reservation_dates" class="form-control flatpickr" required>
                    </div>
                    <div class="mb-3">
                        <label>{{ __('messages.adults') }}</label>
                        <input type="number" name="adults_count" id="edit_adults" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label>{{ __('messages.children') }}</label>
                        <input type="number" name="children_count" id="edit_children" class="form-control" min="0">
                    </div>
                    <div class="mb-3">
                        <label>{{ __('messages.payment_status') }}</label>
                        <select name="payment_status" class="form-select" id="edit_payment_status" required>
                            <option value="paid">{{ __('messages.paid') }}</option>
                            <option value="unpaid">{{ __('messages.unpaid') }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>{{ __('messages.status') }}</label>
                        <select name="status" class="form-select" id="edit_status" required>
                            <option value="confirmed">{{ __('messages.confirmed') }}</option>
                            <option value="pending">{{ __('messages.pending') }}</option>
                            <option value="cancelled">{{ __('messages.cancelled') }}</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>




        function editReservation(id) {
            console.log("editReservation called with id:", id);

            fetch(`/reservations/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Failed to fetch reservation data.");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Fetched data for reservation:", data);

                    // Populate the form fields
                    document.getElementById('edit_client').value = data.client_id;
                    document.getElementById('edit_service').value = data.service_id;

                    // Update flatpickr with reservation dates
                    const editFlatpickrInput = document.getElementById('edit_reservation_dates');
                    let datesArray = [];

                    if (Array.isArray(data.reservation_dates) && data.reservation_dates.length > 0) {
                        datesArray = data.reservation_dates[0].split(',').map(date => date.trim());
                    }

                    console.log("Parsed reservation dates array:", datesArray);

                    if (editFlatpickrInput._flatpickr) {
                        editFlatpickrInput._flatpickr.destroy();
                    }

                    flatpickr(editFlatpickrInput, {
                        mode: 'multiple',
                        dateFormat: 'Y-m-d',
                        defaultDate: datesArray,
                    });

                    document.getElementById('edit_adults').value = data.adults_count || 1;
                    document.getElementById('edit_children').value = data.children_count || 0;
                    document.getElementById('edit_payment_status').value = data.payment_status || 'unpaid';
                    document.getElementById('edit_status').value = data.status || 'pending';

                    const form = document.getElementById('editReservationForm');
                    form.action = `/reservations/${id}`;

                    const editModal = new bootstrap.Modal(document.getElementById('editReservationModal'));
                    editModal.show();
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: "{{ __('messages.error') }}",
                        text: "{{ __('messages.unable_to_fetch_reservation') }}",
                        confirmButtonText: "{{ __('messages.ok') }}",
                    });
                    console.error('Error fetching reservation:', error);
                });
        }


        document.addEventListener('DOMContentLoaded', function () {
            flatpickr('.flatpickr', { mode: 'multiple', dateFormat: 'Y-m-d' });

            const serviceSelect = document.getElementById('service_id');
            const adultsInput = document.getElementById('adults_count');
            const childrenInput = document.getElementById('children_count');
            const totalPriceInput = document.getElementById('total_price');

            const calculateTotalPrice = () => {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const price = parseFloat(selectedOption.dataset.price) || 0;
                const adults = parseInt(adultsInput.value) || 0;
                const children = parseInt(childrenInput.value) || 0;

                const totalPrice = (adults * price) + (children * price * 0.5);
                totalPriceInput.value = totalPrice.toFixed(2);
            };

            serviceSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.dataset.price;
                const maxParticipants = selectedOption.dataset.maxParticipants;
                const startDate = selectedOption.dataset.startDate;
                const endDate = selectedOption.dataset.endDate;
                const startTime = selectedOption.dataset.startTime;
                const endTime = selectedOption.dataset.endTime;

                if (price && maxParticipants) {
                    document.getElementById('service_price').textContent = price;
                    document.getElementById('max_participants').textContent = maxParticipants;
                    document.getElementById('available_dates').textContent = `${startDate} to ${endDate}`;
                    document.getElementById('start_time').textContent = startTime;
                    document.getElementById('end_time').textContent = endTime;
                    document.getElementById('service_details').style.display = 'block';
                } else {
                    document.getElementById('service_details').style.display = 'none';
                }

                flatpickr('.flatpickr', {
                    mode: 'multiple',
                    dateFormat: 'Y-m-d',
                    minDate: startDate,
                    maxDate: endDate
                });

                calculateTotalPrice();
            });

            adultsInput.addEventListener('input', calculateTotalPrice);
            childrenInput.addEventListener('input', calculateTotalPrice);

            // SweetAlert Success on Form Submit
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


        // Delete Reservation
        function deleteReservation(id) {
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
                    form.action = `/reservations/${id}`;
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






        function showReservation(id) {
            fetch(`/reservations/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Failed to fetch reservation data.");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Debug the data structure

                    document.getElementById('show_client').textContent = data.client?.name || 'N/A';
                    document.getElementById('show_service').textContent = data.service?.title || 'N/A';

                    // Check if reservation_dates is an array
                    if (Array.isArray(data.reservation_dates)) {
                        document.getElementById('show_dates').textContent = data.reservation_dates.join(', ');
                    } else {
                        document.getElementById('show_dates').textContent = 'N/A';
                    }

                    document.getElementById('show_adults').textContent = data.adults_count || 'N/A';
                    document.getElementById('show_children').textContent = data.children_count || 'N/A';
                    document.getElementById('show_total').textContent = data.total_price || 'N/A';
                    document.getElementById('show_payment_status').textContent = data.payment_status || 'N/A';
                    document.getElementById('show_status').textContent = data.status || 'N/A';

                    const showModal = new bootstrap.Modal(document.getElementById('showReservationModal'));
                    showModal.show();
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: "{{ __('messages.error') }}",
                        text: "{{ __('messages.unable_to_fetch_reservation') }}",
                        confirmButtonText: "{{ __('messages.ok') }}",
                    });
                    console.error('Error fetching reservation:', error);
                });
        }



        





    </script>
</x-app-layout>
