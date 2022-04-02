
@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{trans('admin.contact')}} </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('admin.home')</a>
                                </li>
                                <li class="breadcrumb-item active">{{trans('admin.contact')}}
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
                                    <h4 class="card-title"> {{trans('admin.contact')}} </h4>
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

                            
                                

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        
                                    
                                    <div class="col form-group">
 
                                        <label>@lang('admin.name') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $contact->user->name }}</p>
                                
                                    </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.email') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $contact->user->email }}</p>
                                
                                    </div>
                                       
                                    
                                    <div class="col form-group">

                                        <label>@lang('admin.phone') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $contact->user->phone }}</p>                                   
                                     </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.type') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $contact->type }}</p>
                                
                                    </div>

                                    <div class="col form-group">
 
                                        <label>@lang('admin.message') </label>
                                        <p class="alert alert-info" style="background-color:rgb(26,60,119)">{{ $contact->message  }}</p>
                                
                                    </div>
  


                                    <div class="col form-group">
 
                                        <label>@lang('admin.image') </label>
                                        <p><img src="{{asset($contact->image)}}"></p>
                                
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
