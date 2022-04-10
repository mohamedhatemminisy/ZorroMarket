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
                            <li class="breadcrumb-item"><a href="{{route('products.index')}}"> {{trans('admin.products')}}
                                </a>
                            </li>
                            <li class="breadcrumb-item"> {{trans('admin.create_product')}}
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
                                <h4 class="card-title" id="basic-layout-form"> {{trans('admin.create_product')}} </h4>
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
                                    <form class="form" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
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
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="col form-group">
                                                                <label>@lang('admin.description')(@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                                <textarea class="form-control @error($locale . '.description') is-invalid @enderror " type="text" name="{{ $locale . '[description]' }}" rows="4" id="{{ $locale }}.editor1">{{ old($locale . '.description') }}</textarea>
                                                                @error("$locale.description" )
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
                                                        <div class="col-md-6">
                                                            <div class="col form-group">
                                                                <label>@lang('admin.summary')(@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                                <textarea class="form-control @error($locale . '.summary') is-invalid @enderror " type="text" name="{{ $locale . '[summary]' }}" rows="4" id="{{ $locale }}.editor2">{{ old($locale . '.summary') }}</textarea>
                                                                @error("$locale.summary" )
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
                                                        <div class="form-group">
                                                            <label for="categories"> @lang('admin.select_category')
                                                            </label>
                                                            <select name="categories[]" id="categories" class="select2 form-control" multiple>
                                                                <optgroup label="  @lang('admin.select_category') ">
                                                                    @if($categories && $categories -> count() > 0)
                                                                    @foreach($categories as $category)
                                                                    <option value="{{$category -> id }}"
                                                                    {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>{{$category -> name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('categories')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="brand_id"> @lang('admin.select_brand')
                                                            </label>
                                                            <select name="brand_id" class="select2 form-control">
                                                                <option disabled selected> @lang('admin.select_brand')</option>
                                                                @if($brands && $brands -> count() > 0)
                                                                @foreach($brands as $brand)
                                                                <option value="{{$brand -> id }}" {{ (old("brand_id") == $brand->id ? "selected":"") }}>{{$brand -> name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            @error('brand_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->hasRole('admin'))
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="brand_id"> @lang('admin.select_vendor')
                                                            </label>
                                                            <select name="added_by" class="select2 form-control">
                                                                <option disabled selected> @lang('admin.select_vendor')</option>
                                                                @if($vendors && $vendors -> count() > 0)
                                                                @foreach($vendors as $vendor)
                                                                <option value="{{$vendor -> id }}">{{$vendor -> name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            @error('vendors')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="slug">{{trans('admin.slug')}}
                                                            </label>
                                                            <input type="text" id="slug" class="form-control" placeholder="{{trans('admin.slug')}}" value="{{old('slug')}}" name="slug">
                                                            @error("slug")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="quantity">{{trans('admin.quantity')}}
                                                            </label>
                                                            <input type="text" id="quantity" class="form-control" placeholder="{{trans('admin.quantity')}}" value="{{old('quantity')}}" name="quantity">
                                                            @error("quantity")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="sku">{{trans('admin.sku')}}
                                                            </label>
                                                            <input type="text" id="sku" class="form-control" placeholder="{{trans('admin.sku')}}" value="{{old('sku')}}" name="sku">
                                                            @error("sku")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="price">{{trans('admin.price')}}
                                                            </label>
                                                            <input type="text" id="price" class="form-control" placeholder=" {{trans('admin.price')}}" value="{{old('price')}}" name="price">
                                                            @error("price")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="special_price">{{trans('admin.special_price')}}
                                                            </label>
                                                            <input type="text" id="special_price" class="form-control" placeholder=" {{trans('admin.special_price')}}" value="{{old('special_price')}}" name="special_price">
                                                            @error("special_price")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="start_date">{{trans('admin.start_date')}}
                                                            </label>
                                                            <input type="date" id="start_date" class="form-control" placeholder=" {{trans('admin.start_date')}}" value="{{old('start_date')}}" name="start_date">
                                                            @error("start_date")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="end_date">{{trans('admin.end_date')}}
                                                            </label>
                                                            <input type="date" id="end_date" class="form-control" placeholder=" {{trans('admin.end_date')}}" value="{{old('end_date')}}" name="end_date">
                                                            @error("end_date")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label>@lang('admin.main_image') <span class="text-danger">*</span></label>
                                                            <input type="file" name="main_image" placeholder="@lang('admin.main_image')" class="form-control">
                                                            @error("main_image" )
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label>@lang('admin.video') <span class="text-danger">*</span></label>
                                                            <input type="file" name="video" placeholder="@lang('admin.video')" class="form-control">
                                                            @error("video" )
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label>@lang('admin.images') <span class="text-danger">*</span></label>
                                                            <input type="file" name="images[]" placeholder="@lang('admin.images')" class="form-control" multiple>
                                                            @error("images")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="is_active" class="card-title ml-1">{{trans('admin.status')}} </label>
                                                            <input type="checkbox" value="1" name="is_active" id="is_active" class="switchery" data-color="success" checked />
                                                            @error("is_active")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="featured" class="card-title ml-1">{{trans('admin.featured')}} </label>
                                                            <input type="checkbox" value="1" name="featured" id="featured" class="switchery" data-color="success" />
                                                            @error("featured")
                                                            <span class="text-danger">{{$message }}</span>
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