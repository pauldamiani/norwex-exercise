<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Customer List</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .container {
                max-width: 1000px;
                margin-left: auto;
                margin-right: auto;
                padding-left: 10px;
                padding-right: 10px;
            }

            .table100 {
                background-color: #fff;
            }

            table {
                width: 100%;
            }

            th, td {
                font-weight: unset;
                padding-right: 10px;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Customer Status</th>
                <th>Customer Order Total</th>
                <th>Last Order Date</th>
                <th>Total Orders</th>
            </tr>
            @foreach($customers as $key => $value)
            <tr>
                @if($value->customerStatus != 1)
                    <td style="color:red">{{$value->name}}</td>
                @elseif ($value->lastThreeMonths >= 200)
                    <td style="color:green">{{$value->name}}</td>
                @elseif ($value->madeOrderThisYear != 1)
                    <td style="color:orange">{{$value->name}}</td>
                @else
                    <td style="color">{{$value->name}}</td>
                @endif
                <td>@if($value->customerStatus == 1)
                        Active
                    @else
                        Removed
                    @endif
                </td>
                <td>${{$value->orderTotal}}</td>
                <td>{{$value->latestOrderDate}}</td>
                <td>{{$value->orderCount}}</td>
            </tr>
            @endforeach
        </table>

        <div class="content">
            <div class="links">
                <a style="text-decoration:underline" href="/">Home</a>
            </div>
        </div>
    </body>
</html>