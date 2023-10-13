<x-dashboard.dashboard-master>
    @section('content')
        <style>
            .chat-message {
                padding: 10px;
                border-radius: 10px;
                margin-bottom: 10px;
                font-size: 16px;
            }

            .buyer-message {
                background-color: #DCF8C6;
                color: #000;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 10px;
                text-align: right;
                /* Align buyer messages to the right */
            }

            .seller-message {
                background-color: #EAEAEA;
                color: #000;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 10px;
                text-align: left;
                /* Align seller messages to the left */
            }
        </style>
        <div class="col-12">
            <div class="header">
                <h1 class="header-title">
                    Chat
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Chat</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-sm-4 col-md-5 col-xl-3 border-right">

                        <div class="user-list mt-4">
                            <ul class="list-group mt-4">
                                <!-- User list goes here -->
                            </ul>
                        </div>

                        <hr class="d-block d-lg-none mt-1 mb-0" />
                    </div>
                    <div class="col-sm-8 col-md-7 col-xl-9">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="media align-items-center py-1">
                                <div class="position-relative">
                                    {{-- <img src="img/avatars/avatar-3.jpg" class="rounded-circle mr-1" alt="Kathie Burton" width="40" height="40"> --}}
                                </div>
                                <div class="media-body pl-3">
                                    <strong>Chats</strong>
                                    <div class="text-muted small"><em>{You are online}</em></div>
                                    <div id="error-messages"></div>
                                </div>
                                {{-- <div>
                                    <button class="btn btn-primary btn-lg mr-1 px-3"><i class="feather-lg" data-feather="phone"></i></button>
                                    <button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><i class="feather-lg"
                                            data-feather="video"></i></button>
                                    <button class="btn btn-light border btn-lg px-3"><i class="feather-lg" data-feather="more-horizontal"></i></button>
                                </div> --}}
                            </div>
                        </div>

                        <div class="position-relative">
                            <div id="chat-body" class="chat-messages p-4" style="max-height:500px; min-height:300px;">
                                <div id="chatMessages"></div>

                            </div>
                        </div>

                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <form method="POST" id="chatForm">

                                <div id="extraInput"></div>
                                <div class="input-group">
                                    <input type="text" name="message" class="form-control" id="message"
                                        placeholder="Type your message">
                                    <input type="hidden" name="seller_id" value="{{ auth()->user()->id }}" id="seller_id">
                                    <input type="hidden" name="sender_type" value="seller" id="sender_type">
                                    <div class="input-group-append">
                                        <button id="sendMessage" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script>
            $(document).ready(function() {

            var buyer_id = $("#buyer_id").val();
            var product_id = $("#product_id").val();

                $('#chatForm').submit(function(event) {
                    event.preventDefault();

                    // var form = $(this);
                    // var url = form.attr('action');
                    // var data = form.serialize();
            var buyer_id = $("#buyer_id").val();
            var product_id = $("#product_id").val();
            var message = $("#message").val();
            var seller_id = $("#seller_id").val();
            var sender_type = $("#sender_type").val();

                    $.ajax({
                        type: 'POST',
                        // url: url,
                        url: '{{ route('chat.store') }}',
                        data: {
                            buyer_id:buyer_id,
                            product_id:product_id,
                            message:message,
                            seller_id:seller_id,
                            sender_type:sender_type,
                            _token: '{{ csrf_token() }}',
                        },
                        dataType: 'json',
                        success: function(response) {
                            // getMessage();
                            fetchChatMessages(buyer_id, product_id);
                            // Handle the successful response
                            console.log(response);

                            // $("#message").trigger('reset');
                            $("#message").val('');
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response
                            console.log(error);
                            if (xhr.responseText) {
                    var errorMessage = JSON.parse(xhr.responseText);
                    if (errorMessage.errors) {
                        var errorDiv = $('#error-messages');
                        errorDiv.empty(); // Clear previous error messages
                        
                        $.each(errorMessage.errors, function(field, errors) {
                            $.each(errors, function(index, error) {
                                errorDiv.append('<p class="alert alert-danger px-1 py-1">' + error + '</p>');
                                // $("#submitbtn").text("PLACE ORDER");
                                // $("#submitbtn").prop('disabled',false);
                            });
                        });
                    } else {
                        alert('Error: ' + xhr.responseText);
                    }
                } else {
                    alert('An error occurred: ' + error);
                }
                        }
                    });
                });


                fetchUserList();
                var messageInterval = null;

                $(document).on('click', '.chat-customer', function() {
                    var customerId = $(this).data('customer-id');
                    var productId = $(this).data('product-id');
                    // alert(customerId+""+productId);
                    $('.chat-customer').removeClass('active');
                    $(this).addClass('active');
                    clearInterval(messageInterval);
                    fetchChatMessages(customerId, productId);
                    var extraInputCustomer = `<input name="buyer_id" type="hidden" value="` + customerId +
                        `" id="buyer_id" class="form-control"><input name="product_id" id="product_id" type="hidden" value="` +
                        productId + `" class="form-control">`;
                    $("#extraInput").html(extraInputCustomer);
                    messageInterval = setInterval(function() {
                    fetchChatMessages(customerId, productId);
                }, 5000);

                });

                function fetchUserList() {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('chat.userList') }}',
                        dataType: 'json',
                        success: function(response) {
                            var userList = response.userList;
                            var userListContainer = $('.user-list ul');
                            userListContainer.empty();

                            $.each(userList, function(index, user) {
                                var userItem = $(
                                        '<li class="list-group-item list-group-item-action border-0 chat-customer"></li>'
                                        )
                                    .attr('data-customer-id', user.id)
                                    .attr('data-product-id', user.product)
                                    .append(
                                        $('<div class="media"></div>')
                                        .append(
                                            $('<img class="rounded-circle mr-1">')
                                            .attr('src', user.avatar)
                                            .attr('alt', user.name)
                                            .attr('width', '40')
                                            .attr('height', '40')
                                        )
                                        .append(
                                            $('<div class="media-body ml-3"></div>')
                                            .append($('<div></div>').text(user.name))
                                            .append($('<div class="small">()</div>').text(user
                                                .product_name))
                                        )
                                    );

                                userListContainer.append(userItem);
                            });
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });


            function fetchChatMessages(customerId, productId) {
                var seller_id = {{ Auth()->user()->id }};
                $.ajax({
                    type: 'POST',
                    url: '{{ route('chat.fetch') }}',
                    data: {
                        product_id: productId,
                        buyer_id: customerId,
                        seller_id: seller_id,
                        sender_type: 'seller', // Specify the sender type as 'buyer'
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Handle the successful response
                        console.log(response);

                        var messages = response.messages;
                        var chatMessages = $('#chatMessages');
                        var chatBody = $('#chat-body');
                        var scrollHeight = chatBody.prop('scrollHeight'); // Get the current scroll height
                        chatMessages.empty();

                        // Compare new messages with existing messages and display only the new ones
                        for (var i = 0; i < messages.length; i++) {
                            var message = messages[i];
                            var chatMessage = $('<div></div>').text(message.message);

                            if (message.sender_type === 'buyer') {
                                chatMessage.addClass('buyer-message');
                            } else if (message.sender_type === 'seller') {
                                chatMessage.addClass('seller-message');
                            }

                            chatMessages.append(chatMessage);
                        }

                        var newScrollHeight = chatBody.prop(
                        'scrollHeight'); // Get the new scroll height after appending new messages

                        // Scroll to the bottom if new messages were added
                        if (newScrollHeight > scrollHeight) {
                            chatBody.scrollTop(newScrollHeight);
                        }
                    },
                    error: function(error) {
                        // Handle the error response
                        console.log(error);
                    }
                });
            }
        </script>
    @endsection
</x-dashboard.dashboard-master>
