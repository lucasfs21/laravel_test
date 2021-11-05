@extends('layouts.layout')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endsection

@section('content')
    <!-- Page Heading -->
    <input type="hidden" id="id" value="{{$id}}">
    <h1 class="h3 mb-4 text-gray-800">Edit</h1>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-4">
                                <?php
                                    $formattedDate = explode('-', $patrimony['date']);
                                    $formattedDate = "$formattedDate[2]/$formattedDate[1]/$formattedDate[0]";
                                ?>
                                <label for="date" class="form-label">Date</label>
                                <input type="text" class="form-control" id="date" value="{{$formattedDate}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-4">
                                <label for="fund" class="form-label">Fund</label>
                                <select class="form-select" aria-label="Default select example" id="fund">
                                    @foreach($data as $fund)
                                        @if($fund['id'] == $patrimony['fund_id'])
                                            <option selected value="{{$fund['id']}}">{{$fund['name']}}</option>
                                        @else
                                            <option value="{{$fund['id']}}">{{$fund['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-4">
                                <label for="value" class="form-label">Value</label>
                                <input type="number" class="form-control" id="value" value="{{$patrimony['value']}}">
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
        const urlSendData = '{{route('patrimonies.update')}}'
        const urlIndex = '{{route('patrimonies.index')}}'
    </script>
    <script src="{{ mix('assets/fund/js/edit.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection
