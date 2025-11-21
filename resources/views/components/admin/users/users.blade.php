<x-admin.master>

    <div class="modal fade" id="clear" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle text-sm">Clear All Courses <br>
             
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
  
        <form action="{{ Request::routeIs('')?route('admin.users.clear'):'' }}" class="bg-white  contact-form">
          <div class="">
            Are you Sure? Clear All users?
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-danger" value="Delete"/>
        </div>
      </form>
      </div>
    </div>
  </div>
      
      <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">All users</h3>
          </div>
           <!-- /.card-body -->
           <div class="card-footer ">
             {{-- <a href="javascript:void(0)" data-toggle="modal" data-target="#clear" class="btn btn-sm btn-danger float-right">Clear All Courses</a> --}}
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Time</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                      @foreach ($users as $key=> $user)
                      <tr>
                        <td >{{ ++$key }}</td>
                        <td >{{ $user->name }}</td>
                        <td >{{ $user->email }}</td>
                        <td >{{ $user->created_at->diffForHumans() }}</td>
                        <td >
                         <div class="flex">
  
                           <a data-toggle="modal"
                           data-target="#delete-{{ $user->id }}" 
                           class="btn btn-sm btn-danger text-white" >
                          <i class="fa fa-archive"></i>
                          </a>
                         </div>
                        
                        </td>
  
  
  
  
                        <div class="modal fade" id="delete-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle text-sm">Delete Course <br>
                                 
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                            <form action="{{ Request::routeIs('admin.user.delete')?route('admin.user.delete', $user->id):'' }}" class="bg-white  contact-form">
                              <div class="">
                                Are you Sure? <span style="color: rgb(205, 2, 2)">Delete</span> 
                                <strong>"{{ $user->name}}" </strong> ?
                              </div>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" class="btn btn-danger" value="Delete"/>
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
  </x-master>
  