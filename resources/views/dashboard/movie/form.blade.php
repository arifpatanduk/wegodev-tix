@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movies</h3>
                </div>

                {{-- tombol delete --}}
                <div class="col-4 text-right">
                    <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deletemodal">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- form edit --}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route('dashboard.movies.store') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" value="">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" name="description" value=""></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <div class="custom-file">
                                <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                                <input type="file" name="thumbnail" id="" class="custom-file-input">
                                @error('thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="button" class="btn btn-sm btn-secondary" onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal delete --}}
    <div class="modal fade" id="deletemodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin hapus user</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('dashboard.movies.delete') }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection