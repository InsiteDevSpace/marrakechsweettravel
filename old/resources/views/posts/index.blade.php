<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.posts') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Add New Post Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('messages.posts_list') }}</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPostModal">
                + {{ __('messages.add_post') }}
            </button>
        </div>

        <!-- Post Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-blue">
                    <tr>
                        <th>{{ __('messages.title') }}</th>
                        <th>{{ __('messages.description') }}</th>
                        <th>{{ __('messages.category') }}</th>
                        <th>{{ __('messages.image') }}</th>
                        <th class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->description, 50) }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td><img src="{{ asset('storage/' . $post->image) }}" width="100" alt="{{ $post->title }}"></td>
                            <td class="text-center">
                                <!-- Show Icon -->
                                <a href="javascript:void(0);" onclick="showPost({{ $post->id }})" class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>

                                <!-- Edit Icon -->
                                <a href="javascript:void(0);" onclick="editPost({{ $post->id }})" class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.edit') }}">
                                    <i data-feather="edit" class="action-icon text-success"></i>
                                </a>

                                <!-- Delete Icon -->
                                <a href="javascript:void(0);" onclick="confirmDelete({{ $post->id }})" class="text-danger" data-bs-toggle="tooltip" title="{{ __('messages.delete') }}">
                                    <i data-feather="trash" class="action-icon text-danger"></i>
                                </a>

                                <!-- Hidden delete form -->
                               <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: none;">
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
            {{ $posts->links() }}
        </div>
    </div>

    <!-- Add Post Modal -->
    <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPostModalLabel">{{ __('messages.add_post') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPostForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('messages.title') }}</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('messages.image') }}</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">{{ __('messages.category') }}</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.add_post') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Post Modal -->
    <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">{{ __('messages.edit_post') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPostForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">{{ __('messages.title') }}</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">{{ __('messages.description') }}</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_image" class="form-label">{{ __('messages.image') }}</label>
                            <input type="file" class="form-control" id="edit_image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="edit_category_id" class="form-label">{{ __('messages.category') }}</label>
                            <select class="form-select" id="edit_category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Post Modal -->
    <div class="modal fade" id="showPostModal" tabindex="-1" aria-labelledby="showPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showPostModalLabel">{{ __('messages.post_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>{{ __('messages.title') }}:</strong> <span id="post-title"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.description') }}:</strong> <span id="post-description"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.category') }}:</strong> <span id="post-category"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.image') }}:</strong> <img id="post-image" width="100">
                        </li>
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

       <!-- JavaScript for handling the modals and form submissions -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fetch and show post data in modal
        function showPost(postId) {
            fetch(`/posts/${postId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data) {
                        console.error('No data received');
                        return;
                    }
                    console.log(data); // Check if data is received correctly

                    document.getElementById('post-title').textContent = data.title;
                    document.getElementById('post-description').textContent = data.description;
                    document.getElementById('post-category').textContent = data.category.name;
                    document.getElementById('post-image').src = '/storage/' + data.image;

                    var showPostModal = new bootstrap.Modal(document.getElementById('showPostModal'));
                    showPostModal.show();
                })
                .catch(error => console.error('Error fetching post data:', error));
        }


        // Trigger Edit Post modal and populate with data
        function editPost(postId) {
            fetch(`/posts/${postId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_title').value = data.title;
                    document.getElementById('edit_description').value = data.description;
                    document.getElementById('edit_category_id').value = data.category_id;

                    // Set form action URL for editing the post
                    const form = document.getElementById('editPostForm');
                    form.action = `/posts/${postId}`;

                    var editPostModal = new bootstrap.Modal(document.getElementById('editPostModal'));
                    editPostModal.show();
                })
                .catch(error => console.error('Error fetching post data:', error));
        }

        // Confirm delete with SweetAlert2
        function confirmDelete(postId) {
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
                    document.getElementById('delete-form-' + postId).submit(); // Make sure this matches your form ID
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
