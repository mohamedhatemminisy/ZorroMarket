@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{trans('admin.home')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">

                                    {{trans('admin.countries')}} </a>
                            </li>
                            <li class="breadcrumb-item active">{{trans('admin.create_country')}}
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
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.create_country')}} </h4>
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
                                    <form class="form" action="{{route('countries.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="tab-content">
                                                @foreach (config('translatable.locales') as $key => $locale)
                                                <div class="tab-pane fade show @if($key == 0) active @endif" id="{{$locale}}" role="tabpanel">
                                                    <div class="mb-3">
                                                        <label>@lang('admin.name') (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                        <input type="text" name="{{ $locale.'[name]' }}" id="{{ $locale . '[name]' }}" placeholder="@lang('admin.name')" class="form-control @error(" $locale.name" ) is-invalid @enderror" value="{{ old($locale.'.name') }}">
                                                        @error("$locale.name" )
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="mb-3">
                                                    <label>@lang('admin.image') <span class="text-danger">*</span></label>
                                                    <input type="file" name="image" placeholder="@lang('admin.image')" class="form-control">
                                                    @error("image" )
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="switcheryColor4" class="card-title ml-1">{{trans('admin.status')}} </label>
                                                    <input type="checkbox" value="1" name="is_active" id="switcheryColor4" class="switchery" data-color="success" checked />

                                                    @error("is_active")
                                                    <span class="text-danger">{{$message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> {{trans('admin.reset')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{trans('admin.save')}}
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