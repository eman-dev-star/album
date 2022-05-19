@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>albums</h1>

            <ol class="breadcrumb">
                <li class="{{route('albums.index')}}">albums</li>

            </ol>
        </section>


        <section class="content">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              {{-- <h3 class="box-title" style="margin-bottom: 15px">cities<small>{{$cities->total()}}</small></h3> --}}

                <div class="row">
                      <div class="col-md-4">

                         <a href="{{route('albums.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hcity_idden="true"></i>add</a>

                    </div>
                </div>

            </div>
            <!-- /.box-header -->
             <div class="box-body">

                 <table class="table table-hover">
                  <thead>
                <tr>
                  <th style="wcity_idth: 10px">#</th>
                 <th>album name</th>
                 <th>action</th>


                </tr>
                  </thead>
              <tbody>
                <?php
                $count=0;
               ?>
                @foreach($albums as $album)
                <tr>
                  <td>{{$count++;}}</td>
                  <td>{{$album->name}}</td>

                  </td>
                  <td>

                       <a href="{{route('albums.show',$album->id)}}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus" aria-hidden="true"></i> add new picture</a>
                        <a href="{{route('albums.editalbum',['id'=>$album->id])}}" class="btn btn-success btn-sm">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            edit</a>
                        <a href="{{route('albums.allimage',['id'=>$album->id])}}" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>
                                all image</a>


                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <div class="btn-group" role="group">
                                      <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-trash"></i> delete
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <form action="{{route('albums.destroy',$album->id)}}" method="post"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete btn-lg align-center" style="">
                                             delete all the pictures</button>
                                        </form>
                                        <hr>
                                        <form action="{{route('albums.anotheralbum',['id'=>$album->id])}}" method="post"
                                            style="display: inline-block">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger delete btn-lg align-center" style="">
                                                move to another album</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>

                  </td>

                </tr>
                @endforeach

            </tbody>

              </table>

              </div>


          </div>
          <!-- box -->



        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
