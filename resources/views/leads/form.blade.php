<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($data['id']) {{ __('Edit Leads') }} @else {{ __('Add Leads') }} @endif
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="btn btn-primary" href="{{route('leads')}}">{{ __('Manage Leads') }}</a>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="@if($data['id']) {{route('editLeadForm')}} @else {{route('addLeadForm')}} @endif" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$data['id']}}" >
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{($data['name']) ? $data['name'] : old('name')}}" id="name" name="name" placeholder="Name">
                            @error('name')
                                <div class="alert alert-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{($data['email']) ? $data['email'] : old('email')}}" id="email" name="email" placeholder="Email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @error('email')
                                <div class="alert alert-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="phone form-control" value="{{($data['phone']) ? $data['phone'] : old('phone')}}" id="phone" name="phone" placeholder="Phone">
                            @error('phone')
                                <div class="alert alert-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option selected value="" >Select Status</option>
                                <option @if (old('status') == 'New' || $data['status'] == 'New') selected @endif value="New">New</option>
                                <option @if (old('status') == 'Contacted' || $data['status'] == 'Contacted') selected @endif value="Contacted">Contacted</option>
                                <option @if (old('status') == 'Qualified' || $data['status'] == 'Qualified') selected @endif value="Qualified">Qualified</option>
                                <option @if (old('status') == 'Lost' || $data['status'] == 'Lost') selected @endif value="Lost">Lost</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">@if($data['id']) {{ __('Update') }} @else {{ __('Add') }} @endif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>