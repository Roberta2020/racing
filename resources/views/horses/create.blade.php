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
                        <div class="card-header">Pridėkite arklį:</div>
                        <div class="card-body">
                            <form action="{{ route('horse.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Vardas: </label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    @error('runs')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Dalyvautų rungtynių skaičius: </label>
                                    <input type="number" name="runs" class="form-control">
                                </div>
                                <div class="form-group">
                                    @error('wins')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Laimėtų rungtynių skaičius: </label>
                                    <input type="number" name="wins" class="form-control">
                                </div>
                                <div class="form-group">
                                    @error('about')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label>Aprašymas: </label>
                                    <textarea id="mce" name="about" rows=10 cols=100 class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
