
/*====================================================*/
/* FILE /sedlex/inline_scripts/6be5782d56e292ac4d7f0f1962555336629d575d.js*/
/*====================================================*/
				function checkIfBackupNeeded() {
					
					var arguments = {
						action: 'checkIfBackupNeeded'
					} 
					var ajaxurl2 = "https://dev.blueprint.luskin.ucla.edu/wp-admin/admin-ajax.php" ; 
					jQuery.post(ajaxurl2, arguments, function(response) {
						// We do nothing as the process should be as silent as possible
					});    
				}
				
				// We launch the callback
				if (window.attachEvent) {window.attachEvent('onload', checkIfBackupNeeded);}
				else if (window.addEventListener) {window.addEventListener('load', checkIfBackupNeeded, false);}
				else {document.addEventListener('load', checkIfBackupNeeded, false);} 
							
			
