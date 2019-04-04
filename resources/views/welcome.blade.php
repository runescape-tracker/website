@extends('app')

@section('content')


    <div class="full-page-container align-items-center justify-content-center flex-column">
        <div>

            <h1 class="mb-5">Runescape Tracker</h1>

            <form action="/track" method="POST" class="mb-3" style="width: 400px;">
                @csrf
                <div class="input-group w-100 mb-3">
                    <input type="text" name="rsn" class="form-control form-control-lg @if($errors->get('rsn')) is-invalid @endif" placeholder="Your RSN">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="track">Start Tracking</button>
                    </div>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>

                </div>
                <div>
                    <div class="input-group">
                        <label class="mr-4">
                            <input type="radio" name="game" value="rs3" @if(old('game') !== 'os') checked @endif> RS3
                        </label>
                        <label>
                            <input type="radio" name="game" value="os" @if(old('game') === 'os') checked @endif> Old School
                        </label>
                    </div>
                </div>

            </form>
        </div>
        <div class="links">
            <a href="https://github.com/runescape-tracker">GitHub</a>
        </div>
    </div>

@endsection