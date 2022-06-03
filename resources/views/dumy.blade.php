@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa quas obcaecati enim placeat amet doloribus, repellat sapiente quidem cupiditate? Quae molestiae doloremque veniam accusantium mollitia? Dignissimos cupiditate in veniam eius.


<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"><b>Judul</b></th>
                {{-- <th scope="col"><b>Slug</b></th>
                <th scope="col"><b>Deskripsi</b></th> --}}
                <th scope="col"><b>Image</b></th>
                <th scope="col"><b>Actions</b></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($skill as $skills)
                <tr>
                    <td>{{ $skills->judul }}</td>
                    {{-- <td>{{ $skills->slug }}</td>
                    <td>{{ Str::limit($skills->deskripsi, 100) }}</td> --}}
                    <td>
                        @if ($skills->image)
                            <img src="{{ asset('storage/' . $skills->image) }}" width="48px" />
                        @else
                            No image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('skill.edit', [$skills->id]) }}"
                            class="btn btn-info btn-sm"><span class="oi oi-pencil"></span></a>
                        <a href="{{ route('skill.show', [$skills->id]) }}"
                            class="btn btn-primary btn-sm"> <span class="oi oi-eye"></span></a>
                        <form class="d-inline"
                            action="{{ route('skill.destroy', [$skills->id]) }}" method="POST"
                            onsubmit="return confirm('Move Skill {{ $skills->judul }} to trash?')">

                            @csrf

                            <input type="hidden" value="DELETE" name="_method">
                            <button type="submit" class="btn- btn-danger btn-sm"><span
                                    class="oi oi-trash"></span></button>
                            {{-- <input type="submit" class="btn btn-danger btn-sm" value="Trash"> --}}

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colSpan="10">
                    <div class="d-flex justify-content-start">
                        {!! $skill->appends(Request::all())->links() !!}
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
