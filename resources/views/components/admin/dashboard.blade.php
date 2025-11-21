<x-admin.master>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Admin Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">admin</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number">{{ $users->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a
                                    href="{{ Request::routeIs('admin.product.index') ? route('admin.product.index') : '' }}">Downloads</a>
                            </span>
                            <span class="info-box-number">
                                {{ Request::routeIs('admin.product.index') ?  $downloads : '' }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href="{{ Request::routeIs('admin.visitor.index') ? route('admin.visitor.index')  : '' }}">Visitors</a>
                            </span>
                            <span class="info-box-number">
                                  {{ Request::routeIs('admin.visitor.index') ?   $visitors : '' }}
                               
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href="{{ Request::routeIs('admin.client.index') ? route('admin.client.index')  : ''  }}">Clients</a> </span>
                            <span class="info-box-number">{{ Request::routeIs('admin.client.index') ? $clients  : '' }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href="{{ Request::routeIs('admin.template.index') ?
                             route('admin.template.index')  : '' }}">Templates</a>
                            </span>
                            <span class="info-box-number">{{  Request::routeIs('admin.template.index') ?
                            $templates : ''  }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href="{{ Request::routeIs('admin.contact.index') ?
                             route('admin.contact.index')  : '' }}">Contacts</a>
                            </span>
                            <span class="info-box-number">{{  Request::routeIs('admin.contact.index') ?
                             $contacts  : ''  }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-admin.master>
