@extends('posts.app')
@section('content')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Tables</a></li>
        <li class="breadcrumb-item active" aria-current="page"></li>
    </ol>
</nav>
<div class="hk-pg-header">
    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg></span></span>Basic Tables</h4>
</div>

<div class="container">
    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg></span></span>Basic Tables</h4>
    </div>
    <!-- /Title -->


        <!-- Main Content -->
        <div class="row" style="margin-left: 222px;">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="hk-sec-title">Create Post</h5>
                    <p class="mb-40">share  your thoughts with your own comunity.</p>
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                        </div>
                                        <input name="title" type="text" class="form-control" placeholder="post title" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                    @error('title')
                                    <div class="alert alert-warning" role="alert">
                                    {{$message}}
                                      </div>
                                    @enderror  
                                </div>
                                <div class="form-group">
                                   
                               

                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Post Content </span>
                                        </div>
                                        <textarea name="content" class="form-control" aria-label="With textarea"></textarea>
                                    </div>
                                    @error('content')
                                    <div class="alert alert-warning" role="alert">
                                    {{$message}}
                                      </div>
                                    @enderror  
                                </div>
                                </div>
                                <button type="submit" class="btn btn-info">create</button>                            </form>
                        </div>
                    </div>
                </section>
             
            </div>
        </div>
        @endsection