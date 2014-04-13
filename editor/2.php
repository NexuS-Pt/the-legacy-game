<!-- ****** MEMBROS DA EQUIPA EDITOR ********* -->

<div id="sample">

<script type="text/javascript" src="editor/nicEdit-latest.js"></script> <script type="text/javascript">

      //<![CDATA[
	bkLib.onDomLoaded(function() {

      new nicEditor({buttonList : ['fontSize','fontFamily','bold','italic','underline','strikeThrough','left','center','right','justify','indent','outdent','subscript','superscript','forecolor','image','upload','link','unlink','removeformat','xhtml']}).panelInstance('area4');


      });

      //]]>

      </script>

      <div><textarea cols="60" id="area4" name="editor" style="width: 100%; height: 200px;"><?php if(!empty($editordataprint)){echo $editordataprint;} ?></textarea></div>
</div>
