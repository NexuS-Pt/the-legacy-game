<!-- ****** LITTLE EDITOR ********* -->

<div id="sample">

<script type="text/javascript" src="editor/nicEdit-latest.js"></script> <script type="text/javascript">

      //<![CDATA[
	bkLib.onDomLoaded(function() {

      new nicEditor({buttonList : ['bold','italic','underline','strikeThrough','ul','link','unlink']}).panelInstance('area4');


      });

      //]]>

      </script>

      <div><textarea cols="60" id="area4" name="editor" style="width: 100%; height: 200px;"><?php if(!empty($editordataprint)){echo $editordataprint;} ?></textarea></div>
</div>
