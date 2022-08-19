@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>Contact Page</h4>
                <a href="{{ route('add.contact') }}" > <button class="btn btn-info">Add Contact</button> </a>

                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header"> All Contact data</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">SL</th>
                                <th scope="col" width="15%">Contact address</th>
                                <th scope="col" width="20%">Contact email</th>
                                <th scope="col" width="40%">Contact phone</th>
                                <th scope="col" width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($contacts as $con)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$con->address}}</td>
                                    <td>{{$con->email}}</td>
                                    <td>{{$con->phone}}</td>
                                    <td>
                                        <a href="{{url('contact/edit/'.$con->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{url('contact/delete/'.$con->id)}}"
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
