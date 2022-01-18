@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col text-right ">
            <a href="{{ route('urls.create') }}" class="btn btn-primary">Add New </a>
        </div>
    </div>
    @include('admin.notification')
    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Original Url</th>
                <th>Short Url</th>
                <th>Params</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($urls) && $urls->count())
            @foreach ($urls as $key =>   $url_item)
                
            @endforeach
            <tr>
                <td>{{ $key +1 }}</td>
                <td>{{ $url_item->title }}</td>
                <td>
                    <a href="{{ $url_item->original_url }}"  target="_blank" style="word-break: break-all">
                        {{ $url_item->original_url }}
                    </a>
                </td>
                <td>
                    <a href="{{ route("urlshortner", $url_item->url_code) }}"  target="_blank" >
                        {{ route("urlshortner", $url_item->url_code) }}
                    </a>
                </td>
                <td>
                    <span class="" style="word-break: break-all">
                        {{ $url_item->params }}
                    </span>
                </td>
                <td>
                    <span class="badge badge-{{ $url_item->status ? 'success' : 'info' }}">
                        {{ $url_item->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('urls.edit', $url_item->url_code) }}" class="btn btn-info  btn-sm">
                        Edit
                        </a>
                        <Form method="post" action="{{ route('urls.destroy', $url_item->url_code) }}">
                            @method("DELETE")
                            <button onclick="return confirm('Are you sure you want to remove this url ? ')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </Form>

                    </div>
                </td>
            </tr>
                
            @endif
        </tbody>
    </table>
</div>
@endsection
