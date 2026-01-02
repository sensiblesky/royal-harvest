<x-admin.master>


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
                    <form action="{{ route('admin.bookings.clear') }}" class="bg-white  contact-form">
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






    @if ($bookings->count())
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">All {{$bookings->first()->isDone==0? 'New':"Finished"}} Bookings ({{ $bookings->count() }})</h3>
            </div>
            <!-- /.card-body -->
            <div class="card-footer ">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#clearAll"
                    class="btn btn-sm btn-danger float-right m-1">Clear All</a>
            </div>






            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                           
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>date</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($bookings as $key => $booking)
                            <tr>
                                <td>{{ ++$key }}</td>
                                
                                <td>{{ $booking->code }}</td>
                                <td>{{ $booking->fullname }}</td>
                                <td>{{ $booking->email }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->time }}</td>
                             
                                {{-- <td>{{ $booking->created_at->diffForHumans() }}</td> --}}
                                <td>

                                    <div class="flex">
                                        <a data-toggle="modal" data-target="#status-{{ $booking->id }}"
                                            class="btn btn-sm {{$booking->isDone==0?'btn-primary':'btn-secondary'}} text-white">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#delete-{{ $booking->id }}"
                                            class="btn btn-sm btn-danger text-white">
                                            <i class="fa fa-archive"></i>
                                        </a>
                                    </div>
                                    {{-- <a href="{{ asset('storage/'.$booking->image_path)}}" download="{{ $booking->large_title }}"  class="btn btn-primary">Link</a> --}}

                                </td>

                                 <div class="modal fade" id="status-{{ $booking->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle text-sm">
                                                    Booking Status <br>

                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.booking.update', $booking) }}"
                                                    class="bg-white  contact-form">
                                                    <div class="">
                                                        Are you Sure? <span style="color: rgb(37, 77, 146)">Update Booking Status For </span>
                                                        <strong>{{ $booking->fname }} </strong> ?
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" value="Update" />
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete-{{ $booking->id }}" tabindex="-1"
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
                                                <form action="{{ route('admin.bookings.clear') }}"
                                                    class="bg-white  contact-form">
                                                    <div class="">
                                                        Are you Sure? <span style="color: rgb(205, 2, 2)">Clear</span>
                                                        all Bookings
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
                No Booking Found!
            </div>
           

        </div>
    </div>
    @endif

    </x-master>
