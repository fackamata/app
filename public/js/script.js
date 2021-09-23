StarOutUrl=		'StarOut.gif';		//image par défaut
StarOverUrl=		'StarOver.gif';		//image d'une étoile sélectionnée
StarBaseId=		'Star';			//id de base des étoiles
NbStar=			10;			//nombre d'étoiles

LgtStarBaseId=StarBaseId.lastIndexOf('');

function NotationSystem() {
	for (i=1;i<NbStar+1;i++) {
		var img			=document.getElementById('Star'+i);
			
		img.onclick		=function() {alert('Vous avez donné la note de '+Name2Nb(this.id)+'.');};
		//Réaction lors du clic sur une étoile
		//Evidemment, il faudrait compléter cette fonction pour la rendre vraiment utile.
		//Par exemple, envoyer la note dans une base de donnée via un XMLHttpRequest.
		
		img.alt			='Donner la note de '+i;
		//Texte au survol
		
		img.src			=StarOutUrl;
		img.onmouseover	=function() {StarOver(this.id);};
		img.onmouseout	=function() {StarOut(this.id);};
	}
}

function StarOver(Star) {
	StarNb=Name2Nb(Star);
	for (i=1;i<(StarNb*1)+1;i++) {
		document.getElementById('Star'+i).src=StarOverUrl;
	}
}

function StarOut(Star) {
	StarNb=Name2Nb(Star);
	for (i=1;i<(StarNb*1)+1;i++) {
		document.getElementById('Star'+i).src=StarOutUrl;
	}
}

function Name2Nb(Star) {
	//Le survol d'une étoile ne nous permet pas de connaître directement son numéro
	//Cette fonction extrait donc ce numéro à partir de l'Id
	StarNb=Star.slice(LgtStarBaseId);
	return(StarNb);
} 