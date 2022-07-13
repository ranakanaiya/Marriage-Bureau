<!-- jQuery 2.1.3 -->
<script src="{{asset('/assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
<!-- jQuery UI 1.11.2 -->
<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{asset('/assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>    
<!-- Slimscroll -->
{{-- <script src="{{asset('/assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script> --}}
<!-- AdminLTE App -->
<script src="{{asset('/assets/dist/js/app.js')}}" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('/assets/dist/js/custom.js')}}" type="text/javascript"></script>

<script>
$(document).ready(function(){
  $('img').click(function(e) {
    $('#img01').attr('src',$(this).attr('src'));
    // $('#description01').html($(desc).html());
    // $('#date01').html($(date).html());
    $('#fullScreenModal').show();
  });
});
function screenClose()
{
    $('#fullScreenModal').hide();
}
</script>
<script>
      $( document ).ready(function () {
        $(function(){
  function stripTrailingSlash(str) {
    if(str.substr(-1) == '/') {
      return str.substr(0, str.length - 1);
    }
    return str;
  }

  var url = window.location.href;
  var activePage = stripTrailingSlash(url);

  $('.sidebar-menu li a').each(function(){  
    var currentPage = stripTrailingSlash($(this).attr('href'));

    if (activePage.indexOf(currentPage) !== -1) {//(activePage == currentPage) {
      $(this).parent().addClass('active');
      // $(this).parent().parents("li") .addClass('kt-menu__item--active');
    } 
  });
});
    });
</script>