
/*====================================================*/
/* FILE /sedlex/inline_scripts/70649c76cba07d1aac8e89ee9069401d39bf34f0.js*/
/*====================================================*/
				function checkIfBackupNeeded() {
					
					var arguments = {
						action: 'checkIfBackupNeeded'
					} 
					var ajaxurl2 = "http://dev.blueprint.luskin.ucla.edu/wp-admin/admin-ajax.php" ; 
					jQuery.post(ajaxurl2, arguments, function(response) {
						// We do nothing as the process should be as silent as possible
					});    
				}
				
				// We launch the callback
				if (window.attachEvent) {window.attachEvent('onload', checkIfBackupNeeded);}
				else if (window.addEventListener) {window.addEventListener('load', checkIfBackupNeeded, false);}
				else {document.addEventListener('load', checkIfBackupNeeded, false);} 
							
			
