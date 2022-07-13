$(document).ready(function(){
  $('.slide-master').children('.slide:first-child').show();
});
function nextSlide(index, obj)
{
  let slideMaster = $(obj).parent();
  let totalSlides = parseInt(slideMaster.children('.slide').length);
  let slideIndex = parseInt(slideMaster.attr('data-activeslide'));
  let newIndex = parseInt(index)+slideIndex;
  slideMaster.children('.slide').hide('slow');

  if(newIndex>totalSlides){newIndex=1;}
  if(newIndex<1) {newIndex=totalSlides;}

  slideMaster.children('.slides-caption').html(newIndex + ' / ' + totalSlides)
  slideMaster.attr('data-activeslide',newIndex);
  slideMaster.children('.slide:nth-child('+newIndex+')').show('slow');
}