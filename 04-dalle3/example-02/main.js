/*
|----------------------------------------------------------------------
| main.js
|----------------------------------------------------------------------
| Process form input and make call to PHP script to generate image.
*/

"use strict";

document.getElementById('imageForm').addEventListener('submit', function (e) {
  e.preventDefault(); // Prevent default form submission

  const prompt = document.getElementById('prompt').value.trim();
  const size = document.getElementById('size').value;

  if (!prompt) {
    document.getElementById('error').innerText = 'Please enter a valid prompt.';
    return;
  }

  document.getElementById('error').innerText = ''; // Clear previous errors
  document.getElementById('spinner').style.display = 'block'; // Show spinner
  document.querySelector('button').disabled = true; // Disable button

  // Create new AJAX request
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'genimage.php', true); // Keep pointing to genimage.php
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Handle response
  xhr.onload = function () {
    document.getElementById('spinner').style.display = 'none'; // Hide spinner
    document.querySelector('button').disabled = false; // Re-enable button

    if (xhr.status === 200) {
      try {
        let response = JSON.parse(xhr.responseText);
        if (response.error) {
          document.getElementById('error').innerText = response.error;
        } else if (response.url) {
          // Show the newly generated image
          let mainImageDiv = document.getElementById('main-image');
          mainImageDiv.innerHTML = ''; // Clear current main image
          let img = document.createElement('img');
          img.src = response.url;
          img.alt = 'Generated Image';
          mainImageDiv.appendChild(img);

          // Update the session history with the new image
          let historyDiv = document.getElementById('history-images');
          let historyImageDiv = document.createElement('div');
          historyImageDiv.className = 'image';
          let historyImg = document.createElement('img');
          historyImg.src = response.url;
          historyImg.alt = 'Generated Image';
          historyImageDiv.appendChild(historyImg);
          historyDiv.appendChild(historyImageDiv); // Add to the history section
        }
      } catch (e) {
        document.getElementById('error').innerText = 'Error parsing response: ' + e.message;
      }
    } else {
      document.getElementById('error').innerText = 'Server error occurred. Status: ' + xhr.status;
    }
  };

  // Handle request errors
  xhr.onerror = function () {
    document.getElementById('spinner').style.display = 'none'; // Hide spinner
    document.querySelector('button').disabled = false; // Re-enable button
    document.getElementById('error').innerText = 'Request failed. Network or server error.';
  };

  // Send request with prompt and selected size
  xhr.send('prompt=' + encodeURIComponent(prompt) + '&size=' + encodeURIComponent(size));
});