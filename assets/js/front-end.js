(function () {
  'use strict';

  function _typeof(obj) {
    "@babel/helpers - typeof";

    return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) {
      return typeof obj;
    } : function (obj) {
      return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    }, _typeof(obj);
  }

  /** Smooth Scroll */
  var getHeaderHeight = 0;

  function hakoniwaSmoothScroll() {
    (function (window, undefined$1, getHeaderHeight // Code in a function to create an isolate scope
    ) {

      var heightFixedHeader = getHeaderHeight,
          // For layout with header with position:fixed. Write here the height of your header for your anchor don't be hiden behind
      href;
      var speed = 300,
          movingFrequency = 10,
          links = document.querySelectorAll('a:not(.noscroll)');
      var getUrl = window.location;
      var baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + getUrl.pathname.split('/')[1] + '/';

      for (var i = 0; i < links.length; i++) {
        href = links[i].attributes.href === undefined$1 ? null : links[i].attributes.href.nodeValue.toString();
        var scrollFlag = false;

        if (href !== null) {
          var targetUrl = href.substring(0, href.indexOf('#'));

          if (baseUrl === targetUrl || !targetUrl) {
            scrollFlag = true;
          }
        }

        if (href !== null && href.length > 1 && href.indexOf('#') !== -1 && scrollFlag === true) {
          links[i].onclick = function () {
            var element,
                href = this.attributes.href.nodeValue.toString(),
                url = href.substring(0, href.indexOf('#')),
                id = href.substring(href.indexOf('#') + 1);

            if (element = document.getElementById(id)) {
              var _ret = function () {
                var hopCount = (speed - speed % movingFrequency) / movingFrequency,
                    // Always make an integer
                getScrollTopDocumentAtBegin = getScrollTopDocument(),
                    gap = (getScrollTopElement(element) - getScrollTopDocumentAtBegin) / hopCount;
                if (window.history && typeof window.history.pushState === 'function') window.history.pushState({}, undefined$1, url + '#' + id); // Change URL for modern browser

                var _loop = function _loop(j) {
                  (function () {
                    var hopTopPosition = gap * j;
                    setTimeout(function () {
                      window.scrollTo(0, hopTopPosition + getScrollTopDocumentAtBegin);
                    }, movingFrequency * j);
                  })();
                };

                for (var j = 1; j <= hopCount; j++) {
                  _loop(j);
                }

                return {
                  v: false
                };
              }();

              if (_typeof(_ret) === "object") return _ret.v;
            }
          };
        }
      }

      var getScrollTopElement = function getScrollTopElement(e) {
        var top = heightFixedHeader * -1;

        while (e.offsetParent !== undefined$1 && e.offsetParent !== null) {
          top += e.offsetTop + (e.clientTop !== null ? e.clientTop : 0);
          e = e.offsetParent;
        }

        return top;
      };

      var getScrollTopDocument = function getScrollTopDocument() {
        return window.pageYOffset !== undefined$1 ? window.pageYOffset : document.documentElement.scrollTop !== undefined$1 ? document.documentElement.scrollTop : document.body.scrollTop;
      };
    })(window, undefined, getHeaderHeight);
  }

  /** Init */

  function hakoniwaInit() {
    /** Smooth Scroll */
    hakoniwaSmoothScroll();
  }

  document.addEventListener('DOMContentLoaded', hakoniwaInit);

})();
