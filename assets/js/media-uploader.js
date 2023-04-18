(function () {
	'use strict';

	(function () {

	  var themeName = object.themeName;

	  function setAttributes(el, attrs) {
	    for (var key in attrs) {
	      el.setAttribute(key, attrs[key]);
	    }
	  }

	  var elements = document.querySelectorAll('.' + themeName + '-image-uploader');

	  if (!!elements) {
	    elements.forEach(function (element, i) {
	      element.addEventListener('click', function (e) {
	        e.preventDefault(); //親要素取得

	        var parent = element.parentNode;
	        var customUploader = wp.media({
	          title: '画像を選択',
	          library: {
	            type: 'image'
	          },
	          button: {
	            text: 'この画像を使う'
	          },
	          multiple: false
	        }).on('select', function () {
	          var attachment = customUploader.state().get('selection').first().toJSON();
	          var removeButton = parent.querySelector('.' + themeName + '-remove-image');
	          var current = parent.querySelector('.' + themeName + '-image-current');
	          var preview = parent.querySelector('.' + themeName + '-image-loader-preview');
	          var val = parent.querySelector('input');

	          if (!preview) {
	            element.insertAdjacentHTML('beforebegin', '<img class="' + themeName + '-image-loader-preview" src="' + attachment.url + '" style="max-width:320px;margin-bottom:1rem;display:block;" alt="" />');
	          } else {
	            preview.setAttribute('src', attachment.url);
	          }

	          if (!!current) {
	            current.remove();
	          }

	          val.setAttribute('value', attachment.id);

	          if (!removeButton) {
	            // removeボタン作成して追加
	            var removebutton = document.createElement('a');
	            removebutton.innerText = '画像を削除';
	            setAttributes(removebutton, {
	              'href': '#',
	              'class': themeName + '-remove-image button'
	            });
	            element.insertAdjacentElement('afterend', removebutton);

	            removebutton.onclick = function () {
	              // プレビューと画像とinputの値を削除
	              var removeButton = parent.querySelector('.' + themeName + '-remove-image');
	              var current = parent.querySelector('.' + themeName + '-image-current');
	              var preview = parent.querySelector('.' + themeName + '-image-loader-preview');
	              var val = parent.querySelector('input');

	              if (preview) {
	                preview.remove();
	              }

	              if (current) {
	                current.remove();
	              }

	              removeButton.remove();
	              val.setAttribute('value', '');
	              return false;
	            };
	          }
	        }).open();
	      }, false);
	    });
	  }

	  var removeButtons = document.querySelectorAll('.' + themeName + '-remove-image');

	  if (!!removeButtons) {
	    removeButtons.forEach(function (removeButton, i) {
	      removeButton.addEventListener('click', function (e) {
	        var parent = removeButton.parentNode;
	        var current = parent.querySelector('.' + themeName + '-image-current');
	        var preview = parent.querySelector('.' + themeName + '-image-loader-preview');
	        var val = parent.querySelector('input');

	        if (preview) {
	          preview.remove();
	        }

	        if (current) {
	          current.remove();
	        }

	        removeButton.remove();
	        val.setAttribute('value', '');
	        return false;
	      });
	    });
	  }
	})();

})();
