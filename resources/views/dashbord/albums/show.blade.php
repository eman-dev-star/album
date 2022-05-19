@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>albums</h1>


            <ol class="breadcrumb">


                <li><a href="{{route('albums.index')}}"><i class="fa fa-dashboard"></i>Albums</a></li>
                <li class="active"> <a href="{{route('albums.show',$album->id)}}">add new picture</a></li>
              </ol>
        </section>

        <section class="content">
          <!-- general form elements -->
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add new picture</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                @include('partials._error')
                <form action="{{route('albums.addimage')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('POST')
                  <input type="hidden" name="album_id" value="{{$album->id}}">
                <div class="form-group">
                    <label>picture name</label>
                    <input type="text" class="form-control" name="nameimage" value="{{old('nameimage')}}">
                  </div>
                  <div class="form-group">
                    <label>Picture</label>
                    <input type="file" name="image" class="form-control image">
                </div>

                <div class="form-group">
                    <img src="{{ asset('uploads/album.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                </div>
                 <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>add</button>
              </div>



        </form>
        </div><!--end of box-body-->
         </div><!--end of box-primary-->
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
