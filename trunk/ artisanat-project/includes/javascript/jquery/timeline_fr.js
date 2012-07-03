/* LANGUAGE 
================================================== */
typeof VMM != "undefined" && (
	VMM.Language={
		lang:"fr",
		api:{
			wikipedia:"fr"
		},
		date:{
			month:["janvier","fevrier","mars","avril","mai","juin","juillet","aout","septembre","octobre","novembre","decembre"],
			month_abbr:["janv.","fevr.","mars","avril","mai","juin","juil.","aout","sept.","oct.","nov.","dec."],
			day:["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"],
			day_abbr:["Dim.","Lu.","Ma.","Me.","Jeu.","Vend.","Sam."]
		},
		dateformats:{
			year:"yyyy",
			month_short:"mmm",
			month:"mmmm yyyy",
			full_short:"d mmm",
			full:"d mmmm yyyy",
			time_no_seconds_short:"HH:MM",
			time_no_seconds_small_date:"HH:MM'<br/><small>'d mmmm yyyy'</small>'",
			full_long:"dddd',' d mmm yyyy 'a' HH:MM",
			full_long_small_date:"HH:MM'<br/><small>'dddd',' d mmm yyyy'</small>'"
		},
		messages:{
			loading_timeline:"Chargement de la frise en cours... ",
			return_to_title:"Retour a la page d'accueil",
			expand_timeline:"Elargir la frise",
			contract_timeline:"Reduire la frise",
			wikipedia:"Extrait de Wikipedia, l'encyclopedie libre",
			loading_content:"Chargement",
			loading:"Chargement"
		}
	}
);