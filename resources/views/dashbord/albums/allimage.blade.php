@extends('layouts.admin')
@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>all image</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('albums.index')}}"><i class="fa fa-dashboard"></i>Albums</a></li>

            </ol>
        </section>

        <section class="content">
          <!-- general form elements -->
          <div class="box box-primary">
             <div class="box-body">

                 <table class="table table-hover">
                  <thead>
                <tr>
                  <th style="wcity_idth: 10px">#</th>
                 <th>name</th>
                 <td>picture</td>
                 <td>action</td>

                </tr>
                  </thead>
              <tbody>
                <?php
                $count=0;
               ?>
                @foreach($albums->Pictures as $pic)
                <tr>
                  <td>{{$count++;}}</td>
                  <td>{{$pic->name}}</td>
                  <td><img src="{{asset('uploads/albums/'.$albums->name.'/'.$pic->picture)}}" style="width: 100px" class="img-thumbnail image-preview"></td>
                  </td>
                  <td>

                        <a href="{{route('albums.editimage',['id'=>$pic->id])}}" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>
                            edit</a>

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
