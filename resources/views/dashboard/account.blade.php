<x-dashboard.dashboard-master>
    @section('content')
        <div class="header">
            <h1 class="header-title">
                Profile
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('illustrator.profile.update', $user) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile for: {{ $user->name }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        @if (session()->has('profile-updated'))
                                            <div class="alert alert-success alert-outline-coloured alert-dismissible"
                                                role="alert">
                                                <div class="alert-icon">
                                                    <i class="far fa-fw fa-bell"></i>
                                                </div>
                                                <div class="alert-message">
                                                    {{ session('profile-updated') }}
                                                </div>

                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif


                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                id="name" placeholder="Name" value="{{ $user->name }}"
                                                name="name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text"
                                                class="form-control  {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                id="phone" placeholder="Phone" value="{{ $user->phone }}"
                                                name="phone">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text"
                                                class="form-control  {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                id="address" placeholder="Address" value="{{ $user->address }}"
                                                name="address">
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                id="email" placeholder="Email" value="{{ $user->email }}"
                                                name="email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                id="password" placeholder="Password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Confirm Password</label>
                                            <input type="password"
                                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                                id="confirm-password" placeholder="Confirm Password"
                                                name="password_confirmation">
                                            @error('password_confirmation')
                                                <div class="is-invalid">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <center>
                                                <img alt="{{ $user->name }}"
                                                    src="{{ $user->avatar == '/images/' ? $user->avatar . 'user.png' : $user->avatar }}"
                                                    class="rounded-circle img-responsive mt-2" width="128"
                                                    height="128" />
                                                <div class="mt-2 form-group">
                                                    <label for="avatar">Profile Image</label>
                                                    <input type="file" name="avatar" id="avatar"
                                                        class="form-control-file">
                                                </div>
                                                <small class="text-left">File extension allowed: jpg,jpeg,png,bmp
                                                    format</small>
                                            </center>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Shop Details for: {{ $user->name }}</h5>
                        @if (session()->has('verify'))
                            <div class="alert alert-success p-3 mt-3">
                                {{ session('verify') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="shop">Shop Name</label>
                                        <input type="text"
                                            class="form-control  {{ $errors->has('shop_name') ? 'is-invalid' : '' }}"
                                            id="shop_name" placeholder="Shop Name" value="{{ $user->shop_name }}"
                                            name="shop_name">
                                        @error('shop_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text"
                                            class="form-control  {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                            id="address" placeholder="Address" value="{{ $user->address }}"
                                            name="address">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="Logo">Logo(111 x 45)</label><br>
                                        <img alt="logo" style="max-height:100px;"
                                            src="{{ $user->logo == '/images/' ? $user->logo . 'main-logo.png' : $user->logo }}"
                                            class="rounded-block img-responsive mt-2 mb-3" width="auto"
                                            height="auto" />
                                        <input type="file" name="logo" id="logo" class="form-control-file">
                                    </div>
                                    <div class="form-group">
                                        <label for="Banner">Shop Banner (1920 x 1080)</label><br>
                                        <img alt="banner" style="max-height:100px;"
                                            src="{{ $user->banner == '/images/' ? $user->banner . 'main-logo.png' : $user->banner }}"
                                            class="rounded-block img-responsive mt-2 mb-3" width="auto"
                                            height="auto" />
                                        <input type="file" name="banner" id="banner" class="form-control-file">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Shop Description</label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>

                                </div>

                            </div>
                            <a class="btn btn-primary btn-sm" href="{{ $user->cac }}" target="_blank">View CAC
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm">Update Profile</button>
                            @if (auth()->user()->userHasRole('Admin'))
                                @if ($user->status == 0)
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('dashboard.status.account', ['user_id' => $user->id, 'status' => 1]) }}">Inactive</a>
                                @elseif($user->status == 1)
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('dashboard.status.account', ['user_id' => $user->id, 'status' => 0]) }}">Active</a>
                                @endif

                                @if ($user->verify == 0)
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('dashboard.status.verify', ['user_id' => $user->id, 'status' => 1]) }}">Verify
                                        Shop</a>
                                @elseif($user->verify == 1)
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('dashboard.status.verify', ['user_id' => $user->id, 'status' => 0]) }}">Shop
                                        Verified</a>
                                @endif
                            @elseif (auth()->user()->userHasRole('Illustrator'))
                                @if ($user->verify == 0)
                                    <a class="btn btn-danger btn-sm">Account: unverified</a>
                                @elseif($user->verify == 1)
                                    <a class="btn btn-success btn-sm">Account: verified</a>
                                @endif

                                @if ($user->status == 0)
                                    <a class="btn btn-danger btn-sm">Account: inactive</a>
                                @elseif($user->status == 1)
                                    <a class="btn btn-success btn-sm">Account: active</a>
                                @endif
                            @endif




                        </div>
                        @if (auth()->user()->userHasRole('Admin'))
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
                                                        <td><input type="checkbox"
                                                                @foreach ($user->roles as $user_role)
                                                    @if ($user_role->name == $role->name)
                                                        checked
                                                    @endif @endforeach>
                                                        </td>
                                                        <td>{{ $role->name }}</td>
                                                        <td>
                                                            <form action="{{ route('user.role.attach', $user) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="role"
                                                                    value="{{ $role->id }}">
                                                                <button type="submit" class="btn btn-primary btn-sm"
                                                                    @if ($user->roles->contains($role)) disabled @endif>Attach</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('user.role.detach', $user) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="role"
                                                                    value="{{ $role->id }}">
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    @if (!$user->roles->contains($role)) disabled @endif>Detach</button>
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
                                                        <td><input type="checkbox"
                                                                @foreach ($user->roles as $user_role)
                                                    @if ($user_role->name == $role->name)
                                                        checked
                                                    @endif @endforeach>
                                                        </td>
                                                        <td>{{ $role->name }}</td>

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
                        <div class="my-1">&nbsp;</div>
                    </div>
                </div>
            </div>
            </form>
        </div>

    @endsection
</x-dashboard.dashboard-master>
