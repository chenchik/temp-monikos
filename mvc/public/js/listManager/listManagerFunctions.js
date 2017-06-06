//Created by Zhenwei Zhang Monikos LLC


/* Open when someone clicks on the span element */
function openNav() {
  document.getElementById("createList_overlay").style.width = "100%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("createList_overlay").style.width = "0%";
}

$(document).ready(function() {

  $('.list-collection-block').on('click', '.list-block', function() {

    var brands = $(this.childNodes[3]);
    console.log(this.childNodes);

    brands.slideToggle("fast");
  });


});

$(function() {
  $('#search').on('keyup', function() {
    var pattern = $(this).val();
    $('.searchable-container .item').hide();
    $('.searchable-container .item').filter(function() {
      return $(this).text().match(new RegExp(pattern, 'i'));
    }).show();
  });

  $('#searchlist').on('keyup', function() {
    var pattern = $(this).val();
    $('.list-collection-block .list_block').filter(function() {
      // console.log($(this.childNodes[1]));
      console.log($('.list_name_header').text());
      return $('.list_name_header').text().match(new RegExp(
        pattern, 'i'));
    }).show();
  });
});
