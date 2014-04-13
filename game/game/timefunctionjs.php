<script language="JavaScript" type="text/javascript">
<!-- Copyright 2006, Sandeep Gangadharan -->
<!-- For more free scripts go to http://www.sivamdesign.com/scripts/ -->


var sec = <?php echo date("s",(($conta['game']['last_fight']) + 60 * $multval) - time()); ?>;   // set the seconds
var min = <?php echo date("i",(($conta['game']['last_fight']) + 60 * $multval) - time()); ?>;   // set the minutes

function countDown() {
   sec--;
  if (sec == -01) {
   sec = 59;
   min = min - 1; }
  else {
   min = min; }

if (sec<=9) { sec = "0" + sec; }

  time = (min<=9 ? "0" + min : min) + " : " + sec + " ";

if (document.getElementById) { document.getElementById('theTime').innerHTML = time; }

SD=window.setTimeout("countDown();", 1000);
if (min == '00' && sec == '00') { sec = "00"; window.clearTimeout(SD); }
}
window.onload = countDown;

</script>