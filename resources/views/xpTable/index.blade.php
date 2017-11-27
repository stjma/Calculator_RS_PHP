@extends('layouts.app')

@section('content')
    <form action="/xpTb" method="post"
          class="form-inline" role="form">
        {{ csrf_field() }}

        <div class="form-group">
            <input type="text" class="form-control" name="Skillname">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
    </form>
    <table class="table">
        <thead>
        <tr class="header">
            <th>
                {{ __('Name')}}
            </th>

            <th></th>
        </tr>
        </thead>
    @foreach ($ListXpTable as $XpTable)
            <tbody>
            <tr>
                <td>{{ $XpTable->name }}</td>
                <td>{{ __('Detail')}}</td>
            </tr>
            </tbody>

    @endforeach
    </table>
@endsection
