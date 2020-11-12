@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h5 class="mr-auto">Create new task</h5>
    <hr>

    <div>

        <form method="post" action="{{ route('taskStore') }}">
            @csrf
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Title"
                        required
                        aria-describedby="title-validation">
                    @error('title')
                    <div id="title-validation" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="deadline" class="col-sm-2 col-form-label">Deadline</label>
                <div class="col-sm-10">
                    <input
                        type="datetime-local"
                        class="form-control @error('deadline') is-invalid @enderror"
                        id="deadline"
                        name="deadline"
                        value="{{ old('deadline') }}"
                        placeholder="Deadline"
                        required
                        aria-describedby="deadline-validation">
                    @error('deadline')
                    <div id="deadline-validation" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                     <textarea
                         required
                         class="form-control @error('description') is-invalid @enderror"
                         id="description"
                         rows="3"
                         name="description"
                         placeholder="Description"
                         required
                         aria-describedby="description-validation">{{ old('description') }}</textarea>
                    @error('description')
                    <div id="description-validation" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-outline-dark">Create</button>
                </div>
            </div>
        </form>
    </div>
@endsection
