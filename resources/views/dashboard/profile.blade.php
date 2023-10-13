<x-dashboard.dashboard-master>
    @section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="header">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile for: {{$user->name}}</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{route('dashboard.profile.update', $user)}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-8">
                                        @if(session()->has('profile-updated'))

                                        <div class="alert alert-success alert-outline-coloured alert-dismissible"
                                            role="alert">
                                            <div class="alert-icon">
                                                <i class="far fa-fw fa-bell"></i>
                                            </div>
                                            <div class="alert-message">
                                                {{session('profile-updated')}}
                                            </div>

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text"
                                                class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                                id="name" placeholder="Name" value="{{$user->name}}" name="name">
                                            @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text"
                                                class="form-control  {{$errors->has('phone') ? 'is-invalid' : ''}}"
                                                id="phone" placeholder="Phone" value="{{$user->phone}}" name="phone">
                                            @error('phone')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email"
                                                class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                                                id="email" placeholder="Email" value="{{$user->email}}" name="email">
                                            @error('email')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                                                id="password" placeholder="Password" name="password">
                                            @error('password')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Confirm Password</label>
                                            <input type="password"
                                                class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}"
                                                id="confirm-password" placeholder="Confirm Password"
                                                name="password_confirmation">
                                            @error('password_confirmation')
                                            <div class="is-invalid">{{$message}}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group">
                                            <label for="inputUsername">Biography</label>
                                            <textarea rows="2" class="form-control" id="inputBio"
                                                placeholder="Tell something about yourself"></textarea>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="text-center">
                                            <img alt="{{$user->name}}" src="{{$user->avatar == "
                                                /images/"?$user->avatar."user.png":$user->avatar}}"
                                            class="rounded-circle
                                            img-responsive mt-2"
                                            width="128" height="128" />
                                            <div class="mt-2">
                                                <input type="file" name="avatar" id="avatar" class="form-control-file">
                                            </div>
                                            <small>File extension allowed: jpg,jpeg,png,bmp
                                                format</small>
                                        </div>
                                    </div> --}}
                                </div>

                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>

                        </div>
                        @if(auth()->user()->userHasRole('Admin'))
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Role</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Options</th>
                                                <th>Name</th>
                                                <th>Attach</th>
                                                <th>Detach</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)

                                            <tr>
                                                <td><input type="checkbox" @foreach ($user->roles as $user_role)
                                                    @if ($user_role->name == $role->name)
                                                    checked
                                                    @endif
                                                    @endforeach
                                                    ></td>
                                                <td>{{$role->name}}</td>
                                                <td>
                                                    <form action="{{route('user.role.attach', $user)}}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="role" value="{{$role->id}}">
                                                        <button type="submit" class="btn btn-primary btn-sm" @if($user->roles->contains($role)) disabled @endif>Attach</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{route('user.role.detach', $user)}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="role" value="{{$role->id}}">
                                                        <button type="submit" class="btn btn-danger btn-sm" @if (!$user->roles->contains($role)) disabled @endif>Detach</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Options</th>
                                                <th>Name</th>
                                                <th>Attach</th>
                                                <th>Detach</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                        @else
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Role</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Options</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)

                                            <tr>
                                                <td><input type="checkbox" @foreach ($user->roles as $user_role)
                                                    @if ($user_role->name == $role->name)
                                                    checked
                                                    @endif
                                                    @endforeach
                                                    ></td>
                                                <td>{{$role->name}}</td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Options</th>
                                                <th>Name</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                        @endif
                        <div class="my-5">&nbsp;</div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    @endsection
</x-dashboard.dashboard-master>