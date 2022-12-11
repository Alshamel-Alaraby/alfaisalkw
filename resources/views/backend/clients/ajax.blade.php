
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        إضافة عميل جديد
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    @include('backend.layouts.partial.error')
                    <form id="clientForm" action="{{ route('backend.clients.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('backend.clients._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(request()->ajax()=='ajax')
    <script>
        $(function () {
            $("#clientForm").submit(function(e) {
                var form = $(this);
                var url = form.attr('action');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function(data)
                    {
                        $("#client_id").empty();
                        $("#client_id").append(data);
                        $("#client_id option:last").attr("selected", "selected");
                        $('.close').trigger('click');
                        $( "#client_id" ).trigger('change');
                    }
                });
            });
        });
    </script>
@endif
