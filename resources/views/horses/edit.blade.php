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
                        <div class="card-header">Pakeiskime arklio informaciją</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('horse.update', $horse->id) }}">
                                @csrf @method("PUT")
                                <div class="form-group">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="">Pavadinimas</label>
                                    <input type="text" name="name" class="form-control" value="{{ $horse->name }}">
                                </div>
                                <div class="form-group">
                                    @error('runs')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="">Dalyvautų rungtynių skaičius</label>
                                    <input type="number" name="runs" class="form-control" value="{{ $horse->runs }}">
                                </div>
                                <div class="form-group">
                                    @error('wins')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="">Laimėtų rungtynių skaičius</label>
                                    <input type="number" name="wins" class="form-control" value="{{ $horse->wins }}">
                                </div>
                                <div class="form-group">
                                    @error('about')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <label for="">Aprašymas</label>
                                    <textarea id="mce" type="text" name="about" rows=10 cols=100
                                        class="form-control">{{ $horse->about }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Pakeisti</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endsection
