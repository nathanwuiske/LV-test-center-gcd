/* Options for slider 1 (main slider on home page)*/

jssor_1_slider_init = function() {

  var jssor_1_options = {
    $AutoPlayInterval: 8000,
    $AutoPlay: 1,
    $SlideDuration: 800,
    $SlideEasing: $Jease$.$OutQuint,
    $ArrowNavigatorOptions: {
      $Class: $JssorArrowNavigator$
    },
    $BulletNavigatorOptions: {
      $Class: $JssorBulletNavigator$
    }
  };

  var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

  /*#region responsive code begin*/

  var MAX_WIDTH = 3000;
  


  function ScaleSlider() {
      var containerElement = jssor_1_slider.$Elmt.parentNode;
      var containerWidth = containerElement.clientWidth;

      if (containerWidth) {

          var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

          jssor_1_slider.$ScaleWidth(expectedWidth);
      }
      else {
          window.setTimeout(ScaleSlider, 30);
      }
  }

  ScaleSlider();

  $Jssor$.$AddEvent(window, "load", ScaleSlider);
  $Jssor$.$AddEvent(window, "resize", ScaleSlider);
  $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
  /*#endregion responsive code end*/
};

/* Options for slider 2 */

jssor_2_slider_init = function() {
   
       var jssor_1_options = {
         $AutoPlay: 0,
        // $AutoPlayInterval: 12000,
         $AutoPlaySteps: 1,
         $SlideDuration: 160,
         $SlideWidth: 255,
         $SlideSpacing: 10,
         $Align: 4,
         $ArrowNavigatorOptions: {
           $Class: $JssorArrowNavigator$,
           $Steps: 4
         },
         $BulletNavigatorOptions: {
           $Class: $JssorBulletNavigator$
         }
       };
   
       var jssor_1_slider = new $JssorSlider$("jssor_2", jssor_1_options);
       
       /*#region responsive code begin*/
   
       var MAX_WIDTH = 1125;
   
       this.OnArrowLeftClick = function () { jssor_1_slider.$Next(); }
	   this.OnArrowRightClick = function () { jssor_1_slider.$Prev(); }
   
      
   
       function ScaleSlider() {
           var containerElement = jssor_1_slider.$Elmt.parentNode;
           var containerWidth = containerElement.clientWidth;
   
           if (containerWidth) {
   
               var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
   
               jssor_1_slider.$ScaleWidth(expectedWidth);
           }
           else {
               window.setTimeout(ScaleSlider, 30);
           }
       }
   
       ScaleSlider();
      
   
       $Jssor$.$AddEvent(window, "load", ScaleSlider);
       $Jssor$.$AddEvent(window, "resize", ScaleSlider);
       $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
       /*#endregion responsive code end*/
   };
   
   
   /* Options for slider 3 */
   
   jssor_3_slider_init = function() {
   
       var jssor_1_options = {
         $AutoPlay: 0,
        // $AutoPlayInterval: 12000,
         $AutoPlaySteps: 1,
         $SlideDuration: 160,
         $SlideWidth: 255,
         $SlideSpacing: 10,
         $Align: 4,
         $ArrowNavigatorOptions: {
           $Class: $JssorArrowNavigator$,
           $Steps: 4
         },
         $BulletNavigatorOptions: {
           $Class: $JssorBulletNavigator$
         }
       };
   
       var jssor_1_slider = new $JssorSlider$("jssor_3", jssor_1_options);
   
       /*#region responsive code begin*/
   
       var MAX_WIDTH = 1125;
   
      
       function ScaleSlider() {
           var containerElement = jssor_1_slider.$Elmt.parentNode;
           var containerWidth = containerElement.clientWidth;
   
           if (containerWidth) {
   
               var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
   
               jssor_1_slider.$ScaleWidth(expectedWidth);
           }
           else {
               window.setTimeout(ScaleSlider, 30);
           }
       }
   
       ScaleSlider();
   
       $Jssor$.$AddEvent(window, "load", ScaleSlider);
       $Jssor$.$AddEvent(window, "resize", ScaleSlider);
       $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
       /*#endregion responsive code end*/
   };

    /* Options for slider 4 */
   
   jssor_4_slider_init = function() {
   
       var jssor_1_options = {
         $AutoPlay: 0,
        // $AutoPlayInterval: 12000,
         $AutoPlaySteps: 1,
         $SlideDuration: 160,
         $SlideWidth: 255,
         $SlideSpacing: 10,
         $Align: 4,
         $ArrowNavigatorOptions: {
           $Class: $JssorArrowNavigator$,
           $Steps: 4
         },
         $BulletNavigatorOptions: {
           $Class: $JssorBulletNavigator$
         }
       };
   
       var jssor_1_slider = new $JssorSlider$("jssor_4", jssor_1_options);
   
       /*#region responsive code begin*/
   
       var MAX_WIDTH = 1125;
   
      
       function ScaleSlider() {
           var containerElement = jssor_1_slider.$Elmt.parentNode;
           var containerWidth = containerElement.clientWidth;
   
           if (containerWidth) {
   
               var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
   
               jssor_1_slider.$ScaleWidth(expectedWidth);
           }
           else {
               window.setTimeout(ScaleSlider, 30);
           }
       }
   
       ScaleSlider();
   
       $Jssor$.$AddEvent(window, "load", ScaleSlider);
       $Jssor$.$AddEvent(window, "resize", ScaleSlider);
       $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
       /*#endregion responsive code end*/
   };
   
     /* Options for slider 5 (businesses) */
   
   jssor_5_slider_init = function() {
   
       var jssor_1_options = {
         $AutoPlay: 0,
        // $AutoPlayInterval: 12000,
         $AutoPlaySteps: 1,
         $SlideDuration: 160,
         $SlideWidth: 255,
         $SlideSpacing: 10,
         $Align: 4,
         $ArrowNavigatorOptions: {
           $Class: $JssorArrowNavigator$,
           $Steps: 4
         },
         $BulletNavigatorOptions: {
           $Class: $JssorBulletNavigator$
         }
       };
   
       var jssor_1_slider = new $JssorSlider$("jssor_5", jssor_1_options);
   
       /*#region responsive code begin*/
   
       var MAX_WIDTH = 1125;
   
      
       function ScaleSlider() {
           var containerElement = jssor_1_slider.$Elmt.parentNode;
           var containerWidth = containerElement.clientWidth;
   
           if (containerWidth) {
   
               var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
   
               jssor_1_slider.$ScaleWidth(expectedWidth);
           }
           else {
               window.setTimeout(ScaleSlider, 30);
           }
       }
   
       ScaleSlider();
   
       $Jssor$.$AddEvent(window, "load", ScaleSlider);
       $Jssor$.$AddEvent(window, "resize", ScaleSlider);
       $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
       /*#endregion responsive code end*/
   };
   
   