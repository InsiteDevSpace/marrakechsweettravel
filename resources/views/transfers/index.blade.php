<x-app-layout>





    @section('title', __('messages.transfers'))




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
    <table class="table table-hover align-middle border rounded shadow-sm">
        <!-- Table Header -->
        <thead class="bg-light border-bottom">
            <tr>
                <th scope="col" class="text-center" style="width: 80px;">{{ __('messages.image') }}</th>
                <th>{{ __('messages.departure') }}</th>
                <th>{{ __('messages.destination') }}</th>
                <th>{{ __('messages.type') }}</th>
                <th>{{ __('messages.price') }}</th>
                <th>{{ __('messages.start_date') }}</th>
                <th>{{ __('messages.end_date') }}</th>
                <th>{{ __('messages.min_people') }}</th>
                <th>{{ __('messages.max_people') }}</th>
                <th>{{ __('messages.estimated_time') }}</th>
                <th class="text-center">{{ __('messages.actions') }}</th>
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody>
            @foreach ($transfers as $transfer)
                <tr>

                    <td class="text-center">
                        @if ($transfer->image)
                            <img 
                                src="/uploads/transfers/{{ $transfer->image }}" 
                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                        @else
                            <span class="text-muted">{{ __('messages.no_image') }}</span>
                        @endif
                    </td>
                    <!-- Departure -->
                    <td>
                        <span class="fw-bold">{{ $transfer->departure }}</span>
                    </td>

                    <!-- Destination -->
                    <td>
                        <span class="badge bg-info text-dark">{{ $transfer->destination }}</span>
                    </td>

                    <!-- Type -->
                    <td>
                        @switch($transfer->type)
                            @case('one_way')
                                <span class="badge bg-primary">{{ __('messages.one_way') }}</span>
                                @break
                            @case('round_trip')
                                <span class="badge bg-success">{{ __('messages.round_trip') }}</span>
                                @break
                            @default
                                <span class="badge bg-secondary">{{ __('messages.unknown') }}</span>
                        @endswitch
                    </td>

                    <!-- Price -->
                    <td>
                        <span class="fw-bold text-success">
                            ${{ number_format($transfer->price, 2) }}
                        </span>
                    </td>

                    <!-- Start Date -->
                    <td>
                        <span class="badge bg-light text-dark">
                            {{ $transfer->start_date }}
                        </span>
                    </td>

                    <!-- End Date -->
                    <td>
                        @if($transfer->end_date)
                            <span class="badge bg-light text-dark">
                                {{ $transfer->end_date }}
                            </span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <!-- Min People -->
                    <td>
                        <span class="badge bg-primary text-white">
                            {{ $transfer->min_people }}
                        </span>
                    </td>

                    <!-- Max People -->
                    <td>
                        <span class="badge bg-warning text-dark">
                            {{ $transfer->max_people }}
                        </span>
                    </td>

                    <!-- Estimated Time -->
                    <td>
                        @if($transfer->estimated_time)
                            <span class="fw-semibold">{{ $transfer->estimated_time }} {{ __('messages.minutes') }}</span>
                        @else
                            <span class="text-muted">{{ __('messages.not_applicable') }}</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="text-center">
                        <a href="javascript:void(0);" onclick="showTransfer({{ $transfer->id }})" 
                            class="text-info me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="javascript:void(0);" onclick="editTransfer({{ $transfer->id }})" 
                            class="text-primary me-2" data-bs-toggle="tooltip" title="{{ __('messages.edit') }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="javascript:void(0);" onclick="confirmDelete({{ $transfer->id }})" 
                            class="text-danger" data-bs-toggle="tooltip" title="{{ __('messages.delete') }}">
                            <i class="bi bi-trash"></i>
                        </a>
                        <!-- Delete Form -->
                        <form id="delete-form-{{ $transfer->id }}" 
                            action="{{ route('transfers.destroy', $transfer->id) }}" method="POST" style="display: none;">
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
                        <!-- Image upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('messages.image') }}</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>

                        <!-- Departure select -->
                        <div class="mb-3">
                            <label for="departure" class="form-label">{{ __('messages.departure') }}</label>
                            <select name="departure" class="form-select" required>
                                <!-- Aéroport Section -->
                                <optgroup label="Aéroport">
                                    <option value="Aéroport de Marrakech (RAK)">Aéroport de Marrakech (RAK)</option>
                                    <option value="Aéroport de Casablanca (CMN)">Aéroport de Casablanca (CMN)</option>
                                    <option value="Aéroport d'Agadir (AGA)">Aéroport d'Agadir (AGA)</option>
                                    <option value="Aéroport d'Essaouira (ESU)">Aéroport d'Essaouira (ESU)</option>
                                    <option value="Aéroport de Ouarzazate (OZZ)">Aéroport de Ouarzazate (OZZ)</option>
                                    <option value="Aéroport de Fès (FEZ)">Aéroport de Fès (FEZ)</option>
                                    <option value="Station de train">Station de train</option>
                                    <option value="Aéroport de Tangier (TNG)">Aéroport de Tangier (TNG)</option>
                                    <option value="Aéroport Rabat (RBA)">Aéroport Rabat (RBA)</option>
                                    <option value="Aéroport Nador (NDR)">Aéroport Nador (NDR)</option>
                                    <option value="Aéroport Al Hoceima (AHU)">Aéroport Al Hoceima (AHU)</option>
                                </optgroup>

                                <!-- Villes Section -->
                                <optgroup label="Villes">
                                    <option value="Agafay">Agafay</option>
                                    <option value="Marrakech Centre Ville">Marrakech Centre Ville</option>
                                    <option value="La Palmeraie Marrakech">La Palmeraie Marrakech</option>
                                    <option value="Les environs de Marrakech">Les environs de Marrakech</option>
                                    <option value="Essaouira">Essaouira</option>
                                    <option value="Casablanca Centre Ville">Casablanca Centre Ville</option>
                                    <option value="Rabat">Rabat</option>
                                    <option value="Agadir">Agadir</option>
                                    <option value="Tiznit">Tiznit</option>
                                    <option value="Ouarzazate">Ouarzazate</option>
                                    <option value="Erfoud">Erfoud</option>
                                    <option value="Fès">Fès</option>
                                    <option value="Merzouga">Merzouga</option>
                                    <option value="El Jadida">El Jadida</option>
                                    <option value="Chefchaouen">Chefchaouen</option>
                                    <option value="Tangier">Tangier</option>
                                    <option value="Safi">Safi</option>
                                    <option value="Oukaimeden">Oukaimeden</option>
                                    <option value="Zagora">Zagora</option>
                                    <option value="Arfoud">Arfoud</option>
                                    <option value="Setti Fadma">Setti Fadma</option>
                                    <option value="Sidi Ifni">Sidi Ifni</option>
                                    <option value="Imlil">Imlil</option>
                                    <option value="Sidi Kaouki">Sidi Kaouki</option>
                                    <option value="Tafraoute">Tafraoute</option>
                                    <option value="Tamraght">Tamraght</option>
                                    <option value="Tiguert">Tiguert</option>
                                    <option value="Skoura">Skoura</option>
                                    <option value="Tinghir">Tinghir</option>
                                    <option value="Ouirgane">Ouirgane</option>
                                    <option value="Bin El Ouidane">Bin El Ouidane</option>
                                    <option value="Demnate">Demnate</option>
                                    <option value="Mazagane">Mazagane</option>
                                    <option value="Tamadot">Tamadot</option>
                                    <option value="Asni">Asni</option>
                                    <option value="Taroudant">Taroudant</option>
                                    <option value="Taghazout">Taghazout</option>
                                    <option value="Meknes">Meknes</option>
                                    <option value="Oualidia">Oualidia</option>
                                    <option value="Paradis Plage">Paradis Plage</option>
                                    <option value="Aourir">Aourir</option>
                                    <option value="Beni-Mellal">Beni-Mellal</option>
                                    <option value="Imouzzer">Imouzzer</option>
                                    <option value="Imsouane">Imsouane</option>
                                    <option value="Inezgane">Inezgane</option>
                                    <option value="Mirleft">Mirleft</option>
                                    <option value="Toubkal">Toubkal</option>
                                    <option value="Tetouan">Tetouan</option>
                                    <option value="Settat">Settat</option>
                                    <option value="T'mara">T'mara</option>
                                    <option value="Ouzoud">Ouzoud</option>
                                    <option value="Azilal">Azilal</option>
                                    <option value="Errachidia">Errachidia</option>
                                    <option value="Benguerir">Benguerir</option>
                                </optgroup>
                            </select>

                            
                        </div>

                        <!-- Destination select -->
                        <div class="mb-3">
                            <label for="destination" class="form-label">{{ __('messages.destination') }}</label>
                            <select name="destination" class="form-select" required>
                                  <!-- Aéroport Section -->
                                <optgroup label="Aéroport">
                                    <option value="Aéroport de Marrakech (RAK)">Aéroport de Marrakech (RAK)</option>
                                    <option value="Aéroport de Casablanca (CMN)">Aéroport de Casablanca (CMN)</option>
                                    <option value="Aéroport d'Agadir (AGA)">Aéroport d'Agadir (AGA)</option>
                                    <option value="Aéroport d'Essaouira (ESU)">Aéroport d'Essaouira (ESU)</option>
                                    <option value="Aéroport de Ouarzazate (OZZ)">Aéroport de Ouarzazate (OZZ)</option>
                                    <option value="Aéroport de Fès (FEZ)">Aéroport de Fès (FEZ)</option>
                                    <option value="Station de train">Station de train</option>
                                    <option value="Aéroport de Tangier (TNG)">Aéroport de Tangier (TNG)</option>
                                    <option value="Aéroport Rabat (RBA)">Aéroport Rabat (RBA)</option>
                                    <option value="Aéroport Nador (NDR)">Aéroport Nador (NDR)</option>
                                    <option value="Aéroport Al Hoceima (AHU)">Aéroport Al Hoceima (AHU)</option>
                                </optgroup>

                                <!-- Villes Section -->
                                <optgroup label="Villes">
                                    <option value="Agafay">Agafay</option>
                                    <option value="Marrakech Centre Ville">Marrakech Centre Ville</option>
                                    <option value="La Palmeraie Marrakech">La Palmeraie Marrakech</option>
                                    <option value="Les environs de Marrakech">Les environs de Marrakech</option>
                                    <option value="Essaouira">Essaouira</option>
                                    <option value="Casablanca Centre Ville">Casablanca Centre Ville</option>
                                    <option value="Rabat">Rabat</option>
                                    <option value="Agadir">Agadir</option>
                                    <option value="Tiznit">Tiznit</option>
                                    <option value="Ouarzazate">Ouarzazate</option>
                                    <option value="Erfoud">Erfoud</option>
                                    <option value="Fès">Fès</option>
                                    <option value="Merzouga">Merzouga</option>
                                    <option value="El Jadida">El Jadida</option>
                                    <option value="Chefchaouen">Chefchaouen</option>
                                    <option value="Tangier">Tangier</option>
                                    <option value="Safi">Safi</option>
                                    <option value="Oukaimeden">Oukaimeden</option>
                                    <option value="Zagora">Zagora</option>
                                    <option value="Arfoud">Arfoud</option>
                                    <option value="Setti Fadma">Setti Fadma</option>
                                    <option value="Sidi Ifni">Sidi Ifni</option>
                                    <option value="Imlil">Imlil</option>
                                    <option value="Sidi Kaouki">Sidi Kaouki</option>
                                    <option value="Tafraoute">Tafraoute</option>
                                    <option value="Tamraght">Tamraght</option>
                                    <option value="Tiguert">Tiguert</option>
                                    <option value="Skoura">Skoura</option>
                                    <option value="Tinghir">Tinghir</option>
                                    <option value="Ouirgane">Ouirgane</option>
                                    <option value="Bin El Ouidane">Bin El Ouidane</option>
                                    <option value="Demnate">Demnate</option>
                                    <option value="Mazagane">Mazagane</option>
                                    <option value="Tamadot">Tamadot</option>
                                    <option value="Asni">Asni</option>
                                    <option value="Taroudant">Taroudant</option>
                                    <option value="Taghazout">Taghazout</option>
                                    <option value="Meknes">Meknes</option>
                                    <option value="Oualidia">Oualidia</option>
                                    <option value="Paradis Plage">Paradis Plage</option>
                                    <option value="Aourir">Aourir</option>
                                    <option value="Beni-Mellal">Beni-Mellal</option>
                                    <option value="Imouzzer">Imouzzer</option>
                                    <option value="Imsouane">Imsouane</option>
                                    <option value="Inezgane">Inezgane</option>
                                    <option value="Mirleft">Mirleft</option>
                                    <option value="Toubkal">Toubkal</option>
                                    <option value="Tetouan">Tetouan</option>
                                    <option value="Settat">Settat</option>
                                    <option value="T'mara">T'mara</option>
                                    <option value="Ouzoud">Ouzoud</option>
                                    <option value="Azilal">Azilal</option>
                                    <option value="Errachidia">Errachidia</option>
                                    <option value="Benguerir">Benguerir</option>
                                </optgroup>

                            </select>
                        </div>

                        <!-- Type selection -->
                        <div class="mb-3">
                            <label for="type" class="form-label">{{ __('messages.type') }}</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="one_way">{{ __('messages.one_way') }}</option>
                                <option value="round_trip">{{ __('messages.round_trip') }}</option>
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="mb-3">
                            <label for="start_date" class="form-label">{{ __('messages.start_date') }}</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <!-- End Date (hidden initially) -->
                        <div class="mb-3" id="endDateField" style="display: none;">
                            <label for="end_date" class="form-label">{{ __('messages.end_date') }}</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>

                        <!-- Price field -->
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('messages.price') }}</label>
                            <input type="number" name="price" class="form-control" step="0.01" min="0"
                                required>
                        </div>

                        <!-- Min People field -->
                        <div class="mb-3">
                            <label for="min_people" class="form-label">{{ __('messages.min_people') }}</label>
                            <input type="number" name="min_people" class="form-control" min="1" required>
                        </div>

                        <!-- Max People field -->
                        <div class="mb-3">
                            <label for="max_people" class="form-label">{{ __('messages.max_people') }}</label>
                            <input type="number" name="max_people" class="form-control" min="1" required>
                        </div>

                        <!-- Estimated Time field -->
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

                        <!-- Image upload with preview -->
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('messages.image') }}</label>
                            <input type="file" name="image" class="form-control" id="imageInput">
                            <img id="imagePreview" src="" alt="Current Image" class="mt-3 d-none"
                                style="max-width: 100%; height: auto;">
                        </div>

                        <!-- Departure select -->
                        <div class="mb-3">
                            <label for="departure" class="form-label">{{ __('messages.departure') }}</label>
                            <select name="departure" class="form-select" required>
                                <!-- Aéroport Section -->
                                <optgroup label="Aéroport">
                                    <option value="Aéroport de Marrakech (RAK)">Aéroport de Marrakech (RAK)</option>
                                    <option value="Aéroport de Casablanca (CMN)">Aéroport de Casablanca (CMN)</option>
                                    <option value="Aéroport d'Agadir (AGA)">Aéroport d'Agadir (AGA)</option>
                                    <option value="Aéroport d'Essaouira (ESU)">Aéroport d'Essaouira (ESU)</option>
                                    <option value="Aéroport de Ouarzazate (OZZ)">Aéroport de Ouarzazate (OZZ)</option>
                                    <option value="Aéroport de Fès (FEZ)">Aéroport de Fès (FEZ)</option>
                                    <option value="Station de train">Station de train</option>
                                    <option value="Aéroport de Tangier (TNG)">Aéroport de Tangier (TNG)</option>
                                    <option value="Aéroport Rabat (RBA)">Aéroport Rabat (RBA)</option>
                                    <option value="Aéroport Nador (NDR)">Aéroport Nador (NDR)</option>
                                    <option value="Aéroport Al Hoceima (AHU)">Aéroport Al Hoceima (AHU)</option>
                                </optgroup>

                                <!-- Villes Section -->
                                <optgroup label="Villes">
                                    <option value="Agafay">Agafay</option>
                                    <option value="Marrakech Centre Ville">Marrakech Centre Ville</option>
                                    <option value="La Palmeraie Marrakech">La Palmeraie Marrakech</option>
                                    <option value="Les environs de Marrakech">Les environs de Marrakech</option>
                                    <option value="Essaouira">Essaouira</option>
                                    <option value="Casablanca Centre Ville">Casablanca Centre Ville</option>
                                    <option value="Rabat">Rabat</option>
                                    <option value="Agadir">Agadir</option>
                                    <option value="Tiznit">Tiznit</option>
                                    <option value="Ouarzazate">Ouarzazate</option>
                                    <option value="Erfoud">Erfoud</option>
                                    <option value="Fès">Fès</option>
                                    <option value="Merzouga">Merzouga</option>
                                    <option value="El Jadida">El Jadida</option>
                                    <option value="Chefchaouen">Chefchaouen</option>
                                    <option value="Tangier">Tangier</option>
                                    <option value="Safi">Safi</option>
                                    <option value="Oukaimeden">Oukaimeden</option>
                                    <option value="Zagora">Zagora</option>
                                    <option value="Arfoud">Arfoud</option>
                                    <option value="Setti Fadma">Setti Fadma</option>
                                    <option value="Sidi Ifni">Sidi Ifni</option>
                                    <option value="Imlil">Imlil</option>
                                    <option value="Sidi Kaouki">Sidi Kaouki</option>
                                    <option value="Tafraoute">Tafraoute</option>
                                    <option value="Tamraght">Tamraght</option>
                                    <option value="Tiguert">Tiguert</option>
                                    <option value="Skoura">Skoura</option>
                                    <option value="Tinghir">Tinghir</option>
                                    <option value="Ouirgane">Ouirgane</option>
                                    <option value="Bin El Ouidane">Bin El Ouidane</option>
                                    <option value="Demnate">Demnate</option>
                                    <option value="Mazagane">Mazagane</option>
                                    <option value="Tamadot">Tamadot</option>
                                    <option value="Asni">Asni</option>
                                    <option value="Taroudant">Taroudant</option>
                                    <option value="Taghazout">Taghazout</option>
                                    <option value="Meknes">Meknes</option>
                                    <option value="Oualidia">Oualidia</option>
                                    <option value="Paradis Plage">Paradis Plage</option>
                                    <option value="Aourir">Aourir</option>
                                    <option value="Beni-Mellal">Beni-Mellal</option>
                                    <option value="Imouzzer">Imouzzer</option>
                                    <option value="Imsouane">Imsouane</option>
                                    <option value="Inezgane">Inezgane</option>
                                    <option value="Mirleft">Mirleft</option>
                                    <option value="Toubkal">Toubkal</option>
                                    <option value="Tetouan">Tetouan</option>
                                    <option value="Settat">Settat</option>
                                    <option value="T'mara">T'mara</option>
                                    <option value="Ouzoud">Ouzoud</option>
                                    <option value="Azilal">Azilal</option>
                                    <option value="Errachidia">Errachidia</option>
                                    <option value="Benguerir">Benguerir</option>
                                </optgroup>
                            </select>
                        </div>

                        <!-- Destination select -->
                        <div class="mb-3">
                            <label for="destination" class="form-label">{{ __('messages.destination') }}</label>
                            <select name="destination" class="form-select" required>
                                  <!-- Aéroport Section -->
                                <optgroup label="Aéroport">
                                    <option value="Aéroport de Marrakech (RAK)">Aéroport de Marrakech (RAK)</option>
                                    <option value="Aéroport de Casablanca (CMN)">Aéroport de Casablanca (CMN)</option>
                                    <option value="Aéroport d'Agadir (AGA)">Aéroport d'Agadir (AGA)</option>
                                    <option value="Aéroport d'Essaouira (ESU)">Aéroport d'Essaouira (ESU)</option>
                                    <option value="Aéroport de Ouarzazate (OZZ)">Aéroport de Ouarzazate (OZZ)</option>
                                    <option value="Aéroport de Fès (FEZ)">Aéroport de Fès (FEZ)</option>
                                    <option value="Station de train">Station de train</option>
                                    <option value="Aéroport de Tangier (TNG)">Aéroport de Tangier (TNG)</option>
                                    <option value="Aéroport Rabat (RBA)">Aéroport Rabat (RBA)</option>
                                    <option value="Aéroport Nador (NDR)">Aéroport Nador (NDR)</option>
                                    <option value="Aéroport Al Hoceima (AHU)">Aéroport Al Hoceima (AHU)</option>
                                </optgroup>

                                <!-- Villes Section -->
                                <optgroup label="Villes">
                                    <option value="Agafay">Agafay</option>
                                    <option value="Marrakech Centre Ville">Marrakech Centre Ville</option>
                                    <option value="La Palmeraie Marrakech">La Palmeraie Marrakech</option>
                                    <option value="Les environs de Marrakech">Les environs de Marrakech</option>
                                    <option value="Essaouira">Essaouira</option>
                                    <option value="Casablanca Centre Ville">Casablanca Centre Ville</option>
                                    <option value="Rabat">Rabat</option>
                                    <option value="Agadir">Agadir</option>
                                    <option value="Tiznit">Tiznit</option>
                                    <option value="Ouarzazate">Ouarzazate</option>
                                    <option value="Erfoud">Erfoud</option>
                                    <option value="Fès">Fès</option>
                                    <option value="Merzouga">Merzouga</option>
                                    <option value="El Jadida">El Jadida</option>
                                    <option value="Chefchaouen">Chefchaouen</option>
                                    <option value="Tangier">Tangier</option>
                                    <option value="Safi">Safi</option>
                                    <option value="Oukaimeden">Oukaimeden</option>
                                    <option value="Zagora">Zagora</option>
                                    <option value="Arfoud">Arfoud</option>
                                    <option value="Setti Fadma">Setti Fadma</option>
                                    <option value="Sidi Ifni">Sidi Ifni</option>
                                    <option value="Imlil">Imlil</option>
                                    <option value="Sidi Kaouki">Sidi Kaouki</option>
                                    <option value="Tafraoute">Tafraoute</option>
                                    <option value="Tamraght">Tamraght</option>
                                    <option value="Tiguert">Tiguert</option>
                                    <option value="Skoura">Skoura</option>
                                    <option value="Tinghir">Tinghir</option>
                                    <option value="Ouirgane">Ouirgane</option>
                                    <option value="Bin El Ouidane">Bin El Ouidane</option>
                                    <option value="Demnate">Demnate</option>
                                    <option value="Mazagane">Mazagane</option>
                                    <option value="Tamadot">Tamadot</option>
                                    <option value="Asni">Asni</option>
                                    <option value="Taroudant">Taroudant</option>
                                    <option value="Taghazout">Taghazout</option>
                                    <option value="Meknes">Meknes</option>
                                    <option value="Oualidia">Oualidia</option>
                                    <option value="Paradis Plage">Paradis Plage</option>
                                    <option value="Aourir">Aourir</option>
                                    <option value="Beni-Mellal">Beni-Mellal</option>
                                    <option value="Imouzzer">Imouzzer</option>
                                    <option value="Imsouane">Imsouane</option>
                                    <option value="Inezgane">Inezgane</option>
                                    <option value="Mirleft">Mirleft</option>
                                    <option value="Toubkal">Toubkal</option>
                                    <option value="Tetouan">Tetouan</option>
                                    <option value="Settat">Settat</option>
                                    <option value="T'mara">T'mara</option>
                                    <option value="Ouzoud">Ouzoud</option>
                                    <option value="Azilal">Azilal</option>
                                    <option value="Errachidia">Errachidia</option>
                                    <option value="Benguerir">Benguerir</option>
                                </optgroup>

                            </select>
                        </div>

                        <!-- Type selection -->
                        <div class="mb-3">
                            <label for="type" class="form-label">{{ __('messages.type') }}</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="one_way">{{ __('messages.one_way') }}</option>
                                <option value="round_trip">{{ __('messages.round_trip') }}</option>
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="mb-3">
                            <label for="start_date" class="form-label">{{ __('messages.start_date') }}</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <!-- End Date (hidden initially) -->
                        <div class="mb-3" id="endDateField" style="display: nonee;">
                            <label for="end_date" class="form-label">{{ __('messages.end_date') }}</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>

                        <!-- Price field -->
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('messages.price') }}</label>
                            <input type="number" name="price" class="form-control" step="0.01" min="0"
                                required>
                        </div>

                        <!-- Min People field -->
                        <div class="mb-3">
                            <label for="min_people" class="form-label">{{ __('messages.min_people') }}</label>
                            <input type="number" name="min_people" class="form-control" min="1" required>
                        </div>

                        <!-- Max People field -->
                        <div class="mb-3">
                            <label for="max_people" class="form-label">{{ __('messages.max_people') }}</label>
                            <input type="number" name="max_people" class="form-control" min="1" required>
                        </div>

                        <!-- Estimated Time field -->
                        <div class="mb-3">
                            <label for="estimated_time"
                                class="form-label">{{ __('messages.estimated_time') }}</label>
                            <input type="number" name="estimated_time" class="form-control">
                        </div>

                        <!-- Loading spinner (hidden initially) -->
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
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.departure') }}:</strong> <span id="transfer-departure"></span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.destination') }}:</strong> <span
                                    id="transfer-destination"></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.start_date') }}:</strong> <span
                                    id="transfer-start_date"></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.end_date') }}:</strong> <span
                                    id="transfer-end_date"></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.end_date') }}:</strong> <span id="transfer-end_date"></span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.type') }}:</strong> <span id="transfer-type"></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.price') }}:</strong> <span id="transfer-price"></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.min_people') }}:</strong> <span
                                    id="transfer-min-people"></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.max_people') }}:</strong> <span
                                    id="transfer-max-people"></span></p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>{{ __('messages.estimated_time') }}:</strong> <span
                                    id="transfer-estimated-time"></span></p>
                        </li>
                    </ul>


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
        function showTransfer(id) {
            fetch(`/transfers/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('transfer-departure').textContent = data.departure;
                    document.getElementById('transfer-destination').textContent = data.destination;
                    document.getElementById('transfer-start_date').textContent = data.start_date;
                    document.getElementById('transfer-end_date').textContent = data.end_date;
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
                    form.querySelector('[name="start_date"]').value = data.start_date;
                    form.querySelector('[name="end_date"]').value = data.end_date;
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

        document.addEventListener('DOMContentLoaded', function() {
            // Get the type dropdown and end date field
            const typeSelect = document.getElementById('type');
            const endDateField = document.getElementById('endDateField');

            // Function to toggle the end date field visibility
            function toggleEndDateField() {
                if (typeSelect.value === 'round_trip') {
                    endDateField.style.display = 'block';
                } else {
                    endDateField.style.display = 'none';
                }
            }

            // Initialize visibility based on the selected type
            toggleEndDateField();

            // Add event listener to toggle on change
            typeSelect.addEventListener('change', toggleEndDateField);
        });
    </script>
</x-app-layout>
