@extends('layouts.app')

@section('title', '')

@section('contents')
    <div class="container-fluid">
        <h2 class="mt-5 mb-3">Dashboard</h2>

        <div class="row">
            @foreach($data as $item)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card {{ $item['border_color'] }} shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ $item['title'] }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $item['value'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="{{ $item['icon_class'] }} fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
