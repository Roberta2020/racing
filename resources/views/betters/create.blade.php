@extends('layouts.app')
@section('content')
    {{-- Validation error --}}
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color: red">{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {{-- Database error --}}
    @if (session('status_success'))
        <p style="color: green"><b>{{ session('status_success') }}</b></p>
    @else
        <p style="color: red"><b>{{ session('status_error') }}</b></p>
    @endif
    @if (auth()->check())
        @if (session('status_success'))
            <div class="alert alert-success" role="alert">{{ session('status_success') }}</div>
        @endif
        @if (session('status_error'))
            <div class="alert alert-danger" role="alert">{{ session('status_error') }}</div>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Pridėkite lažybininką:</div>
                        <div class="card-body">
                            <form action="{{ route('betters.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="">Vardas: </label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    @error('surname')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="">Pavardė: </label>
                                    <input type="text" name="surname" class="form-control">
                                </div>
                                <div class="form-group">
                                    @error('bet')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="">Statoma suma eur: </label>
                                    <input type="number" name="bet" class="form-control">
                                </div>
                                <div class="form-group">
                                    @error('horse_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Arklys: </label>
                                    <select name="horse_id" id="" class="form-control">
                                        <option value="" selected disabled>Pasirinkite arklį</option>
                                        @foreach ($horses as $horse)
                                            <option value="{{ $horse->id }}">{{ $horse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Pridėti</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
