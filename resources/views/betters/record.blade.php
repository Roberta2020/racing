@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Lažybininko statymo detalės</div>
    <div class="card-body">
        <h5>Vardas: {{ $better->name }}</h5>
        <h5>Pavardė: {{$better->surname}}</h5>
        <h5>Statoma suma eur: {{ $better->bet }}</h5>
        <hr>
        <h5>Arklio vardas:  {{ $better->horse->name }}</h5>
        <h5>Dalyvautų varžybų skaičius:  {{ $better->horse->run }}</h5>
        <h5>Laimėtų varžybų skaičius:  {{ $better->horse->win }}</h5>
        <h5>Aprašymas:  {{ $better->horse->about }}</h5>
    </div>
</div>
@endsection