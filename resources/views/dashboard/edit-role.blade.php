<x-dashboard.dashboard-master>
    @section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="header">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit role: {{$role->name}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <form action="{{route('dashboard.role.update', $role->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text"
                                                    class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                                    id="name" placeholder="Name" value="{{$role->name}}" name="name">
                                                @error('name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Update Role</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @if(session()->has('role-updated'))

                            <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                                <div class="alert-icon">
                                    <i class="far fa-fw fa-bell"></i>
                                </div>
                                <div class="alert-message">
                                    {{session('role-updated')}}
                                </div>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @endif
                            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)

                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td><a href="{{route('dashboard.editrole', $role->id)}}">{{$role->name}}</a>
                                        </td>
                                        <td>
                                            <form action="{{route('dashboard.role.destroy', $role)}}" method="post">
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
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>



                </div>
                <div class="my-5">&nbsp;</div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    @endsection
</x-dashboard.dashboard-master>