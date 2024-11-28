<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('messages.transfers') }}
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

        <!-- Add New Transfer Button -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h1>{{ __('messages.transfers_list') }}</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransferModal">
                + {{ __('messages.add_transfer') }}
            </button>
        </div>

        <!-- Transfer Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-orange">
                    <tr>
                        <th>{{ __('messages.departure') }}</th>
                        <th>{{ __('messages.destination') }}</th>
                        <th>{{ __('messages.type') }}</th>
                        <th>{{ __('messages.price') }}</th>
                        <th>{{ __('messages.min_people') }}</th>
                        <th>{{ __('messages.max_people') }}</th>
                        <th>{{ __('messages.estimated_time') }}</th>
                        <th class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfers as $transfer)
                        <tr>
                            <td>{{ $transfer->departure }}</td>
                            <td>{{ $transfer->destination }}</td>
                            <td>{{ $transfer->type }}</td>
                            <td>${{ number_format($transfer->price, 2) }}</td>
                            <td>{{ $transfer->min_people }}</td>
                            <td>{{ $transfer->max_people }}</td>
                            <td>{{ $transfer->estimated_time ? $transfer->estimated_time . ' mins' : 'N/A' }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0);" onclick="showTransfer({{ $transfer->id }})"
                                    class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="editTransfer({{ $transfer->id }})"
                                    class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.edit') }}">
                                    <i data-feather="edit" class="action-icon text-success"></i>
                                </a>

                                <a href="javascript:void(0);" onclick="confirmDelete({{ $transfer->id }})"
                                    class="text-danger" data-bs-toggle="tooltip" title="{{ __('messages.delete') }}">
                                    <i data-feather="trash" class="action-icon text-danger"></i>
                                </a>

                                <form id="delete-form-{{ $transfer->id }}"
                                    action="{{ route('transfers.destroy', $transfer->id) }}" method="POST"
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
            {{ $transfers->links() }}
        </div>
    </div>

    <!-- Add Transfer Modal -->
    <div class="modal fade" id="addTransferModal" tabindex="-1" aria-labelledby="addTransferModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransferModalLabel">{{ __('messages.add_transfer') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTransferForm" action="{{ route('transfers.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('messages.image') }}</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="departure" class="form-label">{{ __('messages.departure') }}</label>
                            <select name="departure" class="form-select" required>
                                <option value="AGAFAY">AGAFAY</option>
                                <option value="MARRAKECH_CENTRE_VILLE">MARRAKECH CENTRE VILLE</option>
                                <option value="LA_PALMERAIE_MARRAKECH">LA PALMERAIE MARRAKECH</option>
                                <option value="LES_ENVIRONS_DE_MARRAKECH">LES ENVIRONS DE MARRAKECH</option>
                                <option value="ESSAOURIA">ESSAOURIA</option>
                                <option value="CASABLANCA_CENTER_VILLE">CASABLANCA CENTER VILLE</option>
                                <option value="RABAT">RABAT</option>
                                <option value="AGADIR">AGADIR</option>
                                <option value="TIZNIT">TIZNIT</option>
                                <option value="OUARZAZATE">OUARZAZATE</option>
                                <option value="FES">FES</option>
                                <option value="MERZOUGA">MERZOUGA</option>
                                <option value="TANGIER">TANGIER</option>
                                <option value="OUKAIMEDEN">OUKAIMEDEN</option>
                                <option value="ZAGORA">ZAGORA</option>
                                <option value="ARFOUD">ARFOUD</option>
                                <option value="SETTI_FADMA">SETTI FADMA</option>
                                <option value="IMLIL">IMLIL</option>
                                <option value="BIN_EL_OUIDANE">BIN EL OUIDANE</option>
                                <option value="MAZAGANE">MAZAGANE</option>
                                <option value="TAROUDANT">TAROUDANT</option>
                                <option value="TAGHAZOUT">TAGHAZOUT</option>
                                <option value="INEZGANE">INEZGANE</option>
                                <option value="TOUBKAL">TOUBKAL</option>
                                <option value="BENGUERIR">BENGUERIR</option>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">{{ __('messages.destination') }}</label>
                            <select name="destination" class="form-select" required>
                                <option value="AGAFAY">AGAFAY</option>
                                <option value="MARRAKECH_CENTRE_VILLE">MARRAKECH CENTRE VILLE</option>
                                <option value="LA_PALMERAIE_MARRAKECH">LA PALMERAIE MARRAKECH</option>
                                <option value="LES_ENVIRONS_DE_MARRAKECH">LES ENVIRONS DE MARRAKECH</option>
                                <option value="ESSAOURIA">ESSAOURIA</option>
                                <option value="CASABLANCA_CENTER_VILLE">CASABLANCA CENTER VILLE</option>
                                <option value="RABAT">RABAT</option>
                                <option value="AGADIR">AGADIR</option>
                                <option value="TIZNIT">TIZNIT</option>
                                <option value="OUARZAZATE">OUARZAZATE</option>
                                <option value="FES">FES</option>
                                <option value="MERZOUGA">MERZOUGA</option>
                                <option value="TANGIER">TANGIER</option>
                                <option value="OUKAIMEDEN">OUKAIMEDEN</option>
                                <option value="ZAGORA">ZAGORA</option>
                                <option value="ARFOUD">ARFOUD</option>
                                <option value="SETTI_FADMA">SETTI FADMA</option>
                                <option value="IMLIL">IMLIL</option>
                                <option value="BIN_EL_OUIDANE">BIN EL OUIDANE</option>
                                <option value="MAZAGANE">MAZAGANE</option>
                                <option value="TAROUDANT">TAROUDANT</option>
                                <option value="TAGHAZOUT">TAGHAZOUT</option>
                                <option value="INEZGANE">INEZGANE</option>
                                <option value="TOUBKAL">TOUBKAL</option>
                                <option value="BENGUERIR">BENGUERIR</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">{{ __('messages.type') }}</label>
                            <select name="type" class="form-select" required>
                                <option value="one_way">{{ __('messages.one_way') }}</option>
                                <option value="round_trip">{{ __('messages.round_trip') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('messages.price') }}</label>
                            <input type="number" name="price" class="form-control" step="0.01" min="0"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="min_people" class="form-label">{{ __('messages.min_people') }}</label>
                            <input type="number" name="min_people" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="max_people" class="form-label">{{ __('messages.max_people') }}</label>
                            <input type="number" name="max_people" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="estimated_time"
                                class="form-label">{{ __('messages.estimated_time') }}</label>
                            <input type="number" name="estimated_time" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.add_transfer') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Transfer Modal -->
    <div class="modal fade" id="editTransferModal" tabindex="-1" aria-labelledby="editTransferModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransferModalLabel">{{ __('messages.edit_transfer') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTransferForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('messages.image') }}</label>
                            <input type="file" name="image" class="form-control" id="imageInput">
                            <img id="imagePreview" src="" alt="Current Image" class="mt-3 d-none"
                                style="max-width: 100%; height: auto;">
                        </div>
                        <div class="mb-3">
                            <label for="departure" class="form-label">{{ __('messages.departure') }}</label>
                            <select name="departure" class="form-select" required>
                                <option value="AGAFAY">AGAFAY</option>
                                <option value="MARRAKECH_CENTRE_VILLE">MARRAKECH CENTRE VILLE</option>
                                <option value="LA_PALMERAIE_MARRAKECH">LA PALMERAIE MARRAKECH</option>
                                <option value="LES_ENVIRONS_DE_MARRAKECH">LES ENVIRONS DE MARRAKECH</option>
                                <option value="ESSAOURIA">ESSAOURIA</option>
                                <option value="CASABLANCA_CENTER_VILLE">CASABLANCA CENTER VILLE</option>
                                <option value="RABAT">RABAT</option>
                                <option value="AGADIR">AGADIR</option>
                                <option value="TIZNIT">TIZNIT</option>
                                <option value="OUARZAZATE">OUARZAZATE</option>
                                <option value="FES">FES</option>
                                <option value="MERZOUGA">MERZOUGA</option>
                                <option value="TANGIER">TANGIER</option>
                                <option value="OUKAIMEDEN">OUKAIMEDEN</option>
                                <option value="ZAGORA">ZAGORA</option>
                                <option value="ARFOUD">ARFOUD</option>
                                <option value="SETTI_FADMA">SETTI FADMA</option>
                                <option value="IMLIL">IMLIL</option>
                                <option value="BIN_EL_OUIDANE">BIN EL OUIDANE</option>
                                <option value="MAZAGANE">MAZAGANE</option>
                                <option value="TAROUDANT">TAROUDANT</option>
                                <option value="TAGHAZOUT">TAGHAZOUT</option>
                                <option value="INEZGANE">INEZGANE</option>
                                <option value="TOUBKAL">TOUBKAL</option>
                                <option value="BENGUERIR">BENGUERIR</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">{{ __('messages.destination') }}</label>
                            <select name="destination" class="form-select" required>
                                <option value="AGAFAY">AGAFAY</option>
                                <option value="MARRAKECH_CENTRE_VILLE">MARRAKECH CENTRE VILLE</option>
                                <option value="LA_PALMERAIE_MARRAKECH">LA PALMERAIE MARRAKECH</option>
                                <option value="LES_ENVIRONS_DE_MARRAKECH">LES ENVIRONS DE MARRAKECH</option>
                                <option value="ESSAOURIA">ESSAOURIA</option>
                                <option value="CASABLANCA_CENTER_VILLE">CASABLANCA CENTER VILLE</option>
                                <option value="RABAT">RABAT</option>
                                <option value="AGADIR">AGADIR</option>
                                <option value="TIZNIT">TIZNIT</option>
                                <option value="OUARZAZATE">OUARZAZATE</option>
                                <option value="FES">FES</option>
                                <option value="MERZOUGA">MERZOUGA</option>
                                <option value="TANGIER">TANGIER</option>
                                <option value="OUKAIMEDEN">OUKAIMEDEN</option>
                                <option value="ZAGORA">ZAGORA</option>
                                <option value="ARFOUD">ARFOUD</option>
                                <option value="SETTI_FADMA">SETTI FADMA</option>
                                <option value="IMLIL">IMLIL</option>
                                <option value="BIN_EL_OUIDANE">BIN EL OUIDANE</option>
                                <option value="MAZAGANE">MAZAGANE</option>
                                <option value="TAROUDANT">TAROUDANT</option>
                                <option value="TAGHAZOUT">TAGHAZOUT</option>
                                <option value="INEZGANE">INEZGANE</option>
                                <option value="TOUBKAL">TOUBKAL</option>
                                <option value="BENGUERIR">BENGUERIR</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">{{ __('messages.type') }}</label>
                            <select name="type" class="form-select" required>
                                <option value="one_way">{{ __('messages.one_way') }}</option>
                                <option value="round_trip">{{ __('messages.round_trip') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('messages.price') }}</label>
                            <input type="number" name="price" class="form-control" step="0.01" min="0"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="min_people" class="form-label">{{ __('messages.min_people') }}</label>
                            <input type="number" name="min_people" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="max_people" class="form-label">{{ __('messages.max_people') }}</label>
                            <input type="number" name="max_people" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="estimated_time"
                                class="form-label">{{ __('messages.estimated_time') }}</label>
                            <input type="number" name="estimated_time" class="form-control">
                        </div>
                        <!-- Loading spinner -->
                        <div class="text-center d-none" id="editLoadingSpinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary"
                            onclick="submitEditTransferForm()">{{ __('messages.save_changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Show Transfer Modal -->
    <div class="modal fade" id="showTransferModal" tabindex="-1" aria-labelledby="showTransferModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showTransferModalLabel">{{ __('messages.transfer_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>{{ __('messages.departure') }}:</strong> <span id="transfer-departure"></span></p>
                    <p><strong>{{ __('messages.destination') }}:</strong> <span id="transfer-destination"></span></p>
                    <p><strong>{{ __('messages.type') }}:</strong> <span id="transfer-type"></span></p>
                    <p><strong>{{ __('messages.price') }}:</strong> <span id="transfer-price"></span></p>
                    <p><strong>{{ __('messages.min_people') }}:</strong> <span id="transfer-min-people"></span></p>
                    <p><strong>{{ __('messages.max_people') }}:</strong> <span id="transfer-max-people"></span></p>
                    <p><strong>{{ __('messages.estimated_time') }}:</strong> <span
                            id="transfer-estimated-time"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showTransfer(id) {
            fetch(`/transfers/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('transfer-departure').textContent = data.departure;
                    document.getElementById('transfer-destination').textContent = data.destination;
                    document.getElementById('transfer-type').textContent = data.type;
                    document.getElementById('transfer-price').textContent = `$${data.price}`;
                    document.getElementById('transfer-min-people').textContent = data.min_people;
                    document.getElementById('transfer-max-people').textContent = data.max_people;
                    document.getElementById('transfer-estimated-time').textContent = data.estimated_time || 'N/A';

                    const modal = new bootstrap.Modal(document.getElementById('showTransferModal'));
                    modal.show();
                });
        }

        // Trigger Edit Transfer modal and populate with data
        function editTransfer(id) {
            fetch(`/transfers/${id}`)
                .then(response => response.json())
                .then(data => {
                    const form = document.getElementById('editTransferForm');

                    form.action = `/transfers/${id}`;

                    form.querySelector('[name="departure"]').value = data.departure;
                    form.querySelector('[name="destination"]').value = data.destination;
                    form.querySelector('[name="type"]').value = data.type;
                    form.querySelector('[name="price"]').value = data.price;
                    form.querySelector('[name="min_people"]').value = data.min_people;
                    form.querySelector('[name="max_people"]').value = data.max_people;
                    form.querySelector('[name="estimated_time"]').value = data.estimated_time || '';

                    const imageInput = document.getElementById('imageInput');
                    const imagePreview = document.getElementById('imagePreview');

                    if (data.image) {
                        imagePreview.src = `/uploads/transfers/${data.image}`;
                        imagePreview.classList.remove('d-none');
                    } else {
                        imagePreview.classList.add('d-none');
                    }

                    const modal = new bootstrap.Modal(document.getElementById('editTransferModal'));
                    modal.show();
                })
                .catch(error => console.error('Error fetching transfer data:', error));
        }


        // Submit the Edit Transfer form
        function submitEditTransferForm() {
            const form = document.getElementById('editTransferForm');
            const spinner = document.getElementById('editLoadingSpinner');

            spinner.classList.remove('d-none'); // Show spinner

            // Simulate a loading delay and then submit the form
            setTimeout(function() {
                form.submit();
            }, 500);
        }

        // Confirm delete with SweetAlert2
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
    </script>
</x-app-layout>