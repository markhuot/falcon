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

$(document).on('click', 'button', function(event) {
  event.preventDefault();
  event.stopPropagation();
  var form = $(this).closest('form');
  var data = $(form).serializeArray();
  data.push({
    'name': $(this).attr('name'),
    'value': $(this).attr('value')
  });
  goToPage(event, $(form).attr('action'), $(form).attr('method'), data);
});

$(document).on('submit', 'form', function(event) {
  goToPage(event, $(this).attr('action'), $(this).attr('method'), $(this).serialize());
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
      if (jqXHR.getResponseHeader('X-Paged-Pop-All')) {
        $('.page').remove();
      }

      for (i=1; i<10; i++) {
        var key = 'X-Paged-Refresh'+(i>1?i:'');
        if (jqXHR.getResponseHeader(key)) {
          var refreshUri = jqXHR.getResponseHeader(key);
          $('.page[data-paged-uri="'+refreshUri+'"]').each(function() {
            var page = $(this);
            $.ajax({
              url: page.attr('paged-data-uri'),
              type: 'get',
              data: {},
              headers: {'X-Paged':'true'},
              success: function(data, code, jqXHR) {
                page.find('> :not(.shield)').remove();
                page.prepend(data);
              }
            });
          });
        }
      }

      for (i=1; i<10; i++) {
        var key = 'X-Paged-Pop-To'+(i>1?i:'');
        if (jqXHR.getResponseHeader(key)) {
          var popToUri = jqXHR.getResponseHeader(key);
          var page = $('.page[data-paged-uri^="'+popToUri+'"]');
          if (page.length) {
            page.html(data).removeClass('back').nextAll('.page').remove();
            return;
          }
        }
      }

      if (jqXHR.getResponseHeader('X-Paged-Container')) {
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