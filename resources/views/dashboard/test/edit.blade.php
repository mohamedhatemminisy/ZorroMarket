
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
                                <li class="breadcrumb-item"><a href="{{route('tests.index')}}"> {{trans('admin.tests')}} </a>
                                </li>
                                <li class="breadcrumb-item active"> {{trans('admin.edit')}} - {{$test -> name}}
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
                                    <h4 class="card-title" id="basic-layout-form"> {{trans('admin.edit')}} {{$test->name}} </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                    <form action="{{Route('tests.update',$test->id)}}"
                                     method="post" enctype="multipart/form-data">
                                     @method('put')
                                            @csrf

                                            <div class="card-body">
                                                <div class="tab-content">
                                                    @foreach (config('translatable.locales') as $key => $locale)
                                                        <div class="tab-pane fade show @if($key == 0) active @endif" id="{{$locale}}" role="tabpanel">
                                                            <div class="col form-group">
                                                                <label>@lang('admin.name') (@lang('admin.'.$locale))<span class="text-danger">*</span></label>
                                                                <input
                                                                    type="text"
                                                                    name="{{ $locale.'[name]' }}"
                                                                    id="{{ $locale . '[name]' }}"
                                                                    placeholder="@lang('admin.name')"
                                                                    class="form-control @error("$locale.name" ) is-invalid @enderror"
                                                                    value="{{old($locale.'.name',$test->translate($locale)->name )}}">
                                                                    @error("$locale.name" )
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                            </div>

                                                            <div class="col form-group">
                                                                <label>@lang('admin.description')(@lang('admin.'.$locale))<span
                                                                        class="text-danger">*</span></label>
                                                                <textarea class="form-control @error($locale . '.description') is-invalid @enderror "
                                                                    type="text" name="{{ $locale . '[description]' }}" rows="4"
                                                                    id="{{ $locale }}.editor1">{{old($locale.'.description',$test->translate($locale)->description )}}</textarea>
                                                            </div>
                                                                  @error("$locale.description" )
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
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

                                                            <div class="col form-group">
                                                                <label>@lang('admin.type')(@lang('admin.'.$locale))<span
                                                                        class="text-danger">*</span></label>
                                                                <textarea class="form-control @error($locale . '.type') is-invalid @enderror "
                                                                    type="text" name="{{ $locale . '[type]' }}" rows="4"
                                                                    id="{{ $locale }}.editor2">{{old($locale.'.type',$test->translate($locale)->type )}}</textarea>
                                                            </div>
                                                                   @error("$locale.type" )
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
                                                    @endforeach
                                                </div>


                                                <div class="row px-8">
                                                    <div class="col form-group">
                                                        <label>@lang('admin.price') <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" value="{{$test->price }}" name="price">
                                                        @error("price" )
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                           
                                                <div class="row px-8">
                                                    <div class="col form-group">
                                                        <label>@lang('admin.duration') <span class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" value="{{$test->duration }}" name="duration">
                                                        @error("duration" )
                                                            <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div> 

                                                
                                    <div class="col form-group">
 
                                        <label>@lang('admin.image') </label>
                                        <p><img style="width:200px;height:200px" src="{{asset($test->image)}}"></p>

                                        </div>
                                                <div class="col form-group">
                                                    <label>@lang('admin.image') <span class="text-danger">*</span></label>
                                                    <input type="file" name="image" 
                                                    placeholder="@lang('admin.image')" class="form-control">
                                                </div>

                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> {{trans('admin.reset')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{trans('admin.update')}}
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
