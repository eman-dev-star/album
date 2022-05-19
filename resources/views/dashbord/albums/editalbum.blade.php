@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>albums</h1>


            <ol class="breadcrumb">


                <li><a href="{{route('albums.index')}}"><i class="fa fa-dashboard"></i>Albums</a></li>
                <li class="active">add</li>
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
                <form action="{{route('albums.update',$album->id)}}" method="post">
                  @csrf
                  @method('PUT')
                <div class="form-group">
                  <label>album name</label>
                  <input type="text" class="form-control" name="name" value="{{$album->name}}">
                </div>

                 <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>edit</button>
              </div>



        </form>
        </div><!--end of box-body-->
         </div><!--end of box-primary-->
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
