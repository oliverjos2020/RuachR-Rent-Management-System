<x-dashboard.dashboard-master>
    @section('content')
    <div class="header">
        <h1 class="header-title">
            Biodata
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Biodata</li>
            </ol>
        </nav>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Biodata for: {{$user->name}}</h5>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{route('dashboard.biodata.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                @if(session()->has('biodata-created'))

                                <div class="alert alert-success alert-outline-coloured alert-dismissible" role="alert">
                                    <div class="alert-icon">
                                        <i class="far fa-fw fa-bell"></i>
                                    </div>
                                    <div class="alert-message">
                                        {{session('biodata-created')}}
                                    </div>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="marital_satus">Marital Status</label>
                                    {{-- <select name="marital_satus" class="form-control">
                                        <option value="">Select an option</option>
                                        <option>Single</option>
                                        <option>Married</option>
                                    </select> --}}
                                    <input type="text" name="marital_status" id="marital_status" class="form-control {{$errors->has('marital_status') ? 'is-invalid' : ''}}">
                                    
                                    @error('marital_status')
                                        <div class="invalid-feedback">{{$message}}</div>                                        
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control  {{$errors->has('occupation') ? 'is-invalid' : ''}}" id="occupation" placeholder="occupation" name="occupation">
                                    @error('occupation')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">State of origin</label>
                                    <input type="text" class="form-control {{$errors->has('state') ? 'is-invalid' : ''}}" id="state" placeholder="State of origin"name="state">
                                    @error('state')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <input type="text" class="form-control {{$errors->has('religion') ? 'is-invalid' : ''}}" id="religion" placeholder="Religion" name="religion">
                                    @error('religion')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tribe">Tribe</label>
                                    <input type="text" class="form-control {{$errors->has('tribe') ? 'is-invalid' : ''}}" id="tribe" placeholder="Tribe" name="tribe">
                                    @error('tribe')
                                        <div class="is-invalid">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
                
                <div class="my-5">&nbsp;</div>
            </div>
        </div>
    </div>

    
    </div>
    @endsection
    </x-dashboard.dashboard-master>
    
    