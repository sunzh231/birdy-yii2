;(function(window) {

var svgSprite = '<svg>' +
  ''+
    '<symbol id="icon-lock" viewBox="0 0 1024 1024">'+
      ''+
      '<path d="M773.12 395.264l0-194.56c0-107.52-88.064-194.56-195.584-194.56L446.464 6.144c-108.544 0-195.584 87.04-195.584 194.56l0 194.56c-57.344 0-104.448 46.08-104.448 104.448l0 415.744c0 57.344 47.104 104.448 104.448 104.448l522.24 0c57.344 0 104.448-46.08 104.448-104.448L877.568 498.688C877.568 441.344 830.464 395.264 773.12 395.264zM589.824 836.608c0 14.336-11.264 25.6-25.6 25.6L459.776 862.208c-14.336 0-25.6-11.264-25.6-25.6l46.08-137.216c-26.624-12.288-46.08-38.912-46.08-70.656 0-43.008 34.816-77.824 77.824-77.824s77.824 34.816 77.824 77.824c0 31.744-18.432 58.368-46.08 70.656L589.824 836.608zM668.672 395.264 355.328 395.264 355.328 226.304c0-64.512 52.224-116.736 117.76-116.736l77.824 0c64.512 0 117.76 52.224 117.76 116.736L668.672 395.264z"  ></path>'+
      ''+
    '</symbol>'+
  ''+
    '<symbol id="icon-word" viewBox="0 0 1024 1024">'+
      ''+
      '<path d="M145.6 0C100.8 0 64 35.2 64 80v862.4C64 987.2 100.8 1024 145.6 1024h732.8c44.8 0 81.6-36.8 81.6-81.6V324.8L657.6 0h-512z" fill="#14A9DA" ></path>'+
      ''+
      '<path d="M960 326.4v16H755.2s-100.8-20.8-99.2-108.8c0 0 4.8 92.8 97.6 92.8H960z" fill="#0F93D0" ></path>'+
      ''+
      '<path d="M657.6 0v233.6c0 25.6 17.6 92.8 97.6 92.8H960L657.6 0z" fill="#FFFFFF" ></path>'+
      ''+
      '<path d="M291.2 862.4h-48c-9.6 0-17.6-8-17.6-17.6v-158.4c0-9.6 8-16 17.6-16h48c60.8 0 99.2 41.6 99.2 96s-38.4 96-99.2 96z m0-171.2h-41.6v148.8h41.6c48 0 75.2-33.6 75.2-73.6 0-41.6-27.2-75.2-75.2-75.2z m232 174.4c-57.6 0-96-43.2-96-99.2s38.4-99.2 96-99.2c56 0 94.4 41.6 94.4 99.2 0 56-38.4 99.2-94.4 99.2z m0-177.6c-43.2 0-70.4 33.6-70.4 78.4 0 44.8 27.2 76.8 70.4 76.8 41.6 0 70.4-32 70.4-76.8S564.8 688 523.2 688z m294.4 6.4c1.6 1.6 3.2 4.8 3.2 8 0 6.4-4.8 11.2-11.2 11.2-3.2 0-6.4-1.6-8-3.2-11.2-14.4-30.4-22.4-48-22.4-41.6 0-73.6 32-73.6 78.4 0 44.8 32 76.8 73.6 76.8 17.6 0 35.2-6.4 48-20.8 1.6-3.2 4.8-4.8 8-4.8 6.4 0 11.2 6.4 11.2 12.8 0 3.2-1.6 4.8-3.2 8-14.4 16-35.2 27.2-64 27.2-56 0-99.2-40-99.2-99.2s43.2-99.2 99.2-99.2c28.8 0 49.6 11.2 64 27.2z" fill="#FFFFFF" ></path>'+
      ''+
    '</symbol>'+
  ''+
    '<symbol id="icon-user" viewBox="0 0 1024 1024">'+
      ''+
      '<path d="M512 239.36m-239.36 0a239.36 239.36 0 1 0 478.72 0 239.36 239.36 0 1 0-478.72 0Z" fill="" ></path>'+
      ''+
      '<path d="M512 478.72a512 512 0 0 0-512 512V1024h1024v-33.28a512 512 0 0 0-512-512z" fill="" ></path>'+
      ''+
    '</symbol>'+
  ''+
'</svg>'
var script = function() {
    var scripts = document.getElementsByTagName('script')
    return scripts[scripts.length - 1]
  }()
var shouldInjectCss = script.getAttribute("data-injectcss")

/**
 * document ready
 */
var ready = function(fn){
  if(document.addEventListener){
      document.addEventListener("DOMContentLoaded",function(){
          document.removeEventListener("DOMContentLoaded",arguments.callee,false)
          fn()
      },false)
  }else if(document.attachEvent){
     IEContentLoaded (window, fn)
  }

  function IEContentLoaded (w, fn) {
      var d = w.document, done = false,
      // only fire once
      init = function () {
          if (!done) {
              done = true
              fn()
          }
      }
      // polling for no errors
      ;(function () {
          try {
              // throws errors until after ondocumentready
              d.documentElement.doScroll('left')
          } catch (e) {
              setTimeout(arguments.callee, 50)
              return
          }
          // no errors, fire

          init()
      })()
      // trying to always fire before onload
      d.onreadystatechange = function() {
          if (d.readyState == 'complete') {
              d.onreadystatechange = null
              init()
          }
      }
  }
}

/**
 * Insert el before target
 *
 * @param {Element} el
 * @param {Element} target
 */

var before = function (el, target) {
  target.parentNode.insertBefore(el, target)
}

/**
 * Prepend el to target
 *
 * @param {Element} el
 * @param {Element} target
 */

var prepend = function (el, target) {
  if (target.firstChild) {
    before(el, target.firstChild)
  } else {
    target.appendChild(el)
  }
}

function appendSvg(){
  var div,svg

  div = document.createElement('div')
  div.innerHTML = svgSprite
  svg = div.getElementsByTagName('svg')[0]
  if (svg) {
    svg.setAttribute('aria-hidden', 'true')
    svg.style.position = 'absolute'
    svg.style.width = 0
    svg.style.height = 0
    svg.style.overflow = 'hidden'
    prepend(svg,document.body)
  }
}

if(shouldInjectCss && !window.__iconfont__svg__cssinject__){
  window.__iconfont__svg__cssinject__ = true
  try{
    document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>");
  }catch(e){
    console && console.log(e)
  }
}

ready(appendSvg)


})(window)
