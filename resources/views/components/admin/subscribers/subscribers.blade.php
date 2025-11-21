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
                    <form action="{{ route('admin.promotions.clear') }}" class="bg-white  contact-form">
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






    @if ($subscribers->count())
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">All Subsribers ({{ $subscribers->count() }})</h3>
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
                                <th>Email</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($subscribers as $key => $promotion)
                            <tr>
                                <td>{{ ++$key }}</td>
                                
                                <td>{{ $promotion->email }}</td>
                                {{-- <td>{{ $promotion->email }}</td> --}}
                                <td>{{ $promotion->created_at->diffForHumans() }}</td>
                                <td>

                                    <div class="flex">
                                        
                                        <a data-toggle="modal" data-target="#delete-{{ $promotion->id }}"
                                            class="btn btn-sm btn-danger text-white">
                                            <i class="fa fa-archive"></i>
                                        </a>
                                    </div>
                                    {{-- <a href="{{ asset('storage/'.$promotion->image_path)}}" download="{{ $promotion->large_title }}"  class="btn btn-primary">Link</a> --}}

                                </td>

                                


                                <div class="modal fade" id="delete-{{ $promotion->id }}" tabindex="-1"
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
                                                <form action="{{ route('admin.subscriber.delete', $promotion) }}"
                                                    class="bg-white  contact-form">
                                                    <div class="">
                                                        Are you Sure? <span style="color: rgb(205, 2, 2)">Delete</span>
                                                        <strong>"{{ $promotion->ip }}" </strong> ?
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
                No Subsribers Found!



            </div>
            
        </div>
    </div>
    @endif

    </x-master>
