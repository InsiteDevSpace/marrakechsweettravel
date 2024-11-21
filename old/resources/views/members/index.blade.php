<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.members') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Title and Add New Member Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('messages.members_list') }}</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                + {{ __('messages.add_member') }}
            </button>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">{{ __('messages.first_name') }}</th>
                        <th scope="col">{{ __('messages.last_name') }}</th>
                        <th scope="col">{{ __('messages.phone') }}</th>
                        <th scope="col">{{ __('messages.email') }}</th>
                        <th scope="col">{{ __('messages.type') }}</th>
                        <th scope="col">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $member->first_name }}</td>
                            <td>{{ $member->last_name }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->type }}</td>
                            <td>
                                <!-- Show, Edit, Delete Buttons -->
                                <a href="javascript:void(0);" onclick="showMember({{ $member->id }})" class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="editMember({{ $member->id }})" class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.edit') }}">
                                    <i data-feather="edit" class="action-icon text-success"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="confirmDelete({{ $member->id }})" class="text-danger" data-bs-toggle="tooltip" title="{{ __('messages.delete') }}">
                                    <i data-feather="trash" class="action-icon text-danger"></i>
                                </a>
                                <form id="delete-form-{{ $member->id }}" action="{{ route('members.destroy', $member->id) }}" method="POST" style="display: none;">
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
            {{ $members->links() }}
        </div>
    </div>

    <!-- Add Member Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">{{ __('messages.add_member') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMemberForm" action="{{ route('members.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">{{ __('messages.first_name') }}</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">{{ __('messages.last_name') }}</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('messages.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">{{ __('messages.type') }}</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="organisation">{{ __('messages.organisation') }}</option>
                                <option value="agency">{{ __('messages.agency') }}</option>
                                <option value="person">{{ __('messages.person') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">{{ __('messages.message') }}</label>
                            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                        </div>


                        <div class="text-center d-none" id="addLoadingSpinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">{{ __('messages.loading') }}</span>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="submitAddMemberForm()">{{ __('messages.add_member') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

   <!-- Edit Member Modal -->
    <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMemberModalLabel">{{ __('messages.edit_member') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editMemberForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="edit_first_name" class="form-label">{{ __('messages.first_name') }}</label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_last_name" class="form-label">{{ __('messages.last_name') }}</label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">{{ __('messages.email') }}</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_phone" class="form-label">{{ __('messages.phone') }}</label>
                            <input type="text" class="form-control" id="edit_phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_type" class="form-label">{{ __('messages.type') }}</label>
                            <select class="form-select" id="edit_type" name="type" required>
                                <option value="person">{{ __('messages.person') }}</option>
                                <option value="organisation">{{ __('messages.organisation') }}</option>
                                <option value="agency">{{ __('messages.agency') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_message" class="form-label">{{ __('messages.message') }}</label>
                            <textarea class="form-control" id="edit_message" name="message" rows="4" required></textarea>
                        </div>



                        <div class="text-center d-none" id="editLoadingSpinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">{{ __('messages.loading') }}</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitEditMemberForm()">{{ __('messages.save_changes') }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Show Member Modal -->
    <div class="modal fade" id="showMemberModal" tabindex="-1" aria-labelledby="showMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showMemberModalLabel">{{ __('messages.member_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>{{ __('messages.first_name') }}:</strong> <span id="member-first_name"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.last_name') }}:</strong> <span id="member-last_name"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.email') }}:</strong> <span id="member-email"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.phone') }}:</strong> <span id="member-phone"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.type') }}:</strong> <span id="member-type"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.message') }}:</strong> <span id="member-message"></span></li>
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
        // Fetch and show member data in modal
        function showMember(memberId) {
            fetch(`/members/${memberId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('member-first_name').textContent = data.first_name;
                    document.getElementById('member-last_name').textContent = data.last_name;
                    document.getElementById('member-email').textContent = data.email;
                    document.getElementById('member-phone').textContent = data.phone;
                    document.getElementById('member-type').textContent = data.type;
                    document.getElementById('member-message').textContent = data.message;

                    var showMemberModal = new bootstrap.Modal(document.getElementById('showMemberModal'));
                    showMemberModal.show();
                })
                .catch(error => console.error('Error fetching member data:', error));
        }

        // Trigger Edit Member modal and populate with data
        function editMember(memberId) {
            fetch(`/members/${memberId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_first_name').value = data.first_name;
                    document.getElementById('edit_last_name').value = data.last_name;
                    document.getElementById('edit_email').value = data.email;
                    document.getElementById('edit_phone').value = data.phone;
                    document.getElementById('edit_type').value = data.type;
                    document.getElementById('edit_message').value = data.message;

                    // Set form action URL for editing the member
                    const form = document.getElementById('editMemberForm');
                    form.action = `/members/${memberId}`;

                    var editMemberModal = new bootstrap.Modal(document.getElementById('editMemberModal'));
                    editMemberModal.show();
                })
                .catch(error => console.error('Error fetching member data:', error));
        }

        // Confirm delete with SweetAlert2
        function confirmDelete(memberId) {
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
                    document.getElementById('delete-form-' + memberId).submit();
                }
            });
        }



        function submitAddMemberForm() {
            const form = document.getElementById('addMemberForm');
            const spinner = document.getElementById('addLoadingSpinner');
            
            // Show spinner
            spinner.classList.remove('d-none');

            // Simulate a loading delay or proceed with form submission
            setTimeout(() => form.submit(), 500); 
        }

        function submitEditMemberForm() {
            const form = document.getElementById('editMemberForm');
            const spinner = document.getElementById('editLoadingSpinner');
            
            // Show spinner
            spinner.classList.remove('d-none');

            // Simulate a loading delay or proceed with form submission
            setTimeout(() => form.submit(), 500); 
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