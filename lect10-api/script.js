function ajax( endpoint, returnFunction ) {
	let xhr = new XMLHttpRequest();
	//.open(method - get or post?, endpoint)
	xhr.open("GET", endpoint);
	xhr.send();
	// Wait until we get some kind of response comes back from iTunes
	xhr.onreadystatechange = function() {
		// console.log(this);
		// When iTunes gives us some kind of response, this code will get run

		if( xhr.readyState == this.DONE ) {
			if( xhr.status == 200 ) {
				// Succesfully received a response
				// console.log( xhr.responseText );
				// console.log( JSON.parse(xhr.responseText) );

				returnFunction( xhr.responseText );
			}
			else {
				// There was some error
				alert("AJAX error!");
				console.log(xhr.status);
			}
		}

	}
}

function displayResults(resultObject) {

	// Convert JSON into JS objects
	resultObject = JSON.parse(resultObject);
	console.log(resultObject);

	// Create a bunch of HTML elements so we can show the results on the browser in a nicely formatted way

	let tbodyElement = document.querySelector("tbody");

	// Clear previous results
	while( tbodyElement.hasChildNodes() ) {
		tbodyElement.removeChild(tbodyElement.lastChild);
	}

	// Update the result count
	document.querySelector("#num-results").innerHTML = resultObject.resultCount;

	// Run through the results and create a <tr> element for each result
	for( let i = 0; i < resultObject.results.length; i++ ) {
		let trElement = document.createElement("tr");

		let cellCover = document.createElement("td");
		let cellArtist = document.createElement("td");
		let cellTrack = document.createElement("td");
		let cellAlbum = document.createElement("td");
		let cellPreview = document.createElement("td");

		// Create <img> tag for cover image
		let imgElement = document.createElement("img");
		imgElement.src = resultObject.results[i].artworkUrl100;

		// Append the <img> tag to its <td> tag
		cellCover.appendChild(imgElement);
		console.log(cellCover);

		// Add text to artist, track, and album cells
		cellArtist.innerHTML = resultObject.results[i].artistName;
		cellTrack.innerHTML = resultObject.results[i].trackName;
		cellAlbum.innerHTML = resultObject.results[i].collectionName;

		// Create <audio> tag for preview
		let audioElement = document.createElement("audio");
		audioElement.src = resultObject.results[i].previewUrl;
		audioElement.controls = true;

		// Append the <audio> tag to its <td> tag
		cellPreview.appendChild(audioElement);

		// Append <td> tags to the <tr> tag
		trElement.appendChild(cellCover);
		trElement.appendChild(cellArtist);
		trElement.appendChild(cellTrack);
		trElement.appendChild(cellAlbum);
		trElement.appendChild(cellPreview);

		console.log(trElement);

		// Append the <tr> to the <tbody>
		tbodyElement.appendChild(trElement);
	}



}

document.querySelector("#search-form").onsubmit = function(event) {
	
	event.preventDefault();

	let searchInput = document.querySelector("#search-id").value.trim();
	let limitInput = document.querySelector("#limit-id").value.trim();

	console.log(searchInput);
	console.log(limitInput);

	// Make a HTTP request via AJAX to iTunes Search API. 
	let endpoint = "https://itunes.apple.com/search?term=" + searchInput + "&limit=" + limitInput;

	// Call the AJAX function
	ajax(endpoint, displayResults);

	console.log("at the end of onsubmit");

}



