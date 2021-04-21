@extends('layouts.app')
@section('content')
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
<div class="card-body">
    <table class="table">
        <tr>
            <th>Vardas</th>
            <th>Dalyvautų rungtynių skaičius</th>
            <th>Laimėtų rungtynių skaičius</th>
            <th>Aprašymas</th>
            <th>Veiksmai</th>
        </tr>
        @foreach ($horses as $horse)
        <tr>
            <td>{{ $horse->name }}</td>
            <td>{{ $horse->runs }}</td>
            <td>{{ $horse->wins }}</td>
            <td>{!! $horse->about !!}</td>
            <td>
            <td>
                <form action={{ route('horse.destroy', $horse->id) }} method="POST">
                    <a class="btn btn-success" href={{ route('horse.edit', $horse->id) }}>Redaguoti</a>
                    @csrf @method('delete')
                    <input type="submit" class="btn btn-danger" value="Ištrinti"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('horse.create') }}" class="btn btn-success">Pridėti</a>
    </div>
</div>
@endsection