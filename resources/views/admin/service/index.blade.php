@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>Home Slider</h4>
                <a href="{{ route('add.service') }}" > <button class="btn btn-info">Add Service</button> </a>

                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header"> All Slider</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">SL</th>
                                <th scope="col" width="10%"> Title</th>
                                <th scope="col" width="30%">Text</th>
                                <th scope="col" width="20%">link</th>
                                <th scope="col" width="15%">Image</th>
                                <th scope="col" width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($service as $item)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->text}}</td>
                                    <td>{{$item->link}}</td>

                                    <td><img src="{{asset($item->image)}}" style="height: 40px; width: 70px"></td>

                                    <td>
                                        <a href="{{url('service/edit/'.$item->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{url('service/delete/'.$item->id)}}"
                                           onclick="return confirm('Are you sure to delete')"
                                           class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
