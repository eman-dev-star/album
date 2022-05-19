@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>albums</h1>


            <ol class="breadcrumb">


                <li><a href="{{route('albums.index')}}"><i class="fa fa-dashboard"></i>Albums</a></li>
                <li class="active">edit</li>
              </ol>
        </section>

        <section class="content">
          <!-- general form elements -->
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">edit</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                @include('partials._error')
                <form action="{{route('albums.image',$picture->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="id" value="{{$picture->id}}">
                <div class="form-group">
                  <label>album name</label>
                  <select name="album_id" class="form-control">
                 @foreach ($albums as $album)
                 <option value="{{$album->id}}" {{
                 $picture->album_id == $album->id ? 'selected' : '' }}
                    >{{$album->name}}</option>
                 @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label>picture name</label>
                    <input type="text" class="form-control" name="name" value="{{$picture->name}}">
                  </div>
                  <div class="form-group">
                    <label>Picture</label>
                    <input type="file" name="picture" class="form-control image">
                </div>

                <div class="form-group">
                    <img  src="{{ asset('uploads/albums/'.$picture->album->name.'/'.$picture->picture) }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                </div>
                 <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>edit</button>
              </div>



        </form>
        </div><!--end of box-body-->
         </div><!--end of box-primary-->
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
