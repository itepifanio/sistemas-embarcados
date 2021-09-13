@extends('layouts.app')

@section('content')
    <div class="row mt-4 px-4">
        <div class="col-md-6 col-sm-12 mt-4">
            <div class="text-bold text-center">Ultimas informações recebidas dos sensores</div>
            <x-charts.queue-level/>
        </div>
        <div class="col-md-6 col-sm-12 mt-4">
            <x-cards.students-number/>
            <div class="mt-4">
                <x-cards.queue-time/>
            </div>
            <div class="mt-4">
                <x-cards.queue-status/>
            </div>
        </div>
    </div>
@endsection
