@extends('layouts.app')

@section('title', '')

@section('contents')
    <div class="container">
        <h2 class="mt-5 mb-3">Dashboard</h2>

        <div class="row">
            <div class="col-md-3 mb-4">
                <!-- Navigation Bar -->
                <div class="list-group">
                    <a href="#" id="researchLink" class="list-group-item list-group-item-action">Research</a>
                    <!-- Add more links for other entities as needed -->
                </div>
            </div>
            <div class="col-md-9">
                <!-- Main Content -->
                <div class="info-box custom-info-box" id="researchInfoBox" style="display: none;">
                    <span class="info-box-icon bg-info"><i class="fas fa-book"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Research</span>
                        <span class="info-box-number" id="totalResearch"></span>
                    </div>
                </div>

                <!-- Bar Chart -->
                <div class="card shadow mb-4" id="researchChartCard" style="display: none;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Research Per Year</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="researchPerYearChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
