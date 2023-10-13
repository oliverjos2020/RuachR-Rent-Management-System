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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Account Setup For: {{ auth()->user()->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <form action="{{route('create.subaccount')}}" method="post" >
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="row">
                                    <div class="col-md-8">
                                        @if (session()->has('created'))
                                            <div class="alert alert-info alert-outline-coloured alert-dismissible"
                                                role="alert">
                                                <div class="alert-icon">
                                                    <i class="far fa-fw fa-bell"></i>
                                                </div>
                                                <div class="alert-message">
                                                    {{ session('created') }}
                                                </div>

                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="name">Business Name</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('business_name') ? 'is-invalid' : '' }}"
                                                id="business_name" placeholder="Business Name" name="business_name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="Bank_Name">Bank Name</label>
                                            <select class="form-control" name="bank_code">
                                                <option value="">Select bank</option>
                                                <option value="120001">9mobile 9Payment Service Bank</option>
                                                <option value="801">Abbey Mortgage Bank</option>
                                                <option value="51204">Above Only MFB</option>
                                                <option value="51312">Abulesoro MFB</option>
                                                <option value="044">Access Bank</option>
                                                <option value="063">Access Bank (Diamond)</option>
                                                <option value="602">Accion Microfinance Bank</option>
                                                <option value="50036">Ahmadu Bello University Microfinance Bank</option>
                                                <option value="120004">Airtel Smartcash PSB</option>
                                                <option value="51336">AKU Microfinance Bank</option>
                                                <option value="035A">ALAT by WEMA</option>
                                                <option value="50926">Amju Unique MFB</option>
                                                <option value="51341">AMPERSAND MICROFINANCE BANK</option>
                                                <option value="50083">Aramoko MFB</option>
                                                <option value="401">ASO Savings and Loans</option>
                                                <option value="MFB50094">Astrapolaris MFB LTD</option>
                                                <option value="51229">Bainescredit MFB</option>
                                                <option value="50117">Banc Corp Microfinance Bank</option>
                                                <option value="50931">Bowen Microfinance Bank</option>
                                                <option value="FC40163">Branch International Financial Services Limited
                                                </option>
                                                <option value="565">Carbon</option>
                                                <option value="865">CASHCONNECT MFB</option>
                                                <option value="50823">CEMCS Microfinance Bank</option>
                                                <option value="50171">Chanelle Microfinance Bank Limited</option>
                                                <option value="023">Citibank Nigeria</option>
                                                <option value="50910">Consumer Microfinance Bank</option>
                                                <option value="50204">Corestep MFB</option>
                                                <option value="559">Coronation Merchant Bank</option>
                                                <option value="FC40128">County Finance Limited</option>
                                                <option value="51297">Crescent MFB</option>
                                                <option value="50162">Dot Microfinance Bank</option>
                                                <option value="050">Ecobank Nigeria</option>
                                                <option value="50263">Ekimogun MFB</option>
                                                <option value="098">Ekondo Microfinance Bank</option>
                                                <option value="50126">Eyowo</option>
                                                <option value="51318">Fairmoney Microfinance Bank</option>
                                                <option value="070">Fidelity Bank</option>
                                                <option value="51314">Firmus MFB</option>
                                                <option value="011">First Bank of Nigeria</option>
                                                <option value="214">First City Monument Bank</option>
                                                <option value="107">FirstTrust Mortgage Bank Nigeria</option>
                                                <option value="50315">FLOURISH MFB</option>
                                                <option value="501">FSDH Merchant Bank Limited</option>
                                                <option value="812">Gateway Mortgage Bank LTD</option>
                                                <option value="00103">Globus Bank</option>
                                                <option value="100022">GoMoney</option>
                                                <option value="50739">Goodnews Microfinance Bank</option>
                                                <option value="562">Greenwich Merchant Bank</option>
                                                <option value="058">Guaranty Trust Bank</option>
                                                <option value="51251">Hackman Microfinance Bank</option>
                                                <option value="50383">Hasal Microfinance Bank</option>
                                                <option value="030">Heritage Bank</option>
                                                <option value="120002">HopePSB</option>
                                                <option value="51244">Ibile Microfinance Bank</option>
                                                <option value="50439">Ikoyi Osun MFB</option>
                                                <option value="50442">Ilaro Poly Microfinance Bank</option>
                                                <option value="50457">Infinity MFB</option>
                                                <option value="301">Jaiz Bank</option>
                                                <option value="50502">Kadpoly MFB</option>
                                                <option value="082">Keystone Bank</option>
                                                <option value="50200">Kredi Money MFB LTD</option>
                                                <option value="50211">Kuda Bank</option>
                                                <option value="90052">Lagos Building Investment Company Plc.</option>
                                                <option value="50549">Links MFB</option>
                                                <option value="031">Living Trust Mortgage Bank</option>
                                                <option value="303">Lotus Bank</option>
                                                <option value="50563">Mayfair MFB</option>
                                                <option value="50304">Mint MFB</option>
                                                <option value="50515">Moniepoint MFB</option>
                                                <option value="120003">MTN Momo PSB</option>
                                                <option value="00107">Optimus Bank Limited</option>
                                                <option value="100002">Paga</option>
                                                <option value="999991">PalmPay</option>
                                                <option value="104">Parallex Bank</option>
                                                <option value="311">Parkway - ReadyCash</option>
                                                <option value="999992">Paycom</option>
                                                <option value="50743">Peace Microfinance Bank</option>
                                                <option value="51146">Personal Trust MFB</option>
                                                <option value="50746">Petra Mircofinance Bank Plc</option>
                                                <option value="076">Polaris Bank</option>
                                                <option value="50864">Polyunwana MFB</option>
                                                <option value="105">PremiumTrust Bank</option>
                                                <option value="101">Providus Bank</option>
                                                <option value="51293">QuickFund MFB</option>
                                                <option value="502">Rand Merchant Bank</option>
                                                <option value="90067">Refuge Mortgage Bank</option>
                                                <option value="51286">Rigo Microfinance Bank Limited</option>
                                                <option value="50767">ROCKSHIELD MICROFINANCE BANK</option>
                                                <option value="125">Rubies MFB</option>
                                                <option value="51113">Safe Haven MFB</option>
                                                <option value="951113">Safe Haven Microfinance Bank Limited</option>
                                                <option value="50582">Shield MFB</option>
                                                <option value="51062">Solid Allianze MFB</option>
                                                <option value="50800">Solid Rock MFB</option>
                                                <option value="51310">Sparkle Microfinance Bank</option>
                                                <option value="221">Stanbic IBTC Bank</option>
                                                <option value="068">Standard Chartered Bank</option>
                                                <option value="51253">Stellas MFB</option>
                                                <option value="232">Sterling Bank</option>
                                                <option value="100">Suntrust Bank</option>
                                                <option value="50968">Supreme MFB</option>
                                                <option value="302">TAJ Bank</option>
                                                <option value="090560">Tanadi Microfinance Bank</option>
                                                <option value="51269">Tangerine Money</option>
                                                <option value="51211">TCF MFB</option>
                                                <option value="102">Titan Bank</option>
                                                <option value="100039">Titan Paystack</option>
                                                <option value="50840">U&amp;C Microfinance Bank Ltd (U AND C MFB)</option>
                                                <option value="MFB51322">Uhuru MFB</option>
                                                <option value="50870">Unaab Microfinance Bank Limited</option>
                                                <option value="50871">Unical MFB</option>
                                                <option value="51316">Unilag Microfinance Bank</option>
                                                <option value="032">Union Bank of Nigeria</option>
                                                <option value="033">United Bank For Africa</option>
                                                <option value="215">Unity Bank</option>
                                                <option value="566">VFD Microfinance Bank Limited</option>
                                                <option value="51355">Waya Microfinance Bank</option>
                                                <option value="035">Wema Bank</option>
                                                <option value="057">Zenith Bank</option>
                                                <option value="057">Zenith Bank</option>
                                            </select>
                                            @error('bank_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="accountNumber">Account Number</label>
                                            <input type="number"
                                                class="form-control  {{ $errors->has('account_number') ? 'is-invalid' : '' }}"
                                                id="accountNumber" placeholder="Account Number" name="account_number">
                                            @error('account_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Create Account</button>
                            </form>


                            <div class="container mt-4">
                                <table class="table mt-4 table-bordered">
                                    <tr>
                                        <th>Business Name</th>
                                        <th>Bank Code</th>
                                        <th>Account Number</th>
                                        <th>Account Code</th>
                                    </tr>
                                    @forelse ($account as $accounts)
                                    <tr>
                                        <td>{{$accounts->business_name}}</td>
                                        <td>{{$accounts->bank_code}}</td>
                                        <td>{{$accounts->account_number}}</td>
                                        <td>{{$accounts->account_code}}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center font-weight-500"><strong>No Account Setup</strong></td>
                                        </tr>
                                    @endforelse
                                    
                                </table>
                            </div>
                        </div>

                        <div class="my-5">&nbsp;</div>
                    </div>
                </div>
            </div>


        </div>
    @endsection
</x-dashboard.dashboard-master>
