<!-- BANNER DE PUBLICIDADE -->

<script language="JavaScript1.1">


/*
JavaScript Image slideshow:
By JavaScript Kit (www.javascriptkit.com)
Over 200+ free JavaScript here!
*/

var slideimages=new Array()
var slidelinks=new Array()
function slideshowimages(){
for (i=0;i<slideshowimages.arguments.length;i++){
slideimages[i]=new Image()
slideimages[i].src=slideshowimages.arguments[i]
}
}

function slideshowlinks(){
for (i=0;i<slideshowlinks.arguments.length;i++)
slidelinks[i]=slideshowlinks.arguments[i]
}

function gotoshow(){
if (!window.winslide||winslide.closed)
winslide=window.open(slidelinks[whichlink])
else
winslide.location=slidelinks[whichlink]
winslide.focus()
}

//-->
</script>

<?php 
		$img_url = '';
		$img_go_to = '';
		$data_source = mysql_query("SELECT image_url,url_go_to FROM banner");
		while($data = mysql_fetch_array($data_source))
		{
			$img_url = $img_url.'"'.$data['image_url'].'",';
			$img_go_to = $img_go_to.'"'.$data['url_go_to'].'",';	
		} 
		$img_url = substr_replace($img_url ,"",-1);		
		$img_go_to = substr_replace($img_go_to ,"",-1);
		?>

<a href="javascript:gotoshow()"><img src="./media/imagens/pub_banner.gif" name="slide" border=0 width=120></a>
<script>


//configure the paths of the images, plus corresponding target links
slideshowimages(<?php echo $img_url; ?>)
slideshowlinks(<?php echo $img_go_to; ?>)

//configure the speed of the slideshow, in miliseconds
var slideshowspeed=7000

var whichlink=0
var whichimage=0
function slideit(){
if (!document.images)
return
document.images.slide.src=slideimages[whichimage].src
whichlink=whichimage
if (whichimage<slideimages.length-1)
whichimage++
else
whichimage=0
setTimeout("slideit()",slideshowspeed)
}
slideit()

</script>