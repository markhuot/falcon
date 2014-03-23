$(document).on('click', 'a', function(event) {
  var anchor = $(this);
  var href = anchor.attr('href');

  if (anchor.hasClass('shield')) {
    var page = $(this).closest('[data-paged-uri]');
    history.pushState({}, '', page.data('paged-uri'));
    page.removeClass('back').nextAll('.page').remove();
    anchor.remove();
    return false;
  }

  goToPage(event, $(this).attr('href'), 'get', {});
});

$(document).on('submit', 'form', function(event) {
  goToPage(event, $(this).attr('action'), 'post', $(this).serialize());
});

function goToPage(event, href, method, formData)
{
  event.preventDefault();
  var uri = href.replace(/^http:\/\/.*?(.dev|.com)\//, '/');

  $.ajax({
    url: href,
    type: method,
    data: formData,
    headers: {'X-Paged':'true'},
    success: function(data, code, jqXHR) {
      if (jqXHR.getResponseHeader('X-Paged-Replace')) {
        $('.page:not(.back)').html(data);
      }
      else if (jqXHR.getResponseHeader('X-Paged-Container')) {
        $('.page').addClass('back');
        $('.page:not(:has(.shield))').each(function() {
          $(this).append('<a class="shield" href="'+$(this).attr('data-paged-uri')+'" />');
        });
        container = $(jqXHR.getResponseHeader('X-Paged-Container'));
        page = $('<div class="page" />');
        page.attr('data-paged-uri', uri);
        page.append(data);
        container.append(page);
      }
      
      history.pushState({}, '', uri);
    }
  });
}