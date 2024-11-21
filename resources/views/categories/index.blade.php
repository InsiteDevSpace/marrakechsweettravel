<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.categories') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('messages.categories_list') }}</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                + {{ __('messages.add_category') }}
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-blue">
                    <tr>
                        <th scope="col">{{ __('messages.name') }}</th>
                        <th scope="col">{{ __('messages.date_created') }}</th>
                        <th scope="col" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0);" onclick="showCategory({{ $category->id }})" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="editCategory({{ $category->id }})" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.edit') }}">
                                    <i data-feather="edit" class="action-icon text-success"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="confirmDelete({{ $category->id }})" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('messages.delete') }}">
                                    <i data-feather="trash" class="action-icon text-danger"></i>
                                </a>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    </div>


    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">{{ __('messages.add_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('messages.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <!-- Loading spinner -->
                        <div class="text-center d-none" id="addLoadingSpinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitAddCategoryForm()">{{ __('messages.add_category') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">{{ __('messages.edit_category') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">{{ __('messages.name') }}</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <!-- Loading spinner -->
                        <div class="text-center d-none" id="editLoadingSpinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitEditCategoryForm()">{{ __('messages.save_changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Show Category Modal -->
    <div class="modal fade" id="showCategoryModal" tabindex="-1" aria-labelledby="showCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showCategoryModalLabel">{{ __('messages.category_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>{{ __('messages.name') }}:</strong> <span id="category-name"></span></li>
                    </ul>
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


// Submit the Add Category form
function submitAddCategoryForm() {
    const form = document.getElementById('addCategoryForm');
    const spinner = document.getElementById('addLoadingSpinner');

    spinner.classList.remove('d-none'); // Show spinner

    // Simulate a loading delay and then submit the form
    setTimeout(function() {
        form.submit();
    }, 500);
}

        // Submit the Edit Category form
        function submitEditCategoryForm() {
            const form = document.getElementById('editCategoryForm');
            const spinner = document.getElementById('editLoadingSpinner');

            spinner.classList.remove('d-none'); // Show spinner

            // Simulate a loading delay and then submit the form
            setTimeout(function() {
                form.submit();
            }, 500);
        }
        // Fetch and show category data in modal
        function showCategory(categoryId) {
            fetch(`/categories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('category-name').textContent = data.name;
                    var showCategoryModal = new bootstrap.Modal(document.getElementById('showCategoryModal'));
                    showCategoryModal.show();
                })
                .catch(error => console.error('Error fetching category data:', error));
        }

        // Trigger Edit Category modal and populate with data
        function editCategory(categoryId) {
            fetch(`/categories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_name').value = data.name;
                    const form = document.getElementById('editCategoryForm');
                    form.action = `/categories/${categoryId}`;
                    var editCategoryModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
                    editCategoryModal.show();
                })
                .catch(error => console.error('Error fetching category data:', error));
        }

        // Confirm delete with SweetAlert2
        function confirmDelete(categoryId) {
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
                    document.getElementById('delete-form-' + categoryId).submit();
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
