<x-admin.master>

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle text-sm">Add Updates <br>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updates.add') }}" enctype="multipart/form-data" method="POST"
                        class="bg-white  contact-form">
                        @csrf
                        <div class="form-group">
                            <input required name="title" type="text" class="form-control" id=""
                                placeholder="Enter Title">
                        </div>

                        <div class="form-group">
                            {{-- <input required name="small_title" type="text" class="form-control" id=""
                                placeholder="Enter Content"> --}}
                            <Textarea class="form-control" placeholder="Enter Content" name="content"></Textarea>
                        </div>

                        <div class="form-group">
                            <input required name="image_path" type="file" class="form-control" id=""
                                placeholder="File Uploads">
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" value="Add" />
                </div>
                </form>
            </div>
        </div>
    </div>





    <div class="modal fade" id="clearAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle text-sm">
                        Clear All <br>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updates.clear') }}" class="bg-white  contact-form">
                        <div class="">
                            Are you Sure? <span style="color: rgb(205, 2, 2)"></span>
                            <strong>Clear All? </strong> ?
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-danger" value="Delete" />
                </div>
                </form>
            </div>
        </div>
    </div>






    @if ($updates->count())
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">All Updates  ({{ $updates->count() }})</h3>
            </div>
            <!-- /.card-body -->
            <div class="card-footer ">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#clearAll"
                    class="btn btn-sm btn-danger float-right m-1">Clear All</a>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#add"
                    class="btn btn-sm btn-success float-right m-1">Add</a>
            </div>






            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Main Title</th>
                                <th>Content</th>
                                {{-- <th>Posted by</th> --}}
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($updates as $key => $update)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $update->image_path) }}" 
                                        width="50" alt="{{ asset('storage/' . $update->image_path) }}">
                                </td>
                                <td>{{ $update->title }}</td>
                                <td>{{ $update->content}}</td>
                                {{-- <td>{{ $update->email }}</td> --}}
                                <td>{{ $update->created_at->diffForHumans() }}</td>
                                <td>

                                    <div class="flex">
                                        <a data-toggle="modal" data-target="#update-{{ $update->id }}"
                                            class="btn btn-sm btn-primary text-white">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#delete-{{ $update->id }}"
                                            class="btn btn-sm btn-danger text-white">
                                            <i class="fa fa-archive"></i>
                                        </a>
                                    </div>
                                    {{-- <a href="{{ asset('storage/'.$update->image_path)}}" download="{{ $update->large_title }}"  class="btn btn-primary">Link</a> --}}

                                </td>

                                <div class="modal fade" id="update-{{ $update->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle text-sm">
                                                    Modify <br>

                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.update.update', $update->id) }}"
                                                    class="bg-white  contact-form" enctype="multipart/form-data">
                                                    @csrf

                                                    @csrf
                                                    <div class="form-group">
                                                        <Textarea 
                                                        
                                                        name="title" class="form-control" placeholder="Enter top">

                                                            {{ $update->title  }}
                                                        </Textarea>
                                                    </div>

                                                    <div class="form-group">

                                                        <Textarea class="form-control" placeholder="Enter Content" name="content">
                                                             {{ $update->content  }}
                                                        </Textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <input name="image_path" type="file"
                                                            class="form-control" id=""
                                                            placeholder="File Uploads">
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" value="update" />
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="delete-{{ $update->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle text-sm">
                                                    Delete <br>

                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>


                                            <div class="modal-body">
                                                <form action="{{ route('admin.update.delete', $update->id) }}"
                                                    class="bg-white  contact-form">
                                                    <div class="">
                                                        Are you Sure? <span style="color: rgb(205, 2, 2)">Delete</span>
                                                        <strong>"{{ $update->ip }}" </strong> ?
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-danger" value="Delete" />
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
    @endforeach
    </tr>
    </tbody>
    </table>
    </div>
    <!-- /.table-responsive -->
    </div>


    </div>
@else
    <div class=" text-center container">
        <div class="jumbtron p-5 text-center">
            <div class="error text-danger">
                No updates Found!



            </div>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#add"
                class="btn btn-sm btn-success  m-1">Add New Data</a>

        </div>
    </div>
    @endif

    </x-master>
