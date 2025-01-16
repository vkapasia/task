<x-app-layout>
    <x-slot name="header">
        <div class="d-md-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Leads') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight d-md-flex gap-3">
                <form method="GET" action="{{ route('leads') }}">
                    <select name="status" class="my-3 my-md-0 form-select" onchange="this.form.submit()">
                        <option value="">Status</option>
                        <option value="New" {{ request('status') == 'New' ? 'selected' : '' }}>New</option>
                        <option value="Contacted" {{ request('status') == 'Contacted' ? 'selected' : '' }}>Contacted
                        </option>
                        <option value="Qualified" {{ request('status') == 'Qualified' ? 'selected' : '' }}>Qualified
                        </option>
                        <option value="Lost" {{ request('status') == 'Lost' ? 'selected' : '' }}>Lost</option>
                    </select>
                </form>
                <button class="delete-btn btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#restoreModal">
                    Restore Deleted Leads
                </button>
                <a class="btn btn-sm btn-success" href="{{route('addLead')}}">{{ __('Add') }}</a>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">S no.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($leads as $key => $lead)
                                <tr>
                                    <td scope="row">{{$key + 1}}</td>
                                    <td>{{$lead->name}}</td>
                                    <td>{{$lead->email}}</td>
                                    <td>{{$lead->phone}}</td>
                                    <td>{{$lead->status}}</td>
                                    <td><a href="{{route('editLead', $lead->id)}}"><button class="btn btn-sm btn-secondary">
                                                Edit
                                            </button></a> | <button class="delete-btn btn btn-sm btn-danger"
                                            data-id="{{$lead->id}}" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                            Delete </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No Leads Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    {{ $leads->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- leads restore popup  -->

    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreModalLabel">Confirm Restoreation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle warning-icon"></i>
                    <p class="mb-0">Are you sure you want to Restore All Deleted Leads?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <a href="{{route('restoreLeads')}}">

                        <button type="button" class="btn btn-success">
                            <i class="fas fa-trash-alt me-2"></i>Restore
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- delete confirm popup  -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle warning-icon"></i>
                    <p class="mb-0">Are you sure you want to delete this lead?<br>This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="button" class="confirm-delete btn btn-danger" id="savebutton">
                        <i class="fas fa-trash-alt me-2"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- confirmation popup   -->

    <div class="modal fade" id="deleteconfirmModal" tabindex="-1" aria-labelledby="deleteconfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteconfirmModalLabel">Deleted</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle warning-icon"></i>
                    <p class="mb-0">Lead deleted successfully<br>This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Ok
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            let dataId; // Variable to store the data-id

            $(".delete-btn").on("click", function () {
                dataId = $(this).data("id"); // Get the data-id from the button
            });

            // When the confirm button in the modal is clicked
            $(".confirm-delete").on("click", function () {
                if (dataId) {

                    $.ajax({
                        url: `{{ route('deleteLead') }}`,
                        type: 'post',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                            id: dataId
                        },
                        success: function (response) {
                            // Optionally hide the modal and remove the deleted item from the DOM
                            $('#confirmModal').modal('hide');
                            $('#deleteconfirmModal').modal('show');
                            $(`button[data-id="${dataId}"]`).closest('tr').remove(); // Example: Removing table row
                        },
                        error: function (xhr) {
                            // Handle error
                            console.error("Error deleting record", xhr);
                        }
                    });

                } else {
                    console.log("No data-id found.");
                }
            });
        });
    </script>
</x-app-layout>