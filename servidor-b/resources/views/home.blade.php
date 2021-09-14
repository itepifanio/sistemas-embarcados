@extends('layouts.app')

@section('content')
  <div class="home-container"> 
    <div class="d-flex flex-column align-items-center w-100 p-md-3 p-2">
        <h1>Restaurantes</h1>

        @foreach ($restaurants as $restaurant)
          <div class="card card-fixed-w d-flex flex-column justify-content-center my-3 p-3">
            <strong>RU {{ $restaurant->name }}</strong>
            <div class="d-flex flex-row justify-content-between mt-1">
              <span><i class="far fa-clock text-primary mr-1"></i> 06:30 - 07:45</span>          
              <span><i class="fas fa-circle text-success mr-1"></i> {{$restaurant->status}}</span>
            </div>
            <!-- <div class="d-flex mt-2 justify-content-center card-detail">
              <span>
                <i class="fas fa-users text-primary mr-1"></i>
                <strong>7 pessoas</strong> na fila
              </span>
            </div> -->
          </div>
        @endforeach
    </div>
  </div>
@endsection