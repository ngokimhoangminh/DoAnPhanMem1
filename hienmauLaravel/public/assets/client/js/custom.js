$(function(){
  
      slick_slider();     
  });
function slick_slider()
{
  $('.co-operate--slide').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay:true,
        autoplaySpeed: 2000,
        prevArrow:'<span class="priv_arrow"><i class="fa fa-chevron-left"></i></span>',
    	nextArrow:'<span class="next_arrow"><i class="fa fa-chevron-right"></i></span>'
      });
}

////scroll_to_top
$(window).scroll(function(){
    if($(window).scrollTop() >= 10) {
      $('.button_scrolltop').show(1000);
    } else {
      $('.button_scrolltop').hide(1000);
    }
  });
  
  function page_scrolltop(){
    $('html,body').animate({
      scrollTop: 0
      }, 1500);
  }

//menu fixed
// window.onscroll = function() {myFunction()};

// var header = document.getElementById("navbarDropdown");
// var sticky = header.offsetTop;
// function myFunction() {
//   if (window.pageYOffset > sticky) 
//   {
//     header.classList.add("sticky");
//   } else {
//     header.classList.remove("sticky");
//   }

// }
//menu fixed