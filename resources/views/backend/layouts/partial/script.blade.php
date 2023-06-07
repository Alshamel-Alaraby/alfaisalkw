<div rel="fadeInDown" id="addPersonModal" class="modal modalDialog" style="overflow:hidden;" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center">
                <div class="fa-3x text-center">
                    <i class="fa fa-cog fa-spin"></i>
                    @lang('front.Loading ....')
                </div>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- end::Scrolltop -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- end::Messages Sidebar -->
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{asset('backend')}}/js/plugins.bundle.js" type="text/javascript"></script>
<script src="{{asset('backend')}}/js/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<!--begin::Page Vendors(used by this page) -->

<!--end::Page Vendors -->
<!--begin::Page Scripts(used by this page) -->
<script src="{{asset('backend')}}/toastr/toastr.min.js" type="text/javascript"></script>
<!--end::Page Scripts -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#2c77f4",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
{{--<script src="{{asset('backend')}}/js/charts/Chart.bundle.min.js"></script>
<script src="{{asset('backend')}}/js/charts/Chart.min.js"></script>--}}
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
</script>
{{--<script src="{{asset('backend')}}/calendar/main1.js"></script>
<script src="{{asset('backend')}}/calendar/main2.js"></script>
<script src="{{asset('backend')}}/calendar/main3.js"></script>
<script src="{{asset('backend')}}/calendar/main4.js"></script>
<script src="{{asset('backend')}}/calendar/main5.js"></script>--}}
<!-- Select2 -->
<script src="{{asset('backend')}}/select2/js/select2.full.min.js"></script>
<script>
    function mydate()
    {
      //alert("");
    document.getElementById("dt").hidden=false;
    document.getElementById("ndt").hidden=true;
    }
    function mydate1()
    {
     d=new Date(document.getElementById("dt").value);
    dt=d.getDate();
    mn=d.getMonth();
    mn++;
    yy=d.getFullYear();
    document.getElementById("ndt").value=dt+"/"+mn+"/"+yy
    document.getElementById("ndt").hidden=false;
    document.getElementById("dt").hidden=true;
    }

    
    @if (session()->has('alert-success'))
        toastr.success("{{session('alert-success')}}");
    @elseif (session()->has('alert-danger'))
        toastr.error("{{session('alert-danger')}}");
    @endif
    $(".select2").select2();
    $('body').on('click', '[data-toggle="modal"]', function(){
        var animation = $($(this).data("target")).attr('rel');
        $($(this).data("target")+' .modal-dialog').attr('class', 'modal-lg modal-dialog animated '+animation);
        $($(this).data("target")+' .modal-body').load($(this).data("remote"));
    });
    // $("#addPersonModal").on("show.bs.modal", function(e) {
    //     e.preventDefault();
    //     var link = $(e.relatedTarget);
    //     alert(link);
    //     $(this).find(".modal-body").load(link.attr("href"));
    // });
    $(document).on('hidden.bs.modal', function (e) {
        $(e.target).removeData('bs.modal');
    });
    $(document).on("click",".deleteRecord",function(e){
        e.preventDefault();
        var element = $(this);
        var tableId = element.closest('table').attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: element.data('action'),
                    type: 'DELETE',
                    data: {_token: "{{ csrf_token() }}"},
                    success: function () {
                        if(tableId==undefined){
                            location.reload();
                        }else{
                            var table = $("#"+tableId).DataTable();
                            table.row( element.closest('tr') ).remove().draw();
                        }

                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        )
                    }
                });
            }
        });
    });
    $(document).on('click',".deleteImg",function(e){
        e.preventDefault();
        var mediaId = $(this).attr('rel');
        var parent = $(this).closest('.imageContainer');
        parent.closest('form').append('<input type="hidden" value="'+mediaId+'" class="form-control" name="mediaTodelete[]">');
        parent.fadeOut();
    });
    $(document).ready(function () {
        var current = window.location.href;
        current = current.replace(/\/$/, "");
        //current = current.replace("/ar", "");
        //current = current.replace("/en", "");
        $("ul.kt-menu__nav  li.kt-menu__item--active").removeClass('kt-menu__item--active');
        $('a[href="'+current+'"]').closest('li').addClass('kt-menu__item--active');
    });


</script>
@stack('js')
