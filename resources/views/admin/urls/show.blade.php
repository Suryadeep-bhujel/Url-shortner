@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col text-right ">
                <a href="{{ route('urls.index') }}" class="btn btn-primary">All Urls </a>
            </div>
        </div>
        @include('admin.notification')
        <div class="row">
            <div class="col">
                <h4>Title : <strong>{{ $url->title }}</strong></h4>
                <h4>url : <strong>
                        <a href="{{ $url->original_url }}" target="_blank">{{ $url->original_url }}</a>
                    </strong>
                </h4>
                <h4>Short URL : <strong>
                        <a href="{{ route('urlshortner', $url->url_code) }}" target="_blank">
                            {{ route('urlshortner', $url->url_code) }}
                        </a>
                    </strong>
                </h4>
                <h3>
                    Total Clicks :
                    <strong>
                        {{ $url->total_clicks }}
                    </strong>
                </h3>
            </div>
        </div>
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>IP Address </th>
                    <th>Referred Url </th>
                    <th>Params</th>
                    <th> Date</th>


                </tr>
            </thead>
            <tbody>
                @if (isset($history) && $history->count())
                    @foreach ($history as $key => $historyItem)

                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $historyItem->ip }}</td>


                            <td>

                                {{ $historyItem->referral_url }}
                            </td>
                            <td>

                                @php
                                    $params = json_decode($historyItem->params);
                                    // dd($params);
                                @endphp
                                @if (isset($params) && $params != null)
                                    @foreach ($params as $key => $parameter)
                                        {{-- @dd($key) --}}
                                        <strong>{{ $key }} : </strong> {{ $parameter }}
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                {{ $historyItem->created_at->format('F d, Y h:i:s A ') }}
                            </td>
                        </tr>
                    @endforeach

                @endif
            </tbody>
        </table>
    </div>
@endsection
