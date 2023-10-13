<x-dashboard.dashboard-master>
    @section('content')
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Illustrators</h5>
                </div>
                <div class="card-body table-responsive">
                    @if (session()->has('user-deleted'))
                        <div class="alert alert-danger alert-outline-coloured alert-dismissible" role="alert">
                            <div class="alert-icon">
                                <i class="far fa-fw fa-bell"></i>
                            </div>
                            <div class="alert-message">
                                {{ session('user-deleted') }}
                            </div>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('status'))
                        <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                            <div class="alert-icon">
                                <i class="far fa-fw fa-bell"></i>
                            </div>
                            <div class="alert-message">
                                {{ session('status') }}
                            </div>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    @if (session()->has('verify'))
                        <div class="alert alert-success p-3 mt-3">
                            {{ session('verify') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Verify</th>
                                    <th>Status</th>
                                    <th>Shop</th>
                                    <th>cac</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $users)
                                    <tr>
                                        <td><img alt="Photo"
                                                src="{{ $users->avatar == '/images/' ? $users->avatar . 'user.png' : $users->avatar }}"
                                                class="rounded-circle img-responsive mt-2" height="30px" /></td>
                                        <td><a href="{{ route('dashboard.account', $users->id) }}">{{ $users->name }}</a>
                                        </td>
                                        {{-- <td>{{Str::limit($users->email, '15', '...')}}</td> --}}
                                        <td>
                                            @if ($users->verify == 0)
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('dashboard.status.verify', ['user_id' => $users->id, 'status' => 1]) }}">Verify
                                                    Shop</a>
                                            @elseif($users->verify == 1)
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('dashboard.status.verify', ['user_id' => $users->id, 'status' => 0]) }}">Shop
                                                    Verified</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($users->status == 0)
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('dashboard.status.account', ['user_id' => $users->id, 'status' => 1]) }}">Inactive</a>
                                            @elseif($users->status == 1)
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('dashboard.status.account', ['user_id' => $users->id, 'status' => 0]) }}">Active</a>
                                            @endif
                                        </td>
                                        <td>{{ $users->shop_name }}</td>
                                        <td><a href="{{ $users->cac }}" class="btn btn-primary btn-sm"
                                                target="_blank">View Doc</a></td>

                                        <td>
                                            <form action="{{ route('dashboard.destroy', $users->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Verify</th>
                                    <th>Status</th>
                                    <th>Shop</th>
                                    <th>cac</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endsection
</x-dashboard.dashboard-master>
