<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="/facedetect/dist/jquery.facedetection.min.js"></script>

<body>
	<div id="fileinput-preview" width="50%" height="200px"></div>
	<input type="file" id="fileinput" />
	<button id="btnSubmit">Submit</button>
</body>
</html>


<script>
	$("#fileinput").on('change', function() {

		if (typeof(FileReader) == " ") {
			alert();
		}

		if (typeof(FileReader) == "undefined") {
			alert("Your browser doesn't support HTML5, Please upgrade your browser");
		}		
		 else {

			var container = $("#fileinput-preview");
                //remove all previous selected files
                container.empty();
                //create instance of FileReader
                var reader = new FileReader();
                reader.onload = function(e) {
                	$("<img />", {
                		"class": 'picture',
                		"width": 400,
                		"height": 'auto',
                		"src": e.target.result
                	}).appendTo(container);
                }
                if($(this)[0].files[0])
					reader.readAsDataURL($(this)[0].files[0]);
                return true;
            
            }
        });
	$("#btnSubmit").click(function(){
		$('.picture').faceDetection({
			complete: function (faces) {
				for (var i = 0; i < faces.length; i++) {
					$('<div>', {
						'class':'face',
						'css': {
							'position': 'absolute',
							'left':     faces[i].x * faces[i].scaleX + 'px',
							'top':      faces[i].y * faces[i].scaleY + 'px',
							'width':    faces[i].width  * faces[i].scaleX + 'px',
							'height':   faces[i].height * faces[i].scaleY + 'px'
						}
					}).insertAfter(this);
				}
			},
			error:function (code, message) {
				alert('Error: ' + message);
			}
		});
	});
</script>
<style type="text/css">
	.face {
		position: absolute;
		border: 2px solid #FFF;
	}
</style>