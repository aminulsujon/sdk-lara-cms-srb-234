@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="main-card mb-3 card">
            @include('admin/card_head', [
                'title' => 'Edit Landing Content',
                'info' => 'Modify the landing content entry.',
                
            ])

            <div class="card-body">
                <form action="{{ route('landecial.update', $content->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- Contents --}}
                    <div class="form-group">
                        <label for="contents">Landing link: <a target="_blank" href="/{{ $content->landing_slug }}">{{ $content->landing_slug }}</a></label>
                    </div>

                    {{-- Contents --}}
                    <div class="form-group">
                        <label for="contents">Contents</label>
                        <textarea name="contents" id="contents" rows="6" class="form-control ckeditor" required>{{ old('contents', $content->contents) }}</textarea>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $content->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $content->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
