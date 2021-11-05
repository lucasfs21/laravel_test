@extends('layouts.layout')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">New</h1>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-4">
                                <label for="date" class="form-label">Date</label>
                                <input type="text" class="form-control" id="date">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-4">
                                <label for="fund" class="form-label">Fund</label>
                                <select class="form-select" aria-label="Default select example" id="fund">
                                    @foreach($data as $fund)
                                        <option value="{{$fund['id']}}">{{$fund['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-4">
                                <label for="value" class="form-label">Value</label>
                                <input type="number" class="form-control" id="value">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-4">
                                <button id="submitButton" type="button" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const token = "{{ csrf_token() }}"
        const urlSendData = '{{route('patrimonies.save')}}'
        const urlIndex = '{{route('patrimonies.index')}}'
    </script>
    <script src="{{ mix('assets/fund/js/new.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection
