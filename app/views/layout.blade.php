<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบบันทึกเงินเหลือจ่าย คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่</title>

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">

	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <style>
    /*@import url(//fonts.googleapis.com/css?family=Lato:700);*/

    body {
      margin:0;
      font-family:'Lato', sans-serif;
      color: #333;
    }

    .welcome {
      width: 300px;
      height: 200px;
      position: absolute;
      left: 50%;
      top: 50%;
      margin-left: -150px;
      margin-top: -100px;
    }

    a, a:visited {
      text-decoration:none;
    }

    h1 {
      font-size: 32px;
      margin: 16px 0 0 0;
    }

    .disabled{
      background-color:#efefef;
    }
  </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<?php 
  $year = date("Y")+543;
  $semester = 1 ;
?>

<div class="container">

  <div class="row">
  <div style="padding:10px" class="col-md-12">
    <h4 style="float:left;margin-left:0px;margin-top:30px">ระบบบันทึกเงินเหลือจ่าย คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่</h4>

    <div style="float:right;margin-top:25px">

    <div class="btn-group">
    <div class="dropdown btn-group">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        รายรับ
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li><a href="{{ route('additem') }}">เพิ่มรายรับ</a></li>
        <li><a href="{{ route('additem2') }}">เพิ่มรายรับประเภท /OH/อื่น ๆ </a></li> 
        <li><a href="{{ route('additem3') }}">เพิ่มรายรับประเภท ค่าจัดสรรค่าธรรมเนียม </a></li> 
      </ul>
    </div>

    <div class="dropdown btn-group">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        รายจ่าย
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li>{{ link_to('expenditure1','แก้ไขรายจ่ายประจำปี ตามภาควิชา') }}</li>
        <li>{{ link_to('expenditure2','แก้ไข รับ(+) จ่าย(-) ประจำปี') }}</li> 
      </ul>
    </div>


      <div class="dropdown btn-group">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        รายงาน
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li><a href="{{url('report/semester/'.$semester.'/'.$year)}}">รายงานประจำเทอม/ปีการศึกษา</a></li>
        <li><a href="{{url('report/year/'.$year)}}">รายงานสรุปตามภาควิชา</a></li> 
      </ul>
    </div>


    <div class="dropdown btn-group">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
        แก้ไขค่าคงที่
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li>
          <a href="{{ route('addconstant', array('semester' => 1, 'year' => 2557)) }}">ค่าคงที่ SCCH</a>
        </li>
        <li>
          <a href="{{ route('percent',array('year'=>2557)) }}">ค่าคงที่ Percent</a></li>
        </li>
      </ul>
    </div>

    <div class="dropdown btn-group">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu5" data-toggle="dropdown" aria-expanded="true">
        ผู้ใช้
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li><a href="{{url('usermanage')}}">จัดการผู้ใช้</a></li>
        <li><a href="{{url('userprofile')}}">ข้อมูลส่วนตัว</a></li> 
        <li><a href="{{url('logout')}}">ออกจากระบบ</a></li> 
      </ul>
    </div>
      
      
      
    </div>
      

    </div>
    <div style="clear:both"></div>
    <hr>
  </div>
  </div>

  <div class="row">

        <!-- <div class="col-md-1">
        </div> -->

        <div class="col-md-12">
        @yield('content')
        </div>

<!--         <div class="col-md-1">
        </div> -->

  </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>


