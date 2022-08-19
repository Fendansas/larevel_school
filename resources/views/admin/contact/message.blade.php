@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4 class="p-md-1">Message Page</h4>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header"> All Message data</div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">SL</th>
                                <th scope="col" width="15%">Name</th>
                                <th scope="col" width="20%">Email</th>
                                <th scope="col" width="20%">Subject</th>
                                <th scope="col" width="20%">Message</th>
                                <th scope="col" width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($message as $mes)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$mes->name}}</td>
                                    <td>{{$mes->email}}</td>
                                    <td>{{$mes->subject}}</td>
                                    <td>{{$mes->message}}</td>
                                    <td>
                                        <a href="{{url('message/delete/'.$mes->id)}}"
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
