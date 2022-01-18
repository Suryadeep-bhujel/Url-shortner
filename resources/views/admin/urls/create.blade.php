@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col text-right ">
                <a href="{{ route('urls.index') }}" class="btn btn-primary">List </a>
            </div>
        </div>
        <Form action="{{ $route }}" method="POST">
            @method($method)
            @csrf
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h4><strong> {{ $title }}</strong></h4>
                    <hr>
                    <div class="row form-group">
                        <label for="title" class="col-lg-12"><strong>Title Of Url</strong></label>
                        <div class="col-lg-12">
                            <input value="{{ old('title') ?? (@$urlInfo->title ?? null) }}" type="text"
                                class="form-control form-control-sm" name="title" id="title">

                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="original_url" class="col-lg-12">
                            <strong>Orinigal URL </strong> <small class="badge text-info">Full URL where the page should be
                                redirected</small>
                        </label>
                        <div class="col-lg-12">
                            <input value="{{ old('original_url') ?? (@$urlInfo->original_url ?? null) }}" type="text"
                                class="form-control form-control-sm" name="original_url" id="original_url"
                                placeholder="Full URL">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="length" class="col-lg-12"><strong>Short URL Length</strong></label>
                        <div class="col-lg-12">
                            <input type="number" class="form-control form-control-sm" name="length" id="length"
                                value="{{ old('length') ?? (@$urlInfo->length ?? 6) }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="status" class="col-lg-12"><strong>URL status</strong></label>
                        <div class="col-lg-12">
                            @php
                                $status = 1;
                             
                                    $status = @$urlInfo->status;
                              
                                // dd($urlInfo);
                                if (old('status')) {
                                    $status = old('status');
                                }
                                // dd($status);
                            @endphp
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option disabled>--Select Anyone--</option>
                                <option value="1" {{$status == 1 ? "selected" :  '' }}>Active</option>
                                <option value="0" {{ $status == 0 ? "selected" :  '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col text-right">
                            <button class="btn btn-success" type="submit">Save</button>
                            {{-- <button class="btn btn-success" type="submit">Save</button> --}}
                        </div>
                    </div>
                </div>

            </div>
        </Form>
    </div>
@endsection
