@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('admin.products')}} </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('admin.home')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{trans('admin.products')}}
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
                                <h4 class="card-title"> {{trans('admin.products')}} </h4>
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
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach (config('translatable.locales') as $key => $locale)
                                    <div class="tab-pane fade show @if($key == 0) active @endif" id="{{$locale}}" role="tabpanel">
                                        <div class="col form-group">
                                            <label>@lang('admin.name')
                                                (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                            <p class="alert alert-info" style="background-color:rgb(26,60,119)">
                                                {{ $product->translate($locale)->name }}
                                            </p>
                                        </div>
                                        <div class="col form-group">
                                            <label>@lang('admin.description')
                                                (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                            <p>
                                                {!! $product->translate($locale)->description !!}
                                            </p>
                                        </div>
                                        <div class="col form-group">
                                            <label>@lang('admin.summary')
                                                (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                            <p>
                                                {!! $product->translate($locale)->summary !!}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col form-group">
                                        <label>@lang('admin.slug') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->slug  }}</p>
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.sku') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->sku  }}</p>
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.price') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->price  }}</p>
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.quantity') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->quantity  }}</p>
                                    </div>
                                    @if($product->special_price)
                                    <div class="col form-group">
                                        <label>@lang('admin.special_price') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->special_price  }}</p>
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.start_date') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->start_date  }}</p>
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.end_date') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->end_date  }}</p>
                                    </div>
                                    @endif
                                    <div class="col form-group">
                                        <label>@lang('admin.brands') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->brand->name  }}</p>
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.added_by') </label>
                                        <p>
                                    {{$product->user->getRoleNames()}} <a href="{{route('users.show',$product->user->id)}}"> {{ $product->user->name}}</a></p>
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.status') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $product->getActive()  }}</p>
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.categories') </label>
                                        @foreach($product->categories as $category)
                                        <p>{{$category->name}}</p>
                                        @endforeach
                                    </div>
                                    <div class="col form-group">
                                        <label>@lang('admin.main_image') </label>
                                        <p><img style="width:200px;height:200px" src="{{asset($product->main_image)}}"></p>
                                    </div>
                                    @if($product->image)
                                    <div class="col form-group">
                                        <label>@lang('admin.images') </label>
                                        <p>
                                            @foreach($product->image as $image)
                                            <img style="width:200px;height:200px" src="{{asset($image->image)}}">
                                            @endforeach
                                        </p>
                                    </div>
                                    @endif
                                    @if($product->video)
                                    <div class="col form-group">
                                        <label>@lang('admin.video') </label>
                                        <p><video width="320" height="240" controls>
                                                <source src="{{asset($product->video)}}" type="video/mp4">
                                                <source src="{{asset($product->video)}}" type="video/ogg">
                                            </video>
                                        </p>
                                    </div>
                                    @endif
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