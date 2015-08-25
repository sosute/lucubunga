$(function () {
  var supportsInputAttribute = function (attr) {
    var input = document.createElement('input');
    return attr in input;
  };
  if (!supportsInputAttribute('placeholder')) {
    $('[placeholder]').each(function () {
      var
        input = $(this),
        placeholderText = input.attr('placeholder'),
        placeholderColor = 'GrayText',
        defaultColor = input.css('color');
      input.
        focus(function () {
          if (input.val() === placeholderText) {
            input.val('').css('color', defaultColor);
          }
        }).
        blur(function () {
          if (input.val() === '') {
            input.val(placeholderText).css('color', placeholderColor);
          } else if (input.val() === placeholderText) {
            input.css('color', placeholderColor);
          }
        }).
        blur().
        parents('form').
          submit(function () {
            if (input.val() === placeholderText) {
              input.val('');
            }
          });
    });
  }
});
