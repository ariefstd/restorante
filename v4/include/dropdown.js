// JavaScript Document

    $(function () {
      $('.default').dropkick();

      $('.black').dropkick({
        theme : 'black'
      });

      $('.change').dropkick({
        change: function (value, label) {
          alert('You picked: ' + label + ':' + value);
        }
      });

      $('.existing_event').dropkick({
        change: function () {
          $(this).change();
        }
      });

      $('.custom_theme').dropkick({
        theme: 'black',
        change: function (value, label) {
          $(this).dropkick('theme', value);
        }
      });

      $('.dk_container').first().focus();
    });
