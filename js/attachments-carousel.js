const attachmentsThumbsSwiper = new Swiper('.swiper-container-thumbs', {
  spaceBetween: 16,
  slidesPerView: 'auto',
  // Responsive breakpoints
  // breakpoints: {
  //   // when window width is >= 320px
  //   320: {
  //     slidesPerView: 1
  //   },
  //   // when window width is >= 480px
  //   480: {
  //     slidesPerView: 2
  //   },
  //   // when window width is >= 640px
  //   768: {
  //     slidesPerView: 3
  //   },
  //   // when window width is >= 640px
  //   960: {
  //     slidesPerView: 4
  //   },
  //   // when window width is >= 640px
  //   1024: {
  //     slidesPerView: 5
  //   },
  //   // when window width is >= 640px
  //   1280: {
  //     slidesPerView: 6
  //   }
  // },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay: false
});
const attachmentsMainSwiper = new Swiper('.swiper-container-main', {
  slidesPerView: 1,
  slidesPerGroup: 1,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay: false,
  thumbs: {
    swiper: attachmentsThumbsSwiper,
    autoScrollOffset: 1
  }
});

// 2 of 4 : PHOTOSWIPE #######################################
// https://photoswipe.com/documentation/getting-started.html //

var initPhotoSwipeFromDOM = function(gallerySelector) {
  // parse slide data (url, title, size ...) from DOM elements
  // (children of gallerySelector)
  var parseThumbnailElements = function(el) {
    var thumbElements = el.childNodes,
        numNodes = thumbElements.length,
        items = [],
        figureEl,
        linkEl,
        imgWidth,
        imgHeight,
        item;

    for (var i = 0; i < numNodes; i++) {
      figureEl = thumbElements[i]; // <figure> element

      // include only element nodes
      if (figureEl.nodeType !== 1) {
        continue;
      }
      
      linkEl = figureEl.children[0]; // <a> element
      
      if (linkEl.classList.contains('attachment-without-image')) {
        item = {
          html: '<div class="attachment-without-image"><iframe src="' + linkEl.href +  '"></iframe></div>'
        }
      } else {
        imgWidth = linkEl.children[0] && linkEl.children[0].attributes.getNamedItem('width') ? linkEl.children[0].attributes.getNamedItem('width').value : 140;
        imgHeight = linkEl.children[0] && linkEl.children[0].attributes.getNamedItem('height') ? linkEl.children[0].attributes.getNamedItem('height').value : 140;
        
        // create slide object
        item = {
          src: linkEl.getAttribute("href"),
          w: parseInt(imgWidth, 10),
          h: parseInt(imgHeight, 10)
        };
        
        if (linkEl.children[1] && linkEl.children[1].classList.contains('swiper-slide-name')) {
          item.title = linkEl.children[1].innerText;
        }
      }

      item.el = figureEl; // save link to element for getThumbBoundsFn
      items.push(item);
    }

    return items;
  };

  // find nearest parent element
  var closest = function closest(el, fn) {
    return el && (fn(el) ? el : closest(el.parentNode, fn));
  };

  // triggers when user clicks on thumbnail
  var onThumbnailsClick = function(e) {
    e = e || window.event;
    e.preventDefault ? e.preventDefault() : (e.returnValue = false);

    var eTarget = e.target || e.srcElement;

    // find root element of slide
    var clickedListItem = closest(eTarget, function(el) {
      return el.tagName && el.tagName.toUpperCase() === "LI";
    });
   
    if (!clickedListItem) {
      return;
    }

    // find index of clicked item by looping through all child nodes
    // alternatively, you may define index via data- attribute
    var clickedGallery = clickedListItem.parentNode,
        childNodes = clickedListItem.parentNode.childNodes,
        numChildNodes = childNodes.length,
        nodeIndex = 0,
        index;

    for (var i = 0; i < numChildNodes; i++) {
      if (childNodes[i].nodeType !== 1) {
        continue;
      }

      if (childNodes[i] === clickedListItem) {
        index = nodeIndex;
        break;
      }
      nodeIndex++;
    }

    if (index >= 0) {
      // open PhotoSwipe if valid index found
      openPhotoSwipe(index, clickedGallery);
    }
    return false;
  };

  // parse picture index and gallery index from URL (#&pid=1&gid=2)
  var photoswipeParseHash = function() {
    var hash = window.location.hash.substring(1),
        params = {};

    if (hash.length < 5) {
      return params;
    }

    var vars = hash.split("&");
    for (var i = 0; i < vars.length; i++) {
      if (!vars[i]) {
        continue;
      }
      var pair = vars[i].split("=");
      if (pair.length < 2) {
        continue;
      }
      params[pair[0]] = pair[1];
    }

    if (params.gid) {
      params.gid = parseInt(params.gid, 10);
    }

    return params;
  };

  var openPhotoSwipe = function(
    index,
    galleryElement,
    disableAnimation,
    fromURL
  ) {
    var pswpElement = document.querySelectorAll(".pswp")[0],
        gallery,
        options,
        items;

    items = parseThumbnailElements(galleryElement);

    // #################### 3/4 define photoswipe options (if needed) #################### 
    // https://photoswipe.com/documentation/options.html //
    options = {
      showHideOpacity: false,
      loop: false,
      // Buttons/elements
      closeEl: true,
      captionEl: true,
      fullscreenEl: true,
      zoomEl: true,
      shareEl: false,
      counterEl: false,
      arrowEl: true,
      preloaderEl: true,
      bgOpacity: 0.85,
      // define gallery index (for URL)
      galleryUID: galleryElement.getAttribute("data-pswp-uid"),
      getThumbBoundsFn: function(index) {
        // See Options -> getThumbBoundsFn section of documentation for more info
        var thumbnail = items[index].el.getElementsByTagName("img")[0], // find thumbnail
            pageYScroll =
            window.pageYOffset || document.documentElement.scrollTop,
            rect = thumbnail.getBoundingClientRect();

        return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
      }
    };

    // PhotoSwipe opened from URL
    if (fromURL) {
      if (options.galleryPIDs) {
        // parse real index when custom PIDs are used
        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
        for (var j = 0; j < items.length; j++) {
          if (items[j].pid == index) {
            options.index = j;
            break;
          }
        }
      } else {
        // in URL indexes start from 1
        options.index = parseInt(index, 10) - 1;
      }
    } else {
      options.index = parseInt(index, 10);
    }

    // exit if index not found
    if (isNaN(options.index)) {
      return;
    }

    if (disableAnimation) {
      options.showAnimationDuration = 0;
    }

    // Pass data to PhotoSwipe and initialize it
    gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
  };

  // loop through all gallery elements and bind events
  var galleryElements = document.querySelectorAll(gallerySelector);
 
  for (var i = 0, l = galleryElements.length; i < l; i++) {
    galleryElements[i].setAttribute("data-pswp-uid", i + 1);
    galleryElements[i].onclick = onThumbnailsClick;
  }

  // Parse URL and open gallery if it contains #&pid=3&gid=1
  var hashData = photoswipeParseHash();

  if (hashData.pid && hashData.gid) {
    openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
  }
};

// execute above function
initPhotoSwipeFromDOM(".swiper-wrapper");