<script>
/*!
  Autosize 1.18.17
  license: MIT
  http://www.jacklmoore.com/autosize
*/
(function ($) {
  var
  defaults = {
    className: 'autosizejs',
    id: 'autosizejs',
    append: '\n',
    callback: false,
    resizeDelay: 10,
    placeholder: true
  },

  // border:0 is unnecessary, but avoids a bug in Firefox on OSX
  copy = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',

  // line-height is conditionally included because IE7/IE8/old Opera do not return the correct value.
  typographyStyles = [
    'fontFamily',
    'fontSize',
    'fontWeight',
    'fontStyle',
    'letterSpacing',
    'textTransform',
    'wordSpacing',
    'textIndent',
    'whiteSpace'
  ],

  // to keep track which textarea is being mirrored when adjust() is called.
  mirrored,

  // the mirror element, which is used to calculate what size the mirrored element should be.
  mirror = $(copy).data('autosize', true)[0];

  // test that line-height can be accurately copied.
  mirror.style.lineHeight = '99px';
  if ($(mirror).css('lineHeight') === '99px') {
    typographyStyles.push('lineHeight');
  }
  mirror.style.lineHeight = '';

  $.fn.autosize = function (options) {
    if (!this.length) {
      return this;
    }

    options = $.extend({}, defaults, options || {});

    if (mirror.parentNode !== document.body) {
      $(document.body).append(mirror);
    }

    return this.each(function () {
      var
      ta = this,
      $ta = $(ta),
      maxHeight,
      minHeight,
      boxOffset = 0,
      callback = $.isFunction(options.callback),
      originalStyles = {
        height: ta.style.height,
        overflow: ta.style.overflow,
        overflowY: ta.style.overflowY,
        wordWrap: ta.style.wordWrap,
        resize: ta.style.resize
      },
      timeout,
      width = $ta.width(),
      taResize = $ta.css('resize');

      if ($ta.data('autosize')) {
        // exit if autosize has already been applied, or if the textarea is the mirror element.
        return;
      }
      $ta.data('autosize', true);

      if ($ta.css('box-sizing') === 'border-box' || $ta.css('-moz-box-sizing') === 'border-box' || $ta.css('-webkit-box-sizing') === 'border-box'){
        boxOffset = $ta.outerHeight() - $ta.height();
      }

      // IE8 and lower return 'auto', which parses to NaN, if no min-height is set.
      minHeight = Math.max(parseFloat($ta.css('minHeight')) - boxOffset || 0, $ta.height());

      $ta.css({
        overflow: 'hidden',
        overflowY: 'hidden',
        wordWrap: 'break-word' // horizontal overflow is hidden, so break-word is necessary for handling words longer than the textarea width
      });

      if (taResize === 'vertical') {
        $ta.css('resize','none');
      } else if (taResize === 'both') {
        $ta.css('resize', 'horizontal');
      }

      // getComputedStyle is preferred here because it preserves sub-pixel values, while jQuery's .width() rounds to an integer.
      function setWidth() {
        var width;
        var style = window.getComputedStyle ? window.getComputedStyle(ta, null) : null;

        if (style) {
          width = parseFloat(style.width);
          if (style.boxSizing === 'border-box' || style.webkitBoxSizing === 'border-box' || style.mozBoxSizing === 'border-box') {
            $.each(['paddingLeft', 'paddingRight', 'borderLeftWidth', 'borderRightWidth'], function(i,val){
              width -= parseFloat(style[val]);
            });
          }
        } else {
          width = $ta.width();
        }

        mirror.style.width = Math.max(width,0) + 'px';
      }

      function initMirror() {
        var styles = {};

        mirrored = ta;
        mirror.className = options.className;
        mirror.id = options.id;
        maxHeight = parseFloat($ta.css('maxHeight'));

        // mirror is a duplicate textarea located off-screen that
        // is automatically updated to contain the same text as the
        // original textarea.  mirror always has a height of 0.
        // This gives a cross-browser supported way getting the actual
        // height of the text, through the scrollTop property.
        $.each(typographyStyles, function(i,val){
          styles[val] = $ta.css(val);
        });

        $(mirror).css(styles).attr('wrap', $ta.attr('wrap'));

        setWidth();

        // Chrome-specific fix:
        // When the textarea y-overflow is hidden, Chrome doesn't reflow the text to account for the space
        // made available by removing the scrollbar. This workaround triggers the reflow for Chrome.
        if (window.chrome) {
          var width = ta.style.width;
          ta.style.width = '0px';
          var ignore = ta.offsetWidth;
          ta.style.width = width;
        }
      }

      // Using mainly bare JS in this function because it is going
      // to fire very often while typing, and needs to very efficient.
      function adjust() {
        var height, originalHeight;

        if (mirrored !== ta) {
          initMirror();
        } else {
          setWidth();
        }

        if (!ta.value && options.placeholder) {
          // If the textarea is empty, copy the placeholder text into
          // the mirror control and use that for sizing so that we
          // don't end up with placeholder getting trimmed.
          mirror.value = ($ta.attr("placeholder") || '');
        } else {
          mirror.value = ta.value;
        }

        mirror.value += options.append || '';
        mirror.style.overflowY = ta.style.overflowY;
        originalHeight = parseFloat(ta.style.height) || 0;

        // Setting scrollTop to zero is needed in IE8 and lower for the next step to be accurately applied
        mirror.scrollTop = 0;

        mirror.scrollTop = 9e4;

        // Using scrollTop rather than scrollHeight because scrollHeight is non-standard and includes padding.
        height = mirror.scrollTop;

        if (maxHeight && height > maxHeight) {
          ta.style.overflowY = 'scroll';
          height = maxHeight;
        } else {
          ta.style.overflowY = 'hidden';
          if (height < minHeight) {
            height = minHeight;
          }
        }

        height += boxOffset;

        if (Math.abs(originalHeight - height) > 1/100) {
          ta.style.height = height + 'px';

          // Trigger a repaint for IE8 for when ta is nested 2 or more levels inside an inline-block
          mirror.className = mirror.className;

          if (callback) {
            options.callback.call(ta,ta);
          }
          $ta.trigger('autosize.resized');
        }
      }

      function resize () {
        clearTimeout(timeout);
        timeout = setTimeout(function(){
          var newWidth = $ta.width();

          if (newWidth !== width) {
            width = newWidth;
            adjust();
          }
        }, parseInt(options.resizeDelay,10));
      }

      if ('onpropertychange' in ta) {
        if ('oninput' in ta) {
          // Detects IE9.  IE9 does not fire onpropertychange or oninput for deletions,
          // so binding to onkeyup to catch most of those occasions.  There is no way that I
          // know of to detect something like 'cut' in IE9.
          $ta.on('input.autosize keyup.autosize', adjust);
        } else {
          // IE7 / IE8
          $ta.on('propertychange.autosize', function(){
            if(event.propertyName === 'value'){
              adjust();
            }
          });
        }
      } else {
        // Modern Browsers
        $ta.on('input.autosize', adjust);
      }

      // Set options.resizeDelay to false if using fixed-width textarea elements.
      // Uses a timeout and width check to reduce the amount of times adjust needs to be called after window resize.

      if (options.resizeDelay !== false) {
        $(window).on('resize.autosize', resize);
      }

      // Event for manual triggering if needed.
      // Should only be needed when the value of the textarea is changed through JavaScript rather than user input.
      $ta.on('autosize.resize', adjust);

      // Event for manual triggering that also forces the styles to update as well.
      // Should only be needed if one of typography styles of the textarea change, and the textarea is already the target of the adjust method.
      $ta.on('autosize.resizeIncludeStyle', function() {
        mirrored = null;
        adjust();
      });

      $ta.on('autosize.destroy', function(){
        mirrored = null;
        clearTimeout(timeout);
        $(window).off('resize', resize);
        $ta
          .off('autosize')
          .off('.autosize')
          .css(originalStyles)
          .removeData('autosize');
      });

      // Call adjust in case the textarea already contains text.
      adjust();
    });
  };
}(jQuery || $)); // jQuery or jQuery-like library, such as Zepto

</script>