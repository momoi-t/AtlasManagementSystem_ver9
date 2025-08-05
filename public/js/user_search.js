$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    const $btn = $(this);
    const $target = $btn.next('.subject_inner');

    $target.stop(true, true).slideToggle(200);
    $btn.find('.arrow_icon_subject').toggleClass('open');
  });
});
