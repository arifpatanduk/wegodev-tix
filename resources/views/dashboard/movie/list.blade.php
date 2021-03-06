@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Movie</a>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movies</h3>
                </div>

                {{-- form search --}}
                <div class="col-4">
                    <form action="{{ url('dashboard/movies') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        {{-- table movie --}}
        <div class="card-body p-0">
            
            {{-- method total() berasal pagination --}}
            @if ($movies->total())

            <table class="table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr>
                        <th scope="row">{{ ($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration }}</th>
                        <td>{{ $movie->title }}</td>
                        {{-- <td>{{ $movie->thumbnail }}</td> --}}
                        <td><img src="{{ asset('storage/movies/'.$movie->thumbnail) }}" alt=""></td>
                        <td>
                            <a href="{{ route('dashboard.movies.edit', ['id' => $movie->id]) }}" title="edit" class="btn btn-success btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{-- link pagination --}}
            {{ $movies->appends($request)->links('pagination::bootstrap-4') }}
            
            @else    
            <h4 class="text-center p-3">Data Movie belum ada</h4>
            @endif

        </div>
    </div>

@endsection