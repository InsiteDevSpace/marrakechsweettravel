<x-app-layout>
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
            <table class="table table-striped table-hover">
                <thead class="table-orange">
                    <tr>
                        <th scope="col">{{ __('messages.title') }}</th>
                        <th scope="col">{{ __('messages.type') }}</th>
                        <th scope="col">{{ __('messages.price') }}</th>
                        <th scope="col">{{ __('messages.duration') }}</th>
                        <th scope="col">{{ __('messages.location') }}</th>
                        <th scope="col" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <!-- Title -->
                            <td>{{ $service->title }}</td>

                            <!-- Type -->
                            <td>
                                @switch($service->type)
                                    @case('day_trip') {{ __('messages.day_trip') }} @break
                                    @case('activity') {{ __('messages.activity') }} @break
                                    @case('tour') {{ __('messages.tour') }} @break
                                    @default {{ __('messages.unknown') }}
                                @endswitch
                            </td>

                            <!-- Price -->
                            <td>
                                {{ number_format($service->price, 2) }} {{ __('messages.currency_symbol') }}
                            </td>

                            <!-- Duration -->
                            <td>{{ $service->duration }}</td>

                            <!-- Location -->
                            <td>{{ $service->location }}</td>

            

                            <!-- Actions -->
                            <td class="text-center">
                                <a href="javascript:void(0);" onclick="showService({{ $service->id }})" class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>
                                <a href="{{ route('services.edit', $service->id) }}" class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.edit') }}">
                                    <i data-feather="edit" class="action-icon text-primary"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="deleteService({{ $service->id }})" class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.delete') }}">
                                    <i data-feather="trash-2" class="action-icon text-danger"></i>
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
                            <input type="text" class="form-control" id="title" aria-describedby="title-label" name="title" placeholder="{{ __('messages.enter_title') }}" required>


                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('messages.overview') }}</label>
                            <input type="text" class="form-control" id="title" aria-describedby="title-label" name="overview" placeholder="{{ __('messages.enter_overview') }}" required>


                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('messages.description') }}</label>
                            <input type="text" class="form-control" id="title" aria-describedby="title-label" name="description" placeholder="{{ __('messages.enter_description') }}" required>


                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('messages.location') }}</label>
                            <input type="text" class="form-control" id="title" aria-describedby="title-label" name="location" placeholder="{{ __('messages.enter_location') }}" required>


                        </div>


                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('messages.min_age') }}</label>
                            <input type="number" class="form-control" id="min_age" aria-describedby="title-label" name="min_age" placeholder="{{ __('messages.min_age') }}" required>


                        </div>

                        <!-- Type -->
                        <div class="mb-3">
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

                        <!-- Discount -->
                        <div class="mb-3">
                            <label for="discount" class="form-label">{{ __('messages.discount') }}</label>
                            <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" placeholder="{{ __('messages.enter_discount') }}">
                        </div>

                        <!-- Duration -->
                        <div class="mb-3">
                            <label for="duration" class="form-label">{{ __('messages.duration') }}</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="{{ __('messages.enter_duration') }}" required>
                        </div>

                        <!-- Max Participants -->
                        <div class="mb-3">
                            <label for="max_participants" class="form-label">{{ __('messages.max_participants') }}</label>
                            <input type="number" class="form-control" id="max_participants" name="max_participants" min="1" placeholder="{{ __('messages.enter_max_participants') }}">
                        </div>

                        <!-- Highlight (Multiple Fields) -->
                        <div class="mb-3">
                            <label for="highlight" class="form-label">{{ __('messages.highlight') }}</label>
                            <div id="highlightWrapper">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="highlight[]" placeholder="{{ __('messages.enter_highlight') }}">
                                    <button type="button" class="btn btn-outline-secondary" onclick="addField('highlightWrapper', 'highlight')">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Inclusions (Multiple Fields) -->
                        <div class="mb-3">
                            <label for="inclusions" class="form-label">{{ __('messages.inclusions') }}</label>
                            <div id="inclusionsWrapper">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="inclusions[]" placeholder="{{ __('messages.enter_inclusions') }}">
                                    <button type="button" class="btn btn-outline-secondary" onclick="addField('inclusionsWrapper', 'inclusions')">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Important Info (Multiple Fields) -->
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

                        <!-- Map Latitude -->
                        <div class="mb-3">
                            <label for="map_lat" class="form-label">{{ __('messages.map_lat') }}</label>
                            <input type="number" class="form-control" id="map_lat" name="map_lat" placeholder="{{ __('messages.enter_lat') }}">
                        </div>

                        <!-- Map Longitude -->
                        <div class="mb-3">
                            <label for="map_lng" class="form-label">{{ __('messages.map_lng') }}</label>
                            <input type="number" class="form-control" id="map_lng" name="map_lng" placeholder="{{ __('messages.enter_lng') }}">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">{{ __('messages.add_service') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Show Service Modal -->
    <div class="modal fade" id="showServiceModal" tabindex="-1" aria-labelledby="showServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showServiceModalLabel">{{ __('messages.service_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Dynamic Content -->
                    <h4>{{ __('messages.title') }}: <span id="service-title"></span></h4>
                    <p>{{ __('messages.type') }}: <span id="service-type"></span></p>
                    <p>{{ __('messages.price') }}: <span id="service-price"></span></p>
                    <p>{{ __('messages.duration') }}: <span id="service-duration"></span></p>
                    <p>{{ __('messages.max_participants') }}: <span id="service-max-participants"></span></p>
                    <p>{{ __('messages.location') }}: <span id="service-location"></span></p>
                    <p>{{ __('messages.description') }}: <span id="service-description"></span></p>

                    <!-- Highlights -->
                    <h5>{{ __('messages.highlights') }}</h5>
                    <ul id="service-highlights"></ul>

                    <!-- Inclusions -->
                    <h5>{{ __('messages.inclusions') }}</h5>
                    <ul id="service-inclusions"></ul>

                    <!-- Important Info -->
                    <h5>{{ __('messages.important_info') }}</h5>
                    <ul id="service-important-info"></ul>
                    

                    <!-- Images -->
                    <h5>{{ __('messages.images') }}</h5>
                    <div id="service-images" class="d-flex flex-wrap"></div>
                </div>
                <div class="modal-footer">
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
            if (Array.from(highlightFields).every(field => !field.value.trim())) {
                e.preventDefault();
                alert("Please add at least one highlight.");
                return;
            }
        });

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



        function addField(wrapperId, fieldName) {
            const wrapper = document.getElementById(wrapperId);
            const newField = document.createElement('div');
            newField.className = 'input-group mb-2';
            newField.innerHTML = `
                <input type="text" class="form-control" name="${fieldName}[]" placeholder="${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)}">
                <button type="button" class="btn btn-outline-danger" onclick="removeField(this)">-</button>
            `;
            wrapper.appendChild(newField);
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
                    document.getElementById('service-price').textContent = data.price ? `$${data.price}` : 'N/A';
                    document.getElementById('service-duration').textContent = data.duration || 'N/A';
                    document.getElementById('service-max-participants').textContent = data.max_participants || 'N/A';
                    document.getElementById('service-location').textContent = data.location || 'N/A';
                    document.getElementById('service-description').textContent = data.description || 'N/A';

                    // Populate highlights
                    const highlightsList = document.getElementById('service-highlights');
                    highlightsList.innerHTML = '';
                    if (data.highlights && data.highlights.length > 0) {
                        data.highlights.forEach(highlight => {
                            const li = document.createElement('li');
                            li.textContent = highlight.text || 'N/A';
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
