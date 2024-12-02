<x-app-layout>


    @section('title', __('messages.reservation_transfer_management'))

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('messages.reservation_transfer_management') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Title and Add New Reservation Button -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h1>{{ __('messages.reservation_transfer_management') }}</h1>

            <!-- Button trigger modal for Add Reservation -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReservationModal">
                + {{ __('messages.add_new_reservation') }}
            </button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-orange">
                    <tr>
                        <th scope="col">{{ __('messages.client') }}</th>
                        <th scope="col">{{ __('messages.transfer') }}</th>
                        <th scope="col">{{ __('messages.total_people') }}</th>
                        <th scope="col">{{ __('messages.total_price') }}</th>
                        <th scope="col">{{ __('messages.date') }}</th>
                        <th scope="col" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->client->name }}</td>
                            <td>{{ $reservation->transfer->departure }} - {{ $reservation->transfer->destination }}
                            </td>
                            <td>{{ $reservation->total_people }}</td>
                            <td>${{ number_format($reservation->total_price, 2) }}</td>
                            <td></td>
                            <td class="text-center">
                                <!-- Show Icon -->
                                <a href="javascript:void(0);" onclick="showReservation({{ $reservation->id }})"
                                    class="me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>

                                <!-- Edit Icon -->
                                <a href="javascript:void(0);" onclick="editReservation({{ $reservation->id }})"
                                    class="me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ __('messages.edit') }}">
                                    <i data-feather="edit" class="action-icon text-success"></i>
                                </a>

                                <!-- Delete Icon -->
                                <a href="javascript:void(0);" onclick="confirmDelete({{ $reservation->id }})"
                                    class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ __('messages.delete') }}">
                                    <i data-feather="trash" class="action-icon text-danger"></i>
                                </a>

                                <!-- Hidden delete form -->
                                <form id="delete-form-{{ $reservation->id }}"
                                    action="{{ route('reservation_transfers.destroy', $reservation->id) }}"
                                    method="POST" style="display: none;">
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
            {{ $reservations->links() }}
        </div>

        <!-- Modal for Showing Reservation Details -->
        <div class="modal fade" id="showReservationModal" tabindex="-1" aria-labelledby="showReservationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showReservationModalLabel">{{ __('messages.reservation_details') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>{{ __('messages.client') }}:</strong> <span
                                    id="reservation-client"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.client_phone') }}:</strong> <span
                                    id="reservation-client-phone"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.client_address') }}:</strong> <span
                                    id="reservation-client-address"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.client_nationality') }}:</strong> <span
                                    id="reservation-client-nationality"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.passport_number') }}:</strong> <span
                                    id="reservation-client-passport"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.transfer') }}:</strong> <span
                                    id="reservation-transfer"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.total_people') }}:</strong> <span
                                    id="reservation-people"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.total_price') }}:</strong> <span
                                    id="reservation-price"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.date') }}:</strong> <span
                                    id="reservation-date"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.start_date') }}:</strong> <span
                                    id="reservation-start_date"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.end_date') }}:</strong> <span
                                    id="reservation-end_date"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.hotel_name') }}:</strong> <span
                                    id="reservation-hotel_name"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.hotel_address') }}:</strong> <span
                                    id="reservation-hotel_address"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.flight_number') }}:</strong> <span
                                    id="reservation-flight_number"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.flight_time') }}:</strong> <span
                                    id="reservation-flight_time"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.hotel_phone') }}:</strong> <span
                                    id="reservation-hotel_phone"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.comment') }}:</strong> <span
                                    id="reservation-comment"></span></li>
                            <li class="list-group-item"><strong>{{ __('messages.type') }}:</strong> <span
                                    id="reservation-type"></span></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal for Adding New Reservation -->
        <div class="modal fade" id="addReservationModal" tabindex="-1" aria-labelledby="addReservationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addReservationModalLabel">
                            {{ __('messages.add_new_reservation') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addReservationForm" action="{{ route('reservation_transfers.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="client_id" class="form-label">{{ __('messages.clients') }}</label>
                                <select class="form-control" id="client_id" name="client_id" required>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="transfer_id" class="form-label">{{ __('messages.transfers') }}</label>
                                <select class="form-control" id="transfer_id" name="transfer_id" required
                                    onchange="updatePrice()">
                                    @foreach ($transfers as $transfer)
                                        <option value="{{ $transfer->id }}" data-price="{{ $transfer->price }}"
                                            data-min-people="{{ $transfer->min_people }}"
                                            data-max-people="{{ $transfer->max_people }}"
                                            data-estimated-time="{{ $transfer->estimated_time }}"
                                            data-type="{{ $transfer->type }}"
                                            data-departure="{{ $transfer->departure }}"
                                            data-destination="{{ $transfer->destination }}"
                                            data-start_date="{{ $transfer->start_date }}"
                                            data-end_date="{{ $transfer->end_date }}"
                                            data-price="{{ $transfer->price }}">

                                            {{ $transfer->departure }} - {{ $transfer->destination }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Display selected transfer details -->
                            <div id="transferDetailsContainer" class="mb-3">
                                <!-- Transfer details will be populated here dynamically -->
                            </div>

                            <div class="mb-3">
                                <label for="total_people"
                                    class="form-label">{{ __('messages.total_people') }}</label>
                                <input type="number" class="form-control" id="total_people" name="total_people"
                                    required oninput="updatePrice()">
                            </div>
                            <div class="mb-3">
                                <label for="total_price" class="form-label">{{ __('messages.total_price') }}</label>
                                <input type="text" class="form-control" id="total_price" name="total_price"
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="booking_date" class="form-label">{{ __('messages.date') }}</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>

                            <div class="mb-3">
                                <label for="hotel_name">{{ __('messages.hotel_name') }}</label>
                                <input type="text" class="form-control" name="hotel_name" id="hotel_name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="hotel_address">{{ __('messages.hotel_address') }}</label>
                                <input type="text" class="form-control" name="hotel_address" id="hotel_address"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="Flight_number">{{ __('messages.flight_number') }}</label>
                                <input type="text" class="form-control" name="Flight_number" id="Flight_number"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="Flight_time">{{ __('messages.flight_time') }}</label>
                                <input type="time" class="form-control" name="Flight_time"
                                    id="Flight_time" required>
                            </div>

                            <div class="mb-3">
                                <label for="hotel_phone">{{ __('messages.hotel_phone') }}</label>
                                <input type="text" class="form-control" name="hotel_phone" id="hotel_phone">
                            </div>

                            <div class="mb-3">
                                <label for="Comment">{{ __('messages.comment') }}</label>
                                <textarea class="form-control" name="Comment" id="Comment"></textarea>
                            </div>


                            <div class="alert alert-danger d-none" id="errorAlert"></div>
                            <div class="text-center d-none" id="loadingSpinner">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">{{ __('messages.loading') }}</span>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                <button type="submit"
                                    class="btn btn-primary">{{ __('messages.add_reservation') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Editing Reservation -->
        <div class="modal fade" id="editReservationModal" tabindex="-1" aria-labelledby="editReservationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReservationModalLabel">{{ __('messages.edit_reservation') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editReservationForm" method="POST">
                            @csrf
                            @method('PATCH')

                            <!-- Client selection -->
                            <div class="mb-3">
                                <label for="edit_client_id" class="form-label">{{ __('messages.client') }}</label>
                                <select class="form-control" id="edit_client_id" name="client_id" required>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Transfer selection -->
                            <div class="mb-3">
                                <label for="edit_transfer_id"
                                    class="form-label">{{ __('messages.transfer') }}</label>
                                <select class="form-control" id="edit_transfer_id" name="transfer_id" required
                                    onchange="updatePriceedit()">
                                    @foreach ($transfers as $transfer)
                                        <option value="{{ $transfer->id }}" data-price="{{ $transfer->price }}"
                                            data-min-people="{{ $transfer->min_people }}"
                                            data-max-people="{{ $transfer->max_people }}"
                                            data-estimated-time="{{ $transfer->estimated_time }}"
                                            data-type="{{ $transfer->type }}"
                                            data-departure="{{ $transfer->departure }}"
                                            data-destination="{{ $transfer->destination }}"
                                            data-start_date="{{ $transfer->start_date }}"
                                            data-end_date="{{ $transfer->end_date }}"
                                            data-price="{{ $transfer->price }}">

                                            {{ $transfer->departure }} - {{ $transfer->destination }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Display selected transfer details -->
                            <div id="editTransferDetailsContainer" class="mb-3">
                                <!-- Transfer details will be populated here dynamically -->
                            </div>

                            <!-- Total people -->
                            <div class="mb-3">
                                <label for="edit_total_people"
                                    class="form-label">{{ __('messages.total_people') }}</label>
                                <input type="number" class="form-control" id="edit_total_people"
                                    name="total_people" required oninput="updatePriceedit()">
                            </div>

                            <!-- Total price -->
                            <div class="mb-3">
                                <label for="edit_total_price"
                                    class="form-label">{{ __('messages.total_price') }}</label>
                                <input type="number" class="form-control" id="edit_total_price" name="total_price"
                                    required readonly>
                            </div>

                            <!-- Date -->
                            <div class="mb-3">
                                <label for="edit_date" class="form-label">{{ __('messages.date') }}</label>
                                <input type="date" class="form-control" id="edit_date" name="date" required>
                            </div>


                            <div class="mb-3">
                                <label for="hotel_name">{{ __('messages.hotel_name') }}</label>
                                <input type="text" class="form-control" name="hotel_name" id="hotel_name"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="hotel_address">{{ __('messages.hotel_address') }}</label>
                                <input type="text" class="form-control" name="hotel_address" id="hotel_address"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="Flight_number">{{ __('messages.flight_number') }}</label>
                                <input type="text" class="form-control" name="Flight_number" id="Flight_number"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="Flight_time">{{ __('messages.flight_time') }}</label>
                                <input type="time" class="form-control" name="Flight_time"
                                    id="Flight_time" required>
                            </div>

                            <div class="mb-3">
                                <label for="hotel_phone">{{ __('messages.hotel_phone') }}</label>
                                <input type="text" class="form-control" name="hotel_phone" id="hotel_phone">
                            </div>

                            <div class="mb-3">
                                <label for="Comment">{{ __('messages.comment') }}</label>
                                <textarea class="form-control" name="Comment" id="Comment"></textarea>
                            </div>


                            <div class="alert alert-danger d-none" id="editErrorAlert"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('messages.cancel') }}</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="submitEditReservationForm()">{{ __('messages.save_changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Notifications -->
    @if (session('success'))
        <div id="success-message" data-message="{{ session('success') }}"></div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Show Reservation Modal
        function showReservation(id) {
            fetch(`/reservation_transfers/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('reservation-client').textContent = data.client.name;
                    document.getElementById('reservation-client-phone').textContent = data.client.phone;
                    document.getElementById('reservation-client-address').textContent = data.client.address;
                    document.getElementById('reservation-client-nationality').textContent = data.client.nationality;
                    document.getElementById('reservation-client-passport').textContent = data.client.passport_number;

                    document.getElementById('reservation-transfer').textContent = data.transfer.departure + ' - ' + data
                        .transfer.destination;
                    document.getElementById('reservation-people').textContent = data.total_people;
                    document.getElementById('reservation-price').textContent = `$${data.total_price}`;
                    document.getElementById('reservation-date').textContent = data.date;
                    document.getElementById('reservation-start_date').textContent = data.transfer.start_date;
                    document.getElementById('reservation-end_date').textContent = data.transfer.end_date ? data.transfer
                        .end_date : 'N/A';
                    document.getElementById('reservation-hotel_name').textContent = data.hotel_name;
                    document.getElementById('reservation-hotel_address').textContent = data.hotel_address;
                    document.getElementById('reservation-flight_number').textContent = data.flight_number;
                    document.getElementById('reservation-flight_time').textContent = data.flight_time;
                    document.getElementById('reservation-hotel_phone').textContent = data.hotel_phone;
                    document.getElementById('reservation-comment').textContent = data.comment;
                    document.getElementById('reservation-type').textContent = data.transfer.type === 'round_trip' ?
                        'Round Trip' : 'One Way';
                })
                .catch(error => console.error('Error fetching reservation details:', error));

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('showReservationModal'));
            myModal.show();
        }


        // Confirm Delete with SweetAlert2
        function confirmDelete(id) {
            Swal.fire({
                title: '{{ __('messages.are_you_sure') }}',
                text: '{{ __('messages.cant_undo') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('messages.yes_delete') }}',
                cancelButtonText: '{{ __('messages.cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Trigger Edit Reservation modal and populate with data
        function editReservation(id) {
            fetch(`/reservation_transfers/${id}`)
                .then(response => response.json())
                .then(data => {
                    const form = document.getElementById('editReservationForm');
                    form.action = `/reservation_transfers/${id}`;

                    form.querySelector('[name="client_id"]').value = data.client_id;
                    form.querySelector('[name="transfer_id"]').value = data.transfer_id;
                    form.querySelector('[name="total_people"]').value = data.total_people;
                    form.querySelector('[name="total_price"]').value = data.total_price;
                    form.querySelector('[name="date"]').value = data.date;
                    form.querySelector('[name="hotel_name"]').value = data.hotel_name;
                    form.querySelector('[name="hotel_address"]').value = data.hotel_address;
                    form.querySelector('[name="Flight_number"]').value = data.Flight_number;
                    form.querySelector('[name="Flight_time"]').value = data.Flight_time;
                    form.querySelector('[name="hotel_phone"]').value = data.hotel_phone || '';
                    form.querySelector('[name="Comment"]').value = data.Comment || '';

                    // Update the total price based on the number of people
                    updatePriceedit();

                    const modal = new bootstrap.Modal(document.getElementById('editReservationModal'));
                    modal.show();
                })
                .catch(error => console.error('Error fetching reservation data:', error));
        }

        // Submit the Edit Reservation form
        function submitEditReservationForm() {
            const form = document.getElementById('editReservationForm');
            const spinner = document.getElementById('editLoadingSpinner');

            spinner.classList.remove('d-none'); // Show spinner

            // Simulate a loading delay and then submit the form
            setTimeout(function() {
                form.submit();
            }, 500);
        }

        // Show the transfer details in the edit modal
        function showEditTransferDetails(selectedOption) {
            const transferDetailsContainer = document.getElementById('editTransferDetailsContainer');

            // Retrieve details from the selected transfer option
            const minPeople = selectedOption.getAttribute('data-min-people');
            const maxPeople = selectedOption.getAttribute('data-max-people');
            const estimatedTime = selectedOption.getAttribute('data-estimated-time');
            const departure = selectedOption.getAttribute('data-departure');
            const destination = selectedOption.getAttribute('data-destination');
            const start_date = selectedOption.getAttribute('data-start_date');
            const end_date = selectedOption.getAttribute('data-end_date');
            const type = selectedOption.getAttribute('data-type');
            const price = selectedOption.getAttribute('data-price');

            // Update the container with the selected transfer details
            transferDetailsContainer.innerHTML = `
                <strong>Departure:</strong> ${departure} <br>
                <strong>Destination:</strong> ${destination} <br>
                 <strong>Type:</strong> ${type} <br>
                <strong>start_date:</strong> ${start_date} <br>
                ${type == 'round_trip' ? `<strong>end_date:</strong> ${end_date} <br>` : '' }
                <strong>Min People:</strong> ${minPeople} <br>
                <strong>Max People:</strong> ${maxPeople} <br>
                <strong>Price:</strong> ${price} <br>
                <strong>Estimated Time:</strong> ${estimatedTime} <br>
            `;
        }

        // Update price based on the number of people and selected transfer (for Edit Reservation)
        function updatePriceedit() {
            const transferSelect = document.getElementById('edit_transfer_id');
            const totalPeopleInput = document.getElementById('edit_total_people');
            const totalPriceInput = document.getElementById('edit_total_price');

            // Get the selected transfer's price
            const selectedTransfer = transferSelect.options[transferSelect.selectedIndex];
            const transferPrice = parseFloat(selectedTransfer.getAttribute('data-price'));

            // Calculate the total price (price per person * number of people)
            const totalPeople = totalPeopleInput.value ? parseInt(totalPeopleInput.value) : 0;
            const totalPrice = transferPrice * totalPeople;

            // Update the total price input
            totalPriceInput.value = totalPrice.toFixed(2);

            // Show transfer details when a transfer is selected
            showEditTransferDetails(selectedTransfer);
        }

        // Update price based on the number of people and selected transfer (for Reservation)
        function updatePrice() {
            var transferSelect = document.getElementById('transfer_id');
            var selectedOption = transferSelect.options[transferSelect.selectedIndex];
            var transferPrice = selectedOption.getAttribute('data-price'); // Get the price from the data-price attribute

            var totalPeople = document.getElementById('total_people').value;

            if (totalPeople && transferPrice) {
                var totalPrice = totalPeople * transferPrice;
                document.getElementById('total_price').value = totalPrice.toFixed(2); // Display total price
            } else {
                document.getElementById('total_price').value = ''; // Clear if no valid input
            }

            // Show transfer details when a transfer is selected
            showTransferDetails(selectedOption);
        }

        // Show details of the selected transfer in the modal
        function showTransferDetails(selectedOption) {
            const transferDetailsContainer = document.getElementById('transferDetailsContainer');

            // Retrieve details from the selected transfer option
            const minPeople = selectedOption.getAttribute('data-min-people');
            const maxPeople = selectedOption.getAttribute('data-max-people');
            const estimatedTime = selectedOption.getAttribute('data-estimated-time');
            const departure = selectedOption.getAttribute('data-departure');
            const destination = selectedOption.getAttribute('data-destination');
            const start_date = selectedOption.getAttribute('data-start_date');
            const end_date = selectedOption.getAttribute('data-end_date');
            const type = selectedOption.getAttribute('data-type');
            const price = selectedOption.getAttribute('data-price');

            // Update the modal with the selected transfer details
            transferDetailsContainer.innerHTML = `
                <strong>Departure:</strong> ${departure} <br>
                <strong>Destination:</strong> ${destination} <br>
                 <strong>Type:</strong> ${type} <br>
                <strong>start_date:</strong> ${start_date} <br>
                ${type == 'round_trip' ? `<strong>end_date:</strong> ${end_date} <br>` : '' }
                <strong>Min People:</strong> ${minPeople} <br>
                <strong>Max People:</strong> ${maxPeople} <br>
                <strong>Price:</strong> ${price} <br>
                <strong>Estimated Time:</strong> ${estimatedTime} <br>
            `;
        }

        // Event listener to call updatePrice when the form loads
        document.addEventListener('DOMContentLoaded', function() {
            updatePrice(); // Call on page load in case there's already a transfer selected
        });

        // Handle form submission success and trigger SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                const message = successMessage.getAttribute('data-message');
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
