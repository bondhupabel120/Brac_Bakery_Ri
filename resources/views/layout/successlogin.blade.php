<!DOCTYPE html>
<html>

<head>
    <title>Simple Login System in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <br />
    <div class="container box">
        @if (Session::get('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="p-0 m-0" style="list-style: none;">
                    <li>Your Order Successfully Placed</li>
                </ul>
            </div>
        @endif
        <h3 align="center">Login to your account</h3><br />

        @if (isset(Auth::user()->email))
            <div class="alert alert-danger success-block">
                <strong>Welcome {{ Auth::user()->email }}</strong>
                <br />
                <a href="{{ url('/main/logout') }}">Logout</a>
            </div>
        @else
            <script>
                window.location = "/main";
            </script>
        @endif

        <br />
    </div>

    <?php 
        $orders = App\Models\Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
    ?>

    <section class="cart container mt-2 my-3 py-5">
        <div class="container mt-2">

            <h4>Your Cart</h4>

        </div>
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <img class="w-50 rounded-circle mb-3 mb-sm-0" style="height: 50px" src="{{ asset('img/' . $order->products->image ?? 'img/chocolate-cake.jpg') }}" alt="">
                            </td>
                            <td>{{ $order->products->name ?? '' }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>{{ $order->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </form>
    </section>
</body>

</html>
