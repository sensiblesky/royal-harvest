 <x-layouts.base title="Apply">

     {{-- Page-specific styles --}}
     <style>
         .form-group {
             margin-bottom: 20px;
         }

         label {
             display: block;
             margin-bottom: 8px;
             font-weight: 600;
             color: #2c3e50;
         }

         input,
         select {
             width: 100%;
             padding: 14px 15px;
             border: 1px solid #ddd;
             border-radius: 8px;
             font-size: 16px;
             transition: all 0.3s ease;
             background-color: #f9f9f9;
         }

         input:focus,
         select:focus {
             outline: none;
             border-color: #D4AF37;
             box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
         }

         .row .form-group {
             flex: 1;
         }

         /* Programme table styling */
         .programme-table {
             background: #ffffff;
             border-radius: 10px;
             overflow: hidden;
         }

         .programme-table .table-header,
         .programme-table .table-row {
             display: grid;
             grid-template-columns: 60px 2fr 1fr 1fr;
             padding: 15px 20px;
             align-items: center;
         }

         .programme-table .table-header {
             background: #D4AF37;
             color: #fff;
             font-weight: 600;
         }

         .programme-table .table-row {
             border-bottom: 1px solid #eee;
         }

         .programme-table .table-row:last-child {
             border-bottom: none;
         }
     </style>


    


         <section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb"
             style="background-image: url({{ asset('static/images/bg_5.jpg') }});" data-stellar-background-ratio="0.5">
             <div class="overlay"></div>

             <div class="container">
                 <div class="row justify-content-end">
                     <div class="col-md-6 py-5 px-md-5">
                         <div class="py-md-5">

                             <!-- Heading -->
                             <div class="heading-section heading-section-white ftco-animate mb-5">
                                 <h4 class="mb-4">Programmes Offered</h2>
                             </div>
@if ($programmes->count())
    
                  
                             <div class="programme-table ftco-animate">

                                 <div class="table-header">
                                     <div>#</div>
                                     <div>Programme Name</div>
                                     <div>Programme Cost</div>
                                     <div>Duration</div>
                                 </div>

                                 {{-- Example row (replace with dynamic data) --}}
                                 @foreach ($programmes as $key => $programme)
                                     <div class="table-row">
                                         <div>{{ $loop->iteration }}</div>
                                         <div>{{ $programme->name }}</div>
                                         <div>{{ $programme->cost }}</div>
                                         <div>{{ $programme->duration }}</div>
                                     </div>
                                 @endforeach
                                 <div class="d-flex justify-content-between m-3">
                                     @if ($programmes->onFirstPage())
                                         <span class="text-muted">← Previous</span>
                                     @else
                                         <a href="{{ $programmes->previousPageUrl() }}">← Previous</a>
                                     @endif

                                     @if ($programmes->hasMorePages())
                                         <a href="{{ $programmes->nextPageUrl() }}">Next →</a>
                                     @else
                                         <span class="text-muted">Next →</span>
                                     @endif
                                 </div>

                                
                           

                             </div>
                             @endif
          

                         </div>
                     </div>
                 </div>
             </div>


         </section>


    
 </x-layouts.base>
