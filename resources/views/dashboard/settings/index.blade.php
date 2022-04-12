@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"> {{trans('admin.home')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('settings')}}"> {{trans('admin.settings')}}
                                </a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.edit')}} - {{$setting -> name}} </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="container">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    @foreach (config('translatable.locales') as $key => $locale)
                                    <li class="nav-item">
                                        <a class="nav-link  @if($key == 0) active @endif" data-toggle="tab" href="{{"#" . $locale}}">@lang('admin.'.$locale)</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{route('settings.update')}}" method="POST" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <div class="card-body">
                                            <div class="tab-content">

                                                @foreach (config('translatable.locales') as $key => $locale)

                                                <div class="tab-pane fade show @if($key == 0) active @endif" id="{{$locale}}" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label>@lang('admin.website_title') (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                        <input type="text" name="{{ $locale.'[website_title]' }}" id="{{ $locale . '[website_title]' }}" value="{{old($locale.'.website_title',$setting->translate($locale)->website_title )}}" placeholder="@lang('admin.website_title')" class="form-control @error(" $locale.website_title" ) is-invalid @enderror" value="{{ old($locale.'.website_title') }}">
                                                        @error("$locale.website_title" )
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('admin.meta_title') (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                        <input type="text" name="{{ $locale.'[meta_title]' }}" id="{{ $locale . '[meta_title]' }}" value="{{old($locale.'.meta_title',$setting->translate($locale)->meta_title )}}" placeholder="@lang('admin.meta_title')" class="form-control @error(" $locale.meta_title" ) is-invalid @enderror" value="{{ old($locale.'.meta_title') }}">
                                                        @error("$locale.meta_title" )
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('admin.address') (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                        <input type="text" name="{{ $locale.'[address]' }}" id="{{ $locale . '[address]' }}" value="{{old($locale.'.address',$setting->translate($locale)->address )}}" placeholder="@lang('admin.address')" class="form-control @error(" $locale.address" ) is-invalid @enderror" value="{{ old($locale.'.address') }}">
                                                        @error("$locale.address" )
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col form-group">
                                                                <label>@lang('admin.meta_keywords')(@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                                <textarea class="form-control @error($locale . '.meta_keywords') is-invalid @enderror " type="text" name="{{ $locale . '[meta_keywords]' }}" rows="4" id="{{ $locale }}.editor1">{{old($locale.'.meta_keywords',$setting->translate($locale)->meta_keywords )}}</textarea>
                                                                @error("$locale.meta_keywords" )
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <script>
                                                                CKEDITOR.replace('{{ $locale }}.editor1', {
                                                                    extraPlugins: 'bidi',
                                                                    // Setting default language direction to right-to-left.
                                                                    contentsLangDirection: 'ltr',
                                                                    height: 270,
                                                                    scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                                                    scayt_sLang: 'auto',
                                                                    removeButtons: 'PasteFromWord'
                                                                });
                                                            </script>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="col form-group">
                                                                <label>@lang('admin.meta_description')(@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                                <textarea class="form-control @error($locale . '.meta_description') is-invalid @enderror " type="text" name="{{ $locale . '[meta_description]' }}" rows="4" id="{{ $locale }}.editor2">{{old($locale.'.meta_description',$setting->translate($locale)->meta_description )}}</textarea>
                                                                @error("$locale.meta_description" )
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                                <script>
                                                                    CKEDITOR.replace('{{ $locale }}.editor2', {
                                                                        extraPlugins: 'bidi',
                                                                        // Setting default language direction to right-to-left.
                                                                        contentsLangDirection: 'ltr',
                                                                        height: 270,
                                                                        scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
                                                                        scayt_sLang: 'auto',
                                                                        removeButtons: 'PasteFromWord'
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach

                                                <div class="row">


                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="facebook">{{trans('admin.facebook')}}
                                                            </label>
                                                            <input type="text" id="facebook" class="form-control" placeholder="{{trans('admin.facebook')}}" value="{{old('facebook', $setting->facebook)}}" name="facebook">
                                                            @error("facebook")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="twitter">{{trans('admin.twitter')}}
                                                            </label>
                                                            <input type="text" id="twitter" class="form-control" placeholder="{{trans('admin.twitter')}}" value="{{old('twitter', $setting->twitter)}}" name="twitter">
                                                            @error("twitter")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="instagram">{{trans('admin.instagram')}}
                                                            </label>
                                                            <input type="text" id="instagram" class="form-control" placeholder="{{trans('admin.instagram')}}" value="{{old('instagram', $setting->instagram)}}" name="instagram">
                                                            @error("instagram")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="email">{{trans('admin.email')}}
                                                            </label>
                                                            <input type="text" id="email" class="form-control" placeholder=" {{trans('admin.email')}}" value="{{old('email', $setting->email)}}" name="email">
                                                            @error("email")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="phone">{{trans('admin.phone')}}
                                                            </label>
                                                            <input type="text" id="phone" class="form-control" placeholder=" {{trans('admin.phone')}}" value="{{old('phone', $setting->phone)}}" name="phone">
                                                            @error("phone")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="whatsapp">{{trans('admin.whatsapp')}}
                                                            </label>
                                                            <input type="text" id="whatsapp" class="form-control" placeholder=" {{trans('admin.whatsapp')}}" value="{{old('whatsapp', $setting->whatsapp)}}" name="whatsapp">
                                                            @error("whatsapp")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <div class="col form-group">
                                                                <label>@lang('admin.logo') </label>
                                                                <p><img style="width:200px;height:200px" src="{{asset($setting->logo)}}"></p>
                                                            </div>
                                                            <label>@lang('admin.logo') <span class="text-danger">*</span></label>
                                                            <input type="file" name="logo" placeholder="@lang('admin.logo')" class="form-control" multiple>
                                                            @error("logo")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> {{trans('admin.reseat')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{trans('admin.create')}}
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@stop