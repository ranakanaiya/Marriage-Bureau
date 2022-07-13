<!-- jQuery 2.1.3 -->
<script src="{{asset('/frontend_assets/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script>
<!-- jQuery UI 1.11.2 -->
 {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{asset('/frontend_assets/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Slimscroll -->
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

{{-- <script src="{{asset('/frontend_assets/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script> --}}
<!-- AdminLTE App -->
<script src="{{asset('/frontend_assets/dist/js/app.js')}}" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('/frontend_assets/dist/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/dist/js/er_loader.js')}}"></script>
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    multilanguagePage: true,
    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
  }, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

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

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-52NKW8ZNC5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-52NKW8ZNC5');
</script>