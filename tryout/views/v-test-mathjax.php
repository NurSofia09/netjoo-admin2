<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>

<body class="bgcolor-white">
 <div id="buffer">a</div>
 <div id="preview">b</div>



 <body>

<script>
  //
  //  Use a closure to hide the local variables from the
  //  global namespace
  //
  (function () {
    var QUEUE = MathJax.Hub.queue;  // shorthand for the queue
    var math = null, box = null;    // the element jax for the math output, and the box it's in

    //
    //  Hide and show the box (so it doesn't flicker as much)
    //
    var HIDEBOX = function () {box.style.visibility = "hidden"}
    var SHOWBOX = function () {box.style.visibility = "visible"}

    //
    //  Get the element jax when MathJax has produced it.
    //
    QUEUE.Push(function () {
      math = MathJax.Hub.getAllJax("MathOutput")[0];
      box = document.getElementById("box");
      SHOWBOX(); // box is initially hidden so the braces don't show
    });

    //
    //  The onchange event handler that typesets the math entered
    //  by the user.  Hide the box, then typeset, then show it again
    //  so we don't see a flash as the math is cleared and replaced.
    //
    window.UpdateMath = function (TeX) {
     console.log(TeX);
      QUEUE.Push(
          HIDEBOX,
          ["resetEquationNumbers",MathJax.InputJax.TeX],
          ["Text",math,TeX],
          SHOWBOX
      );
    }
  })();
</script>

<p>
Type some \(\rm\TeX\) code and press RETURN:<br /> 
<input id="MathInput" size="80" onchange="UpdateMath(this.value)" />
<a onclick="coba()">Coba</a>

</p>

<p>You typed:</p>
<div class="box" id="box" style="visibility:hidden">
<div id="MathOutput" class="output">$${}$$]</div>
</div>

<script>
function coba(){
 tes = '$\\tfrac{1}{9}$';
 UpdateMath(tes);
}
  //
  //  IE doesn't fire onchange events for RETURN, so
  //   use onkeypress to do a blur (and refocus) to
  //   force the onchange to occur
  //
  if (MathJax.Hub.Browser.isMSIE) {
    MathInput.onkeypress = function () {
      if (window.event && window.event.keyCode === 13) {this.blur(); this.focus()}
    }
  }
</script>

<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs2.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582CL4NjpNgssK1gBWZhNFjJHqD%2fo0pRNDOyA2cXl4blv0CRUMTiPRGeoA88v2dcWUa8BL3ybB%2bIRRNv5oGWPNWAfsLOnY5VlCEjOOXh8ePhBWhiFC5tEYnBrF65f045J1gPgghhUKM8v15Ay1y4JanC4bExNwLh7eg9KvFROca11kXQtsdD7lKK5li%2bntoWvBSowRphFmP3xGOUk7sFIMrsvSYvLy4L9%2fkBP5xv%2bjjypvmMUQappmeaiFVbr%2ftBNUFqdhfLuRYrU9zuW%2fsEVrvxZRj3PXQeKL2TQPvkKCHJykbUJXjyauxhobmGgz15K%2fOaR9N%2bd%2b0DetRJaY7viXrt81Sx6eUUUDMpYKRuIcJi6orTtfPzB1f0fpOBzRvgSWB4o050MXV8WMmvuvHsK8RnUErWfnnXM9zuEQxa5zKJZzBJiRssASrEHYAmom39hhkwpTqk0cOtYNa24z32AAdKPhy8wLIW1asYTLwW8ej4UI%2bFEn4dVbBjLHRxPf3p%2bJOKVBaHgTj6uO" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>
</body>
