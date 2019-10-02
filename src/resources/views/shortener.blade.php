@extends('layouts.app')
@section('content')
    <div class="title m-b-md">
        Url Shortener
    </div>

    @error('url')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @isset($shortUrl)
        <div class="short-info">
            <table>
                <caption>Urls</caption>
                <tr>
                    <th>Source:</th>
                    <td><code>{{ $sourceUrl }}</code> <a href="{{ $sourceUrl }}">GO</a></td>
                </tr>
                <tr>
                    <th>Short:</th>
                    <td><code>{{ $shortUrl }}</code> <a href="{{ $shortUrl }}">GO</a></td>
                </tr>
                <tr>
                    <th>Stat:</th>
                    <td><code>{{ $statUrl }}</code> <a href="{{ $statUrl }}">GO</a></td>
                </tr>
            </table>
        </div>

        <div class="try-again">
            Want's more? Try again!
        </div>
    @endisset

    <div class="form">
        <form action="" method="POST">
            @csrf
            <label>Url: <input name="url" placeholder="https://devsmonkeys.com/" type="url" required/></label>
            <button type="submit">Short It!</button>
        </form>
    </div>


    <div class="links">
        {{--<a href="https://laravel.com/docs">Docs</a>--}}
        <a href="https://devsmonkeys.com/">DevsMonkeys Website</a>
        <a href="https://github.com/likemusic/dev-monkeys-team_shortener">GitHub</a>
    </div>
@endsection
