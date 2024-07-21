// $(function () { // if document is ready
//   alert('hello world')
// });

$(function () {
  //クリックで動く
  $('.nav-open').click(function () {
    $(this).toggleClass('active');
    $(this).next('nav').slideToggle();
  });
  //ホバーで動く
  // $('.nav-open').hover(function () {
  //   $(this).toggleClass('active');
  //   $(this).next('nav').slideToggle();
  // });
});
