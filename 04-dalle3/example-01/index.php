<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Generate Image with DALL·E 3</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    textarea {
      width: 100%;
      height: 100px;
      padding: 10px;
      font-size: 16px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    select {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
    }

    button:disabled {
      background-color: #999;
      cursor: not-allowed;
    }

    .error {
      color: red;
      margin-top: 20px;
    }

    .image {
      display: inline-block;
      margin: 10px;
    }

    .image img {
      max-width: 100%;
      height: auto;
    }

    #main-image {
      margin-top: 20px;
    }

    #history-images {
      margin-top: 20px;
    }

    #spinner {
      display: none;
      margin-top: 20px;
    }
  </style>
</head>

<body>

  <h1>Generate Image with DALL·E 3</h1>

  <form id="imageForm">
    <label for="prompt">Enter a text prompt:</label><br><br>
    <textarea id="prompt" name="prompt" placeholder="Enter your prompt here..."></textarea>
    <br>

    <!-- Add image size options -->
    <label for="size">Select Image Size:</label><br><br>
    <select id="size" name="size">
      <option value="1024x1024">1024x1024 (Large)</option>
      <option value="1792x1024">1792x1024 (Wide)</option>
      <option value="1024x1792">1024x1792 (Tall)</option>
    </select>
    <br>

    <button type="submit">Generate Image</button>
  </form>

  <div id="spinner">
    <p>Generating image... Please wait.</p>
  </div>

  <div id="error" class="error"></div>
  <div id="main-image"></div> <!-- Main image display area -->

  <h2>History</h2>
  <div id="history-images"></div> <!-- History of generated images -->

  <script>
    document.getElementById('imageForm').addEventListener('submit', function(e) {
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
      xhr.onload = function() {
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
      xhr.onerror = function() {
        document.getElementById('spinner').style.display = 'none'; // Hide spinner
        document.querySelector('button').disabled = false; // Re-enable button
        document.getElementById('error').innerText = 'Request failed. Network or server error.';
      };

      // Send request with prompt and selected size
      xhr.send('prompt=' + encodeURIComponent(prompt) + '&size=' + encodeURIComponent(size));
    });
  </script>

</body>

</html>