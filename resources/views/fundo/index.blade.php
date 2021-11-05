@extends('layouts.layout')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />

@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Index</h1>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <label for="date" class="form-label">Selecione um intervalo de data</label>
                            <input type="text" class="form-control" id="date">
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="row">
                        <div class="col-12">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                <a href="{{route('patrimonies.new')}}" class="btn btn-success btn-circle" title="New Patrimony">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
        <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table" id="patrimonyTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fund</th>
                                <th scope="col">Date</th>
                                <th scope="col">Value</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $patrimony)
                                <tr>
                                    <td>{{$patrimony['id']}}</td>
                                    <td>{{$patrimony['fund_name']}}</td>
                                    <td>{{$patrimony['date']}}</td>
                                    <td>{{$patrimony['value']}}</td>
                                    <td>
                                        <a href="{{route('patrimonies.edit', $patrimony['id'])}}" class="btn btn-warning btn-circle btn-sm" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button data-id="{{$patrimony['id']}}" type="button" class="btn btn-danger btn-circle btn-sm delete" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const searchForFundAssets ='{{route('patrimonies.search_for_fund_assets')}}'
        const urlDelete = '{{route('patrimonies.delete')}}'
        const urlIndex = '{{route('patrimonies.index')}}'
        const token = "{{ csrf_token() }}"
    </script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="{{ mix('assets/fund/js/index.js') }}" type="text/javascript"></script>
@endsection
