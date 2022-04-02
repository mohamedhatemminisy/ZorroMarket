@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('admin.categories')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('admin.home')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{trans('admin.categories')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{trans('admin.categories')}} </h4>
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

                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (config('translatable.locales') as $key => $locale)
                                    <div class="tab-pane fade show @if($key == 0) active @endif" id="{{$locale}}" role="tabpanel">
                                        <div class="col form-group">
                                            <label>@lang('admin.name')
                                                (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                            <p class="alert alert-info" style="background-color:rgb(26,60,119)">
                                                {{ $category->translate($locale)->name }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col form-group">
                                        <label>@lang('admin.slug') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $category->slug  }}</p>
                                    </div>
                                    @if($category -> _parent)
                                    <div class="col form-group">
                                        <label>@lang('admin.main_category') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{$category -> _parent -> name }}</p>
                                    </div>
                                    @endif
                                    <div class="col form-group">
                                        <label>@lang('admin.status') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $category->getActive()  }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
</div>

@stop