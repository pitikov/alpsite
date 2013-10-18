$(document).ready(function() {
  $('#toolbar a').on('mouseenter', function() {
    //		$(this).find('input').stop();
    if ($(this).find('span').css('display') == 'none') $(this).find('span').show('fast');

  });

  $('#toolbar').on('mouseleave', function() {
    $('#toolbar a span').stop().hide('fast');
  });

  $('nav#main-navigation .menu-transform').on('mouseenter', function() {
    $(this).find('.sub-menu').css('margin-left', '0px');
    $('header a span').stop().hide(100);
    $('header #logo').stop().animate({'width': '90%', 'margin-left': '-45%'}, 100);
    $('nav#main-navigation').stop().animate({'width' : '70'}, 100);
  });

  $('nav#main-navigation .menu-transform').on('mouseleave', function() {
    $(this).find('.sub-menu').css('margin-left', '-9999px');
    $('header #logo').stop().animate({'width': '70%', 'margin-left': '-35%'}, 50);
    $('nav#main-navigation').stop().animate({'width' : '230'}, 50, function() { $('header a span').stop().show(100); });
  });

});
