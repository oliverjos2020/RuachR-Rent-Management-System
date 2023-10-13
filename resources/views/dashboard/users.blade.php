<x-dashboard.dashboard-master>
    @section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-users"></i> Users
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Registered</th>
                                    <th>Updated</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                
                                    <tr>
                                        
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Registered</th>
                                        <th>Updated</th>
                                        <th>Delete</th>
                                    </tr>
                                
                            </tfoot>
                            <tbody>
                               @foreach ($user as $users)
                            
                            <tr>
                                {{-- <td><img alt="Photo" src="{{$users->avatar == " /images/"?$users->avatar."user.png":$users->avatar}}"
                                    class="rounded-circle img-responsive mt-2" height="30px" /></td> --}}
                                <td><a href="{{route('dashboard.profile', $users->id)}}">{{$users->name}}</a></td>
                                <td>{{$users->email}}</td>
                                <td>{{$users->phone}}</td>
                                <td>{{$users->created_at->diffForHumans()}}</td>
                                <td>{{$users->updated_at->diffForHumans()}}</td>
                                <td>
                                    <form action="{{route('dashboard.destroy', $users->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
            <!-- /tables-->
        </div>
    </div>
   
    @endsection
    </x-dashboard.dashboard-master>
    
    