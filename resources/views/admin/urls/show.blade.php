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
                <th>IP Address </th>
                <th>Referred Url </th>
                {{-- <th></th> --}}
                
            
            </tr>
        </thead>
        <tbody>
            @if(isset($history) && $history->count())
            @foreach ($history as $key =>   $historyItem)
                
            <tr>
                <td>{{ $key +1 }}</td>
                <td>{{ $historyItem->ip }}</td>
                {{-- <td>
                    <a href="{{ $url_item->original_url }}"  target="_blank" style="word-break: break-all">
                        {{ $url_item->original_url }}
                    </a>
                </td> --}}
                
                <td>
                    {{-- <a href="{{ route("urls.show", $url_item->url_code) }}"  target="_blank"  class="badge badge-info" >
                    </a> --}}
                    {{ $historyItem->referral_url }}
                </td>
                 
                
                {{-- <td>
                    <div class="btn-group">
                        <a href="{{ route('urls.edit', $url_item->url_code) }}" class="btn btn-info  btn-sm">
                        Edit
                        </a>
                        <Form method="post" action="{{ route('urls.destroy', $url_item->url_code) }}">
                            @method("DELETE")
                            <button onclick="return confirm('Are you sure you want to remove this url ? ')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </Form>

                    </div>
                </td> --}}
            </tr>
            @endforeach
                
            @endif
        </tbody>
    </table>
</div>
@endsection
