$(document).ready(function(){
    'use strict';

    // UPLOAD CLASS DEFINITION
    // ======================
/*
    var dropZone = document.getElementById('drop-zone');
*/  
  var uploadForm = document.getElementById('js-upload-form');

    var startUpload = function(files) {
        console.log(files)
		
		if( $("#tipo-estudio").val() != "" && $('#appendedInputButtons').val() != "" )
		{
			var options = {
				
                beforeSend: function(){
                    // Replace this with your loading gif image
                    $('#progreso .bar').css("width","0");
					
                },
				uploadProgress: function(event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					$('#progreso .bar').width(percentVal);
					
				},
				success: function() {
					var percentVal = '100%';
					$('#progreso .bar').width(percentVal);
				},
                complete: function(response){
					$("#js-upload-files,#appendedInputButtons").clearInputs(true);
                    // Output AJAX response to the div container
                    $('#js-upload-finished > ul').append(response.responseText);
					$("#js-upload-finished").slideDown();
                }
            };  
		
			$("#js-upload-form").ajaxSubmit(options);
		}
		 
		
    }

    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();
		var uploadFiles = document.getElementById('js-upload-files').files;        

        startUpload(uploadFiles);
    });
/*
    dropZone.ondrop = function(e) {
        e.preventDefault();
        this.className = 'upload-drop-zone';
		

        startUpload(e.dataTransfer.files)
    }

    dropZone.ondragover = function() {
        this.className = 'upload-drop-zone drop';
        return false;
    }

    dropZone.ondragleave = function() {
        this.className = 'upload-drop-zone';
        return false;
    }
	
	*/
	
	

});