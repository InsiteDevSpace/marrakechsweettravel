<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.donations') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <!-- Title and Add New Donation Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ __('messages.donations_list') }}</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDonationModal">
                + {{ __('messages.add_donation') }}
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
                        <th scope="col">{{ __('messages.payment_method') }}</th>
                        <th scope="col">{{ __('messages.amount') }}</th>
                        <th scope="col" class="text-center">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donations as $donation)
                        <tr>
                            <td>{{ $donation->first_name }}</td>
                            <td>{{ $donation->last_name }}</td>
                            <td>{{ $donation->phone }}</td>
                            <td>{{ $donation->email }}</td>
                            <td>{{ $donation->payment_method }}</td>
                            <td>{{ $donation->amount }}</td>
                            <td class="text-center">
                                <!-- Show, Edit, Delete Buttons -->
                                <a href="javascript:void(0);" onclick="showDonation({{ $donation->id }})" class="me-2" data-bs-toggle="tooltip" title="{{ __('messages.show') }}">
                                    <i data-feather="eye" class="action-icon text-info"></i>
                                </a>

                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $donations->links() }}
        </div>
    </div>

    <!-- Add Donation Modal -->
    <div class="modal fade" id="addDonationModal" tabindex="-1" aria-labelledby="addDonationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDonationModalLabel">{{ __('messages.add_donation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addDonationForm" action="{{ route('donations.store') }}" method="POST">
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
                            <label for="payment_method" class="form-label">{{ __('messages.payment_method') }}</label>
                            <select class="form-select" id="payment_method" name="payment_method" required onchange="toggleAmountCurrencyFields()">
                                <option value="">{{ __('messages.select_payment') }}</option> <!-- Default Option -->
                                <option value="card">{{ __('messages.card') }}</option>
                                <option value="cheque">{{ __('messages.cheque') }}</option>
                                <option value="transfer">{{ __('messages.transfer') }}</option>
                            </select>
                        </div>
                        <div class="mb-3" id="amount-wrapper" style="display: none;">
                            <label for="amount" class="form-label">{{ __('messages.amount') }}</label>
                            <input type="number" class="form-control" id="amount" name="amount" min="1">
                        </div>
                        <div class="mb-3" id="currency-wrapper" style="display: none;">
                            <label for="currency" class="form-label">{{ __('messages.currency') }}</label>
                            <select class="form-select" id="currency" name="currency">
                                <option value="EUR">EUR</option>
                                <option value="MAD">MAD</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">{{ __('messages.country') }}</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">{{ __('messages.city') }}</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">{{ __('messages.address') }}</label>
                            <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                        </div>

                        <!-- Loading Spinner -->
                        <div class="text-center d-none" id="addLoadingSpinner">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">{{ __('messages.loading') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('messages.add_donation') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Show Donation Modal -->
    <div class="modal fade" id="showDonationModal" tabindex="-1" aria-labelledby="showDonationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showDonationModalLabel">{{ __('messages.donation_details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>{{ __('messages.first_name') }}:</strong> <span id="donation-first_name"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.last_name') }}:</strong> <span id="donation-last_name"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.phone') }}:</strong> <span id="donation-phone"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.email') }}:</strong> <span id="donation-email"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.payment_method') }}:</strong> <span id="donation-payment_method"></span></li>
                        <li class="list-group-item"><strong>{{ __('messages.amount') }}:</strong> <span id="donation-amount"></span></li>
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

        // Toggle the amount and currency fields based on payment method
        function toggleAmountCurrencyFields() {
            const paymentMethod = document.getElementById('payment_method').value;
            const amountWrapper = document.getElementById('amount-wrapper');
            const currencyWrapper = document.getElementById('currency-wrapper');

            if (paymentMethod === 'card') {
                amountWrapper.style.display = 'block';
                currencyWrapper.style.display = 'block';
                document.getElementById('amount').required = true;
                document.getElementById('currency').required = true;
            } else {
                amountWrapper.style.display = 'none';
                currencyWrapper.style.display = 'none';
                document.getElementById('amount').required = false;
                document.getElementById('currency').required = false;
            }
        }

        // Ensure fields toggle when modal opens or payment method changes
        document.getElementById('payment_method').addEventListener('change', toggleAmountCurrencyFields);
        document.getElementById('addDonationModal').addEventListener('show.bs.modal', toggleAmountCurrencyFields);

        // Add form loading spinner and disable button on submission
        document.getElementById('addDonationForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default submission to manage it manually
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            document.getElementById('addLoadingSpinner').classList.remove('d-none');
            this.submit();
        });

        // Show Donation data in the modal
        function showDonation(donationId) {
            fetch(`/donations/${donationId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('donation-first_name').textContent = data.first_name;
                    document.getElementById('donation-last_name').textContent = data.last_name;
                    document.getElementById('donation-phone').textContent = data.phone;
                    document.getElementById('donation-email').textContent = data.email;
                    document.getElementById('donation-payment_method').textContent = data.payment_method;
                    document.getElementById('donation-amount').textContent = data.amount || '-';

                    var showDonationModal = new bootstrap.Modal(document.getElementById('showDonationModal'));
                    showDonationModal.show();
                })
                .catch(error => console.error('Error fetching donation data:', error));
        }


        // Trigger SweetAlert2 Success notification
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
