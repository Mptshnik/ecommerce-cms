<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
    }
</script>
@if(Session::has('success'))
    <script>
        toastr.success("{{Session::get('success')}}")
    </script>
@endif
@if(Session::has('fail'))
    <script>
        toastr.error("{{Session::get('fail')}}")
    </script>
@endif
