document.addEventListener('contextmenu', event => event.preventDefault());

$(document).ready(function(){
  $("img").on("error", function () {
      $(this).attr("src", "/assets/img/image-not-found.png");
  });
  $("img.profile-img").on("error", function () {
      $(this).attr("src", "/assets/img/userNotFound.jpeg");
  });
});