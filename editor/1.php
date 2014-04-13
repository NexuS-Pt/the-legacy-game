<!-- ****** FULL EDITOR ********* -->

<div id="sample">
<script type="text/javascript" src="editor/nicEdit-latest.js"></script> <script type="text/javascript">
      //<![CDATA[
	bkLib.onDomLoaded(function() {
      new nicEditor({fullPanel : true}).panelInstance('area2');
      });
      //]]>
      </script>

      <div><textarea cols="60" id="area2" name="editor" style="width: 100%; height: 200px;"><?php if (!isset($editordataprint)) {echo "";} else {echo $editordataprint;} ?></textarea></div>
</div>
