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

  /** Event Listener */
  /** Get Header Height */


  function hakoniwaGetHeaderHeight() {
    var tocFixedHeader = document.getElementById('hakoniwa-toc-fixed');
    var html = document.documentElement;
    var masthead = document.getElementById('masthead');
    var mobileSize = 768;
    var headerHeight = 0; //tocがある時はtocで70

    if (!!tocFixedHeader) {
      headerHeight = tocFixedHeader.clientHeight;
    } else {
      //tocがない時は、ヘッダーの高さだけど、固定ヘッダーかどうかで取得する
      if (!!masthead && masthead.classList.contains('sticky')) {
        headerHeight = masthead.clientHeight;
      } //画面サイズが768pxより小さい場合&モバイル表示のヘッダーが固定されている時


      if (!!masthead && html.clientWidth < mobileSize && masthead.classList.contains('fixed-mobile')) {
        headerHeight = masthead.clientHeight;
      }
    }

    return headerHeight;
  }

  var getHeaderHeight = hakoniwaGetHeaderHeight();

  function hakoniwaSmoothScroll() {
    (function (window, undefined$1, getHeaderHeight // Code in a function to create an isolate scope
    ) {

      var heightFixedHeader = getHeaderHeight,
          // For layout with header with position:fixed. Write here the height of your header for your anchor don't be hiden behind
      //links = document.getElementsByTagName('a'), // ページ内のリンクタグを全取得
      href;
      var speed = 300,
          movingFrequency = 10,
          // 数値が高いほどスムーズになる
      links = document.querySelectorAll('a:not(.noscroll)');
      var getUrl = window.location;
      var baseUrl = getUrl.protocol + '//' + getUrl.host + '/' + getUrl.pathname.split('/')[1] + '/'; // 見つかったaタグの数だけループ

      for (var i = 0; i < links.length; i++) {
        href = links[i].attributes.href === undefined$1 ? null : links[i].attributes.href.nodeValue.toString(); // 現在のURL https://aaa.com/
        // #chapter-1
        // https://aaa.com/#chapter-1
        // https://aaa.com/
        // https://bbb.com#chapter-1
        // #を抜いたURLがbaseUrlと同じならスクロール実行

        var scrollFlag = false;

        if (href !== null) {
          //				const targetUrl = href.substr( 0, href.indexOf( '#' ) );
          var targetUrl = href.substring(0, href.indexOf('#'));

          if (baseUrl === targetUrl || !targetUrl) {
            //				if( ( baseUrl === targetUrl || ! targetUrl ) && href.indexOf('#') !== -1 ){
            scrollFlag = true;
          }
        }

        if (href !== null && href.length > 1 && href.indexOf('#') !== -1 && scrollFlag === true) {
          // href.substr(0, 1) == '#'
          links[i].onclick = function () {
            var element,
                href = this.attributes.href.nodeValue.toString(),
                //						url = href.substr( 0, href.indexOf( '#' ) ), // #を抜いたURL
            //						id = href.substr( href.indexOf( '#' ) + 1 ); // #以降の文字列
            url = href.substring(0, href.indexOf('#')),
                // #を抜いたURL
            id = href.substring(href.indexOf('#') + 1); // #以降の文字列

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

  /**
   * Scroll Top Button
   *
   */
  function hakoniwaScrollTopButton() {
    var button = document.getElementById('scroll-page-top');

    if (!!button) {
      window.addEventListener('scroll', function () {
        var e = window.pageYOffset || document.documentElement.scrollTop;
        setTimeout(function () {
          if (e > 100) {
            button.classList.add('show');
          } else {
            button.classList.remove('show');
          }
        }, 100);
      }, false);
    }
  }

  /** Init（ドキュメントを全部読み込んだ後の設定） */

  function hakoniwaInit() {
    /** スムーススクロール */
    hakoniwaSmoothScroll();
    /** スクロールトップボタン */

    hakoniwaScrollTopButton();
  }

  /** 最初に読み込む */

  document.addEventListener('DOMContentLoaded', hakoniwaInit);

})();
