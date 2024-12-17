<x-app-layout>

    @section('title', __('messages.services_list'))


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.services') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Title and Add New Service Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('messages.services_list') }}</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                + {{ __('messages.add_service') }}
            </button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle border rounded shadow-sm">
                <thead class="bg-primary text-white text-uppercase">
                    <tr>
                        <th scope="col" class="text-center" style="width: 80px;">{{ __('messages.image') }}</th>
                        <th scope="col">{{ __('messages.title') }}</th>
                        <th scope="col">{{ __('messages.type') }}</th>
                        <th scope="col">{{ __('messages.price') }}</th>
                        <th scope="col">{{ __('messages.duration') }}</th>
                        <th scope="col">{{ __('messages.location') }}</th>
                        <th scope="col">{{ __('messages.availability') }}</th>
                        <th scope="col">{{ __('messages.creation_date') }}</th>
                        <th scope="col" class="text-center" style="width: 150px;">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr class="border-bottom align-middle">
                            <!-- Image -->
                            <td class="text-center">
                                @if ($service->images && $service->images->isNotEmpty())
                                    <img 
                                        src="{{ asset($service->images->first()->image_path) }}" 
                                        alt="{{ $service->title }}" 
                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                @else
                                    <span class="text-muted">{{ __('messages.no_image') }}</span>
                                @endif
                            </td>

                            <!-- Title -->
                            <td class="fw-bold">{{ $service->title }}</td>

                            <!-- Type -->
                            <td>
                                @switch($service->type)
                                    @case('day_trip') <span class="badge bg-primary">{{ __('messages.day_trip') }}</span> @break
                                    @case('activity') <span class="badge bg-success">{{ __('messages.activity') }}</span> @break
                                    @case('tour') <span class="badge bg-warning text-dark">{{ __('messages.tour') }}</span> @break
                                    @default <span class="badge bg-secondary">{{ __('messages.unknown') }}</span>
                                @endswitch
                            </td>

                            <!-- Price -->
                            <td class="">
                                <i class="bi bi-tag"></i> {{ number_format($service->price, 2) }} {{ $service->currency }}
                            </td>

                            <!-- Duration -->
                            <td>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-clock text-primary me-1"></i> {{ $service->duration }} {{ __('messages.days') }}
                                </span>
                            </td>

                            <!-- Location -->
                            <td>
                                <i class="bi bi-geo-alt text-danger me-1"></i> 
                                <span class="fw-semibold">{{ $service->location }}</span>
                            </td>

                            <!-- Availability -->
                            <td>
                                @if ($service->availabilities && $service->availabilities->isNotEmpty())
                                    <span class="badge bg-light text-dark">
                                        {{ $service->availabilities->first()->start_date }} 
                                        - {{ $service->availabilities->first()->end_date }}
                                    </span>
                                @else
                                    <span class="badge bg-danger text-white">{{ __('messages.not_available') }}</span>
                                @endif
                            </td>

                            <!-- Creation Date -->
                            <td>
                                
                                {{ $service->created_at->format('Y-m-d') }}
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <a href="javascript:void(0);" onclick="showService({{ $service->id }})" class="text-info me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                                    <i class="bi bi-eye fs-5"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="editService({{ $service->id }})" class="text-primary me-2" data-bs-toggle="tooltip" title="{{ __('messages.edit') }}">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="deleteService({{ $service->id }})" class="text-danger" data-bs-toggle="tooltip" title="{{ __('messages.delete') }}">
                                    <i class="bi bi-trash fs-5"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>




        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">{{ __('messages.add_service') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addServiceForm" action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('messages.title') }}</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('messages.enter_title') }}" required>
                        </div>

                        <!-- Overview -->
                        <div class="mb-3">
                            <label for="overview" class="form-label">{{ __('messages.overview') }}</label>
                            <textarea class="form-control mb-2" name="overview" rows="2" placeholder="{{ __('messages.overview') }}" required></textarea>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea class="form-control mb-2" name="description" rows="5" placeholder="{{ __('messages.enter_description') }}" required></textarea>
                        </div>

                        <!-- Grouped Fields: Duration and Discount -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="duration" class="form-label">{{ __('messages.duration') }}</label>
                                <input type="text" class="form-control" id="duration" name="duration" placeholder="{{ __('messages.enter_duration') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="discount" class="form-label">{{ __('messages.discount') }}</label>
                                <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" placeholder="{{ __('messages.enter_discount') }}">
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="location" class="form-label">{{ __('messages.location') }}</label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="{{ __('messages.enter_location') }}" required>
                        </div>

                        <!-- Grouped Fields: Max Participants and Min Age -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="max_participants" class="form-label">{{ __('messages.max_participants') }}</label>
                                <input type="number" class="form-control" id="max_participants" name="max_participants" min="1" placeholder="{{ __('messages.enter_max_participants') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="min_age" class="form-label">{{ __('messages.min_age') }}</label>
                                <input type="number" class="form-control" id="min_age" name="min_age" min="0" placeholder="{{ __('messages.enter_min_age') }}">
                            </div>
                        </div>

                        <!-- Grouped Fields: Map Latitude and Longitude -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="map_lat" class="form-label">{{ __('messages.map_lat') }}</label>
                                <input type="number" class="form-control" id="map_lat" name="map_lat" placeholder="{{ __('messages.enter_lat') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="map_lng" class="form-label">{{ __('messages.map_lng') }}</label>
                                <input type="number" class="form-control" id="map_lng" name="map_lng" placeholder="{{ __('messages.enter_lng') }}">
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="mb-3 mt-3">
                            <label for="type" class="form-label">{{ __('messages.type') }}</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">{{ __('messages.select_type') }}</option>
                                <option value="day_trip">{{ __('messages.day_trip') }}</option>
                                <option value="activity">{{ __('messages.activity') }}</option>
                                <option value="tour">{{ __('messages.tour') }}</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('messages.price') }}</label>
                            <input type="number" class="form-control" id="price" name="price" min="0" placeholder="{{ __('messages.enter_price') }}" required>
                        </div>

                        <!-- Currency -->
                        <div class="mb-3">
                            <label for="currency" class="form-label">{{ __('messages.currency') }}</label>
                            <select class="form-select" id="currency" name="currency" required>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="MAD">MAD</option>
                            </select>
                        </div>

                        <!-- Highlights -->
                        <div class="mb-3">
                            <label for="highlight" class="form-label">{{ __('messages.highlight') }}</label>
                            <div id="highlightWrapper">
                                <div class="mb-3">
                                    <label for="highlight_text" class="form-label">{{ __('messages.enter_highlight') }}</label>
                                    <input type="text" class="form-control mb-2" name="highlight[]" placeholder="{{ __('messages.enter_highlight') }}">
                                    <label for="highlight_detail" class="form-label">{{ __('messages.enter_highlight_detail') }}</label>
                                    <textarea class="form-control mb-2" name="highlight_detail[]" rows="3" placeholder="{{ __('messages.enter_highlight_detail') }}"></textarea>
                                    <button type="button" class="btn btn-outline-secondary mt-2" onclick="addField('highlightWrapper', 'highlight', 'highlight_detail')">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Inclusions -->
                        <div class="mb-3">
                            <label for="inclusions" class="form-label">{{ __('messages.inclusions') }}</label>
                            <div id="inclusionsWrapper">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="inclusions[]" placeholder="{{ __('messages.enter_inclusions') }}">
                                    <button type="button" class="btn btn-outline-secondary" onclick="addField('inclusionsWrapper', 'inclusions')">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Important Info -->
                        <div class="mb-3">
                            <label for="important_info" class="form-label">{{ __('messages.important_info') }}</label>
                            <div id="importantInfoWrapper">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="important_info[]" placeholder="{{ __('messages.enter_important_info') }}">
                                    <button type="button" class="btn btn-outline-secondary" onclick="addField('importantInfoWrapper', 'important_info')">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="mb-3">
                            <label for="images" class="form-label">{{ __('messages.images') }}</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" onchange="previewImages()" required>
                            <div id="imagePreview" class="mt-3 d-flex flex-wrap"></div>
                            <small class="text-muted">{{ __('messages.max_images') }}</small>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">{{ __('messages.add_service') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceModalLabel">{{ __('messages.edit_service') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editServiceForm" action="" method="POST" enctype="multipart/form-data">


                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="edit-title" class="form-label">{{ __('messages.title') }}</label>
                            <input type="text" class="form-control" id="edit-title" name="title" placeholder="{{ __('messages.enter_title') }}" required>
                        </div>

                        <!-- Overview -->
                        <div class="mb-3">
                            <label for="edit-overview" class="form-label">{{ __('messages.overview') }}</label>
                            <textarea class="form-control mb-2" id="edit-overview" name="overview" rows="2" placeholder="{{ __('messages.overview') }}" required></textarea>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="edit-description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea class="form-control mb-2" id="edit-description" name="description" rows="5" placeholder="{{ __('messages.enter_description') }}" required></textarea>
                        </div>


                        <div class="mb-3">
                            <label for="edit-title" class="form-label">{{ __('messages.location') }}</label>
                            <input type="text" class="form-control" id="edit-location" name="location" placeholder="{{ __('messages.enter_location') }}" required>
                        </div>

                        <!-- Grouped Fields: Duration and Discount -->
                        <div class="row">
                            <div class="col-md-6">
                                <label for="edit-duration" class="form-label">{{ __('messages.duration') }}</label>
                                <input type="text" class="form-control" id="edit-duration" name="duration" placeholder="{{ __('messages.enter_duration') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit-discount" class="form-label">{{ __('messages.discount') }}</label>
                                <input type="number" class="form-control" id="edit-discount" name="discount" min="0" max="100" placeholder="{{ __('messages.enter_discount') }}">
                            </div>
                        </div>

                        <!-- Grouped Fields: Max Participants and Min Age -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="edit-max_participants" class="form-label">{{ __('messages.max_participants') }}</label>
                                <input type="number" class="form-control" id="edit-max_participants" name="max_participants" min="1" placeholder="{{ __('messages.enter_max_participants') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-min_age" class="form-label">{{ __('messages.min_age') }}</label>
                                <input type="number" class="form-control" id="edit-min_age" name="min_age" min="0" placeholder="{{ __('messages.enter_min_age') }}">
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="edit-map_lat" class="form-label">{{ __('messages.map_lat') }}</label>
                                <input type="number" class="form-control" id="edit-map_lat" name="map_lat" placeholder="{{ __('messages.enter_lat') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="edit-map_lng" class="form-label">{{ __('messages.map_lng') }}</label>
                                <input type="number" class="form-control" id="edit-map_lng" name="map_lng" placeholder="{{ __('messages.enter_lng') }}">
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="mb-3 mt-3">
                            <label for="edit-type" class="form-label">{{ __('messages.type') }}</label>
                            <select class="form-select" id="edit-type" name="type" required>
                                <option value="day_trip">{{ __('messages.day_trip') }}</option>
                                <option value="activity">{{ __('messages.activity') }}</option>
                                <option value="tour">{{ __('messages.tour') }}</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="edit-price" class="form-label">{{ __('messages.price') }}</label>
                            <input type="number" class="form-control" id="edit-price" name="price" placeholder="{{ __('messages.enter_price') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-currency" class="form-label">{{ __('messages.currency') }}</label>
                            <select class="form-select" id="edit-currency" name="currency" required>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="MAD">MAD</option>
                            </select>
                        </div>

                        <!-- Highlights -->
                        <div class="mb-3">
                            <label for="edit-highlight" class="form-label">{{ __('messages.highlight') }}</label>
                            <div id="edit-highlightWrapper"></div>
                            <button type="button" class="btn btn-outline-secondary" onclick="addField('edit-highlightWrapper', 'highlight', 'highlight_detail')">+</button>
                        </div>

                        <!-- Inclusions -->
                        <div class="mb-3">
                            <label for="edit-inclusions" class="form-label">{{ __('messages.inclusions') }}</label>
                            <div id="edit-inclusionsWrapper"></div>
                            <button type="button" class="btn btn-outline-secondary" onclick="addField('edit-inclusionsWrapper', 'inclusions')">+</button>
                        </div>

                        <!-- Important Info -->
                        <div class="mb-3">
                            <label for="edit-important_info" class="form-label">{{ __('messages.important_info') }}</label>
                            <div id="edit-importantInfoWrapper"></div>
                            <button type="button" class="btn btn-outline-secondary" onclick="addField('edit-importantInfoWrapper', 'important_info')">+</button>
                        </div>

                        <!-- Images -->
                        <div class="mb-3">
                            <label for="edit-images" class="form-label">{{ __('messages.images') }}</label>
                            <input type="file" class="form-control" id="edit-images" name="images[]" multiple accept="image/*" onchange="previewImages('edit-imagePreview', 'edit-images')">
                            <div id="edit-imagePreview" class="mt-3 d-flex flex-wrap"></div>
                            <small class="text-muted">{{ __('messages.max_images') }}</small>
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





    <!-- Show Service Modal -->
    <div class="modal fade" id="showServiceModal" tabindex="-1" aria-labelledby="showServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content shadow-lg border-0 rounded-12">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="showServiceModalLabel">
                        {{ __('messages.service_details') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <div class="row">
                        <!-- Left Section: Details -->
                        <div class="col-lg-6">
                            <h4 class="fw-bold">{{ __('messages.title') }}</h4>
                            <p id="service-title"></p>

                            <div class="row mt-3">
                                <div class="col-6">
                                    <p class="mb-1">{{ __('messages.type') }}</p>
                                    <p id="service-type" class="fw-semibold"></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">{{ __('messages.price') }}</p>
                                    <p id="service-price" class="fw-semibold"></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">{{ __('messages.duration') }}</p>
                                    <p id="service-duration" class="fw-semibold"></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1">{{ __('messages.max_participants') }}</p>
                                    <p id="service-max-participants" class="fw-semibold"></p>
                                </div>
                                <div class="col-12 mt-3">
                                    <p class="mb-1">{{ __('messages.location') }}</p>
                                    <p id="service-location" class="fw-semibold"></p>
                                </div>
                                <div class="col-12 mt-3">
                                    <p class="mb-1">{{ __('messages.overview') }}</p>
                                    <p id="service-overview"></p>
                                </div>
                                <div class="col-12 mt-3">
                                    <p class="mb-1">{{ __('messages.description') }}</p>
                                    <p id="service-description"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section: Highlights, Inclusions, Important Info -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <h5 class="fw-bold">{{ __('messages.highlights') }}</h5>
                                <ul id="service-highlights" class="list-unstyled ps-3"></ul>
                            </div>

                            <div class="mb-3">
                                <h5 class="fw-bold">{{ __('messages.inclusions') }}</h5>
                                <ul id="service-inclusions" class="list-unstyled ps-3"></ul>
                            </div>

                            <div>
                                <h5 class="fw-bold">{{ __('messages.important_info') }}</h5>
                                <ul id="service-important-info" class="list-unstyled ps-3"></ul>
                            </div>
                        </div>
                    </div>

                    <!-- Image Gallery -->
                    <div class="mt-4">
                        <h5 class="fw-bold">{{ __('messages.images') }}</h5>
                        <div id="service-images" class="d-flex flex-wrap gap-3">
                            <!-- Dynamically filled -->
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
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

        document.getElementById('addServiceForm').addEventListener('submit', function (e) {
            const highlightFields = document.querySelectorAll('[name="highlight[]"]');
            const lat = document.getElementById('map_lat').value;
            const lng = document.getElementById('map_lng').value;

            if (Array.from(highlightFields).every(field => !field.value.trim())) {
                e.preventDefault();
                alert("Please add at least one highlight.");
                return;
            }

            if (lat && (lat < -90 || lat > 90)) {
                e.preventDefault();
                alert("Latitude must be between -90 and 90.");
                return;
            }

            if (lng && (lng < -180 || lng > 180)) {
                e.preventDefault();
                alert("Longitude must be between -180 and 180.");
                return;
            }
        });



        function addField(wrapperId, fieldName, detailFieldName = null) {
            const wrapper = document.getElementById(wrapperId);
            const newField = document.createElement('div');
            newField.className = 'mb-3';

            let fieldHTML = `
                <!-- Text -->
                <label for="${fieldName}" class="form-label">${getTranslation('enter_' + fieldName)}</label>
                <input type="text" class="form-control mb-2" name="${fieldName}[]" placeholder="${getTranslation('enter_' + fieldName)}">
            `;

            // Add detail field if detailFieldName is provided
            if (detailFieldName) {
                fieldHTML += `
                    <!-- Detail -->
                    <label for="${detailFieldName}" class="form-label">${getTranslation('enter_' + detailFieldName)}</label>
                    <textarea class="form-control mb-2" name="${detailFieldName}[]" rows="3" placeholder="${getTranslation('enter_' + detailFieldName)}"></textarea>
                `;
            }

            // Add the remove button
            fieldHTML += `
                <button type="button" class="btn btn-outline-danger mt-2" onclick="removeField(this)">-</button>
            `;

            newField.innerHTML = fieldHTML;
            wrapper.appendChild(newField);
        }


        // Function to get translations from the backend (optional for dynamic strings)
        function getTranslation(key) {
            const translations = {
                enter_highlight: "{{ __('messages.enter_highlight') }}",
                enter_highlight_detail: "{{ __('messages.enter_highlight_detail') }}",
                enter_inclusions: "{{ __('messages.enter_inclusions') }}",
                enter_important_info: "{{ __('messages.enter_important_info') }}"
            };
            return translations[key] || key;
        }

        function removeField(button) {
            button.parentElement.remove();
        }

        function previewImages() {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // Clear existing previews
            const files = document.getElementById('images').files;

            if (files) {
                Array.from(files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.classList.add('me-2', 'mb-2');
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '5px';
                        imagePreview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        


        function editService(serviceId) {
            fetch(`/services/${serviceId}`)
                .then(response => response.json())
                .then(service => {
                    // Populate the modal fields
                        document.getElementById('edit-title').value = service.title || '';
                        document.getElementById('edit-overview').value = service.overview || '';
                        document.getElementById('edit-description').value = service.description || '';
                        document.getElementById('edit-map_lat').value = service.map_lat || '';
                        document.getElementById('edit-map_lng').value = service.map_lng || '';

                        document.getElementById('edit-duration').value = service.duration || '';
                        document.getElementById('edit-location').value = service.location || '';
                        document.getElementById('edit-price').value = service.price || '';
                        document.getElementById('edit-currency').value = service.currency || '';
                        document.getElementById('edit-discount').value = service.discount !== undefined ? service.discount : '';
                        document.getElementById('edit-max_participants').value = service.max_participants || '';
                        document.getElementById('edit-min_age').value = service.min_age !== undefined ? service.min_age : '';
                        document.getElementById('edit-type').value = service.type || '';
                   
                    // Populate highlights
                    const highlightWrapper = document.getElementById('edit-highlightWrapper');
                    highlightWrapper.innerHTML = '';
                    if (service.highlights && Array.isArray(service.highlights)) {
                        service.highlights.forEach(highlight => {
                            const div = document.createElement('div');
                            div.className = 'mb-3';
                            div.innerHTML = `
                                <input type="text" class="form-control mb-2" name="highlight[]" value="${highlight.text || ''}">
                                <textarea class="form-control mb-2" name="highlight_detail[]" rows="3">${highlight.highlight_detail || ''}</textarea>
                                <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                            `;
                            highlightWrapper.appendChild(div);
                        });
                    }

                    // Populate inclusions
                    populateArrayField('edit-inclusionsWrapper', service.inclusions || [], 'inclusions');

                    // Populate important info
                    populateArrayField('edit-importantInfoWrapper', service.importantInfos || [], 'important_info');

                    // Populate images
                    populateImages('edit-imagePreview', service.images || []);

                    // Set the action dynamically in `editService`
                    const editForm = document.getElementById('editServiceForm');
                    editForm.action = `/services/${serviceId}`;


                    // Show the modal
                    const editModal = new bootstrap.Modal(document.getElementById('editServiceModal'));
                    editModal.show();
                })
                .catch(error => {
                    console.error('Error fetching service details:', error);
                    alert('Failed to load service details. Please try again.');
                });
        }



        function populateArrayField(wrapperId, items, name) {
            const wrapper = document.getElementById(wrapperId);
            wrapper.innerHTML = ''; // Clear previous content

            // Check if the items array exists and is not empty
            if (items && Array.isArray(items) && items.length > 0) {
                items.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'input-group mb-2';
                    div.innerHTML = `
                        <input type="text" class="form-control" name="${name}[]" value="${item.text || ''}">
                        <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                    `;
                    wrapper.appendChild(div);
                });
            } else {
                // Add an empty input field if no data exists
                const div = document.createElement('div');
                div.className = 'input-group mb-2';
                div.innerHTML = `
                    <input type="text" class="form-control" name="${name}[]" placeholder="Enter ${name}">
                    <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
                `;
                wrapper.appendChild(div);
            }
        }



        function populateImages(previewId, images) {
            const imagePreview = document.getElementById(previewId);
            imagePreview.innerHTML = '';
            images.forEach(image => {
                const img = document.createElement('img');
                img.src = `/${image.image_path}`;
                img.alt = 'Service Image';
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.marginRight = '10px';
                imagePreview.appendChild(img);
            });
        }

        function removeField(button) {
            button.parentElement.remove();
        }




        function showService(serviceId) {
            fetch(`/services/${serviceId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Populate modal fields with service data
                    document.getElementById('service-title').textContent = data.title || 'N/A';
                    document.getElementById('service-type').textContent = data.type || 'N/A';
                    document.getElementById('service-price').textContent = data.price ? `${data.price} ${data.currency}` : 'N/A';
                    document.getElementById('service-duration').textContent = data.duration || 'N/A';
                    document.getElementById('service-max-participants').textContent = data.max_participants || 'N/A';
                    document.getElementById('service-location').textContent = data.location || 'N/A';
                    document.getElementById('service-overview').textContent = data.overview || 'N/A';
                    document.getElementById('service-description').textContent = data.description || 'N/A';

                    // Populate highlights and details
                    const highlightsList = document.getElementById('service-highlights');
                    highlightsList.innerHTML = '';
                    if (data.highlights && data.highlights.length > 0) {
                        data.highlights.forEach(highlight => {
                            const li = document.createElement('li');
                            li.innerHTML = `
                                <strong>${highlight.text || 'N/A'}</strong><br>
                                <span>${highlight.highlight_detail || 'No detail available'}</span>
                            `;
                            highlightsList.appendChild(li);
                        });
                    } else {
                        highlightsList.innerHTML = '<li>No highlights available.</li>';
                    }

                    // Populate inclusions
                    const inclusionsList = document.getElementById('service-inclusions');
                    inclusionsList.innerHTML = '';
                    if (data.inclusions && data.inclusions.length > 0) {
                        data.inclusions.forEach(inclusion => {
                            const li = document.createElement('li');
                            li.textContent = inclusion.text || 'N/A';
                            inclusionsList.appendChild(li);
                        });
                    } else {
                        inclusionsList.innerHTML = '<li>No inclusions available.</li>';
                    }

                    const importantInfoList = document.getElementById('service-important-info');
                    importantInfoList.innerHTML = ''; // Clear existing content

                    if (Array.isArray(data.importantInfos) && data.importantInfos.length > 0) {
                        data.importantInfos.forEach(info => {
                            const li = document.createElement('li');
                            li.textContent = info.text || 'N/A';
                            importantInfoList.appendChild(li);
                        });
                    } else {
                        importantInfoList.innerHTML = '<li>No important info available.</li>';
                    }


                    // Populate images
                    const imagesContainer = document.getElementById('service-images');
                    imagesContainer.innerHTML = '';
                    if (data.images && data.images.length > 0) {
                        data.images.forEach(image => {
                            const img = document.createElement('img');
                            img.src = `/${image.image_path}`; // Adjust if necessary
                            img.alt = data.title || 'Service Image';
                            img.style.width = '100px';
                            img.style.height = '100px';
                            img.style.objectFit = 'cover';
                            img.style.marginRight = '5px';
                            imagesContainer.appendChild(img);
                        });
                    } else {
                        imagesContainer.textContent = 'No images available.';
                    }

                    // Show the modal
                    const showServiceModal = new bootstrap.Modal(document.getElementById('showServiceModal'));
                    showServiceModal.show();
                })
                .catch(error => {
                    console.error('Error fetching service details:', error);
                    alert('Failed to load service details. Please try again.');
                });
        }


        function deleteService(serviceId) {
        Swal.fire({
            title: "{{ __('messages.are_you_sure') }}",
            text: "{{ __('messages.delete_confirmation') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('messages.yes_delete') }}",
            cancelButtonText: "{{ __('messages.cancel') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                // Send delete request using a form submission
                const form = document.createElement('form');
                form.action = `/services/${serviceId}`;
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


        
       document.addEventListener("DOMContentLoaded", function () {
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
