<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traffic Light System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">System Status</h3>

        <div class="row mb-5">
            @foreach($trafficLights as $trafficLight)
                <div class="col-3 p-4">
                    {{-- <a href="{{ route('traffic-light.details', ['id' => $trafficLight->id]) }}" class="card-link"> --}}
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Traffic Light {{$trafficLight->id}}</h5>
                                <p class="card-text">
                                    <span class="badge badge-{{ $trafficLight->status == 'off' ? 'danger' : 'success' }} p-2">
                                        {{ strtoupper($trafficLight->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    {{-- </a> --}}
                </div>
            @endforeach
        </div>

        <div class="row">
            @foreach($trafficLights as $trafficLight)
                <div class="col-6 p-4">
                    {{-- <a href="{{ route('traffic-light.details', ['id' => $trafficLight->id]) }}" class="card-link"> --}}
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Traffic Light Details</h5>
                                <div class="card-text">
                                    <p><strong>ID:</strong> {{$trafficLight->id}}</p>
                                    <p><strong>Serial:</strong> {{$trafficLight->serial}}</p>
                                    <p><strong>Current Car Count:</strong> {{$trafficLight->current_car_count}}</p>
                                    <p>
                                        <strong>Current Color:</strong>
                                        <span class="badge badge-{{ $trafficLight->color == 'red' ? 'danger' : ($trafficLight->color == 'yellow' ? 'warning' : 'success') }}">
                                            {{ucfirst($trafficLight->color)}}
                                        </span>
                                    </p>
                                    <p><strong>Time Limit:</strong> {{$trafficLight->lightColors()->latest()->first()->time_limit}} seconds</p>
                                </div>
                            </div>
                        </div>
                    {{-- </a> --}}
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
