@extends('app')

@section('content')

    <div>
        <h1>Welcome {{ $rsn }}</h1>
        @if($player->interval > 0)
            We are tracking this user
        @endif

        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Skill</th>
                <th>Level</th>
                <th>Experience</th>
                <th>Rank</th>
                <th>Today</th>
                <th>Yesterday</th>
            </tr>
            </thead>
            <tbody>
            @foreach($skills as $skill)
                <tr>
                    <td>{{ $skill }}</td>
                    <td>{{ $currentTrack->{strtolower($skill) . "_level"} }}</td>
                    <td>{{ $currentTrack->{strtolower($skill) . "_xp"} }}</td>
                    <td>{{ $currentTrack->{strtolower($skill) . "_rank"} }}</td>
                    @if(!$yesterdayTrack)
                        <td>-</td>
                        <td>--</td>
                    @else
                    <td class="@if($currentTrack->{strtolower($skill) . "_xp"} - $yesterdayTrack->{strtolower($skill) . "_xp"} > 0) gained @endif">{{ $currentTrack->{strtolower($skill) . "_xp"} - $yesterdayTrack->{strtolower($skill) . "_xp"} }}</td>
                    <td class="@if($yesterdayTrack->{strtolower($skill) . "_xp"} - ($dayBeforeYesterdayTrack !== null ? $dayBeforeYesterdayTrack->{strtolower($skill) . "_xp"} : 0) > 0) gained @endif">{{ $yesterdayTrack->{strtolower($skill) . "_xp"} - ($dayBeforeYesterdayTrack !== null ? $dayBeforeYesterdayTrack->{strtolower($skill) . "_xp"} : 0) }}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection